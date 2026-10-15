<?php
if (!function_exists('pc_qr_src')) {
  function pc_qr_src(string $target): string
  {
    return 'https://api.qrserver.com/v1/create-qr-code/?size=220x220&margin=10&ecc=H&data=' . rawurlencode($target);
  }
}
