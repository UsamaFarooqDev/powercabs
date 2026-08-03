<?php
function pc_smtp_read_response($socket) {
    $data = '';
    while (!feof($socket)) {
        $line = fgets($socket, 515);
        if ($line === false) {
            break;
        }
        $data .= $line;
        if (isset($line[3]) && $line[3] === ' ') {
            break;
        }
    }
    $code = substr($data, 0, 3);
    return ['code' => $code, 'text' => $data];
}

function pc_smtp_command($socket, $command, $expectedCode) {
    fwrite($socket, $command . "\r\n");
    $response = pc_smtp_read_response($socket);
    if ($response['code'] !== $expectedCode) {
        throw new Exception("SMTP command failed: {$command} -> {$response['text']}");
    }
    return $response;
}

function pc_smtp_dot_stuff($text) {
    $text = str_replace(["\r\n", "\r", "\n"], "\n", $text);
    $lines = explode("\n", $text);
    foreach ($lines as &$line) {
        if (isset($line[0]) && $line[0] === '.') {
            $line = '.' . $line;
        }
    }
    return implode("\r\n", $lines);
}

/**
 * Sends one email with optional attachments.
 *
 * @param string $subject
 * @param string $bodyText Plain-text body.
 * @param array  $replyTo  ['name' => ..., 'email' => ...] -- set as the
 *                          Reply-To header so replying goes straight to
 *                          the person who submitted the form.
 * @param array  $attachments List of ['tmp_path' => ..., 'filename' => ...,
 *                          'mime' => ...].
 * @return array ['success' => bool, 'error' => string|null]
 */
function pc_send_mail($subject, $bodyText, $replyTo = [], $attachments = []) {
    $socket = null;
    try {
        $socket = stream_socket_client(
            'ssl://' . PC_SMTP_HOST . ':' . PC_SMTP_PORT,
            $errno,
            $errstr,
            15,
            STREAM_CLIENT_CONNECT
        );
        if (!$socket) {
            throw new Exception("Could not connect to SMTP host: {$errstr} ({$errno})");
        }
        stream_set_timeout($socket, 15);

        pc_smtp_read_response($socket); // initial 220 greeting
        pc_smtp_command($socket, 'EHLO powercabs.ie', '250');
        pc_smtp_command($socket, 'AUTH LOGIN', '334');
        pc_smtp_command($socket, base64_encode(PC_SMTP_USER), '334');
        pc_smtp_command($socket, base64_encode(PC_SMTP_PASS), '235');
        pc_smtp_command($socket, 'MAIL FROM:<' . PC_SMTP_USER . '>', '250');
        pc_smtp_command($socket, 'RCPT TO:<' . PC_MAIL_TO . '>', '250');
        pc_smtp_command($socket, 'DATA', '354');

        $boundary = 'pc-boundary-' . bin2hex(random_bytes(12));
        $fromHeader = '=?UTF-8?B?' . base64_encode(PC_SMTP_FROM_NAME) . '?= <' . PC_SMTP_USER . '>';
        $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';

        $headers = [];
        $headers[] = 'From: ' . $fromHeader;
        $headers[] = 'To: <' . PC_MAIL_TO . '>';
        if (!empty($replyTo['email'])) {
            $replyName = $replyTo['name'] ?? '';
            $headers[] = 'Reply-To: ' . ($replyName !== ''
                ? '=?UTF-8?B?' . base64_encode($replyName) . '?= <' . $replyTo['email'] . '>'
                : $replyTo['email']);
        }
        $headers[] = 'Subject: ' . $encodedSubject;
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-Type: multipart/mixed; boundary="' . $boundary . '"';

        $message = implode("\r\n", $headers) . "\r\n\r\n";
        $message .= "--{$boundary}\r\n";
        $message .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $message .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
        $message .= $bodyText . "\r\n";

        foreach ($attachments as $attachment) {
            if (empty($attachment['tmp_path']) || !is_readable($attachment['tmp_path'])) {
                continue;
            }
            $content = base64_encode(file_get_contents($attachment['tmp_path']));
            $content = chunk_split($content, 76, "\r\n");
            $mime = $attachment['mime'] ?? 'application/octet-stream';
            $filename = $attachment['filename'] ?? 'attachment';

            $message .= "--{$boundary}\r\n";
            $message .= "Content-Type: {$mime}; name=\"{$filename}\"\r\n";
            $message .= "Content-Transfer-Encoding: base64\r\n";
            $message .= "Content-Disposition: attachment; filename=\"{$filename}\"\r\n\r\n";
            $message .= $content . "\r\n";
        }

        $message .= "--{$boundary}--\r\n";

        fwrite($socket, pc_smtp_dot_stuff($message) . "\r\n.\r\n");
        $response = pc_smtp_read_response($socket);
        if ($response['code'] !== '250') {
            throw new Exception("Message not accepted: {$response['text']}");
        }

        fwrite($socket, "QUIT\r\n");
        fclose($socket);

        return ['success' => true, 'error' => null];
    } catch (Exception $e) {
        if ($socket) {
            fclose($socket);
        }
        return ['success' => false, 'error' => $e->getMessage()];
    }
}
