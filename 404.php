<?php
http_response_code(404);
$pageTitle       = '404 - Page Not Found | PowerCabs';
$pageDescription = "The page you're looking for doesn't exist or may have been moved.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
  <meta name="robots" content="noindex, follow">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/variables.css?v=<?= @filemtime(__DIR__ . '/assets/css/variables.css') ?>">
  <link rel="stylesheet" href="/assets/css/base.css?v=<?= @filemtime(__DIR__ . '/assets/css/base.css') ?>">
</head>
<body>

<?php require __DIR__ . '/components/shared/page-loader.php'; ?>

<main class="d-flex align-items-center justify-content-center px-3" style="min-height: 100vh; background: var(--pc-cream-soft);">
  <div class="text-center py-5" style="max-width: 560px;">
    <img src="/assets/img/not-found.svg" alt="" aria-hidden="true" class="img-fluid mb-4" style="max-width: 520px;">

    <h1 class="fw-bold mb-4" style="font-size: clamp(1.6rem, 3.5vw, 2.25rem); color: var(--pc-dark);">Oops! Page Not Found</h1>
    <p class="text-muted-pc mb-5" style="font-size: 1.2rem;"><?= htmlspecialchars($pageDescription) ?></p>

    <div class="d-flex flex-wrap justify-content-center gap-3">
      <a href="/index.php" class="btn btn-pc-primary rounded-pill px-4 d-inline-flex align-items-center gap-2">
        <i class="bi bi-house-door-fill"></i>
        <span>Back to Home</span>
      </a>
      <a href="/book-ride-online.php" class="btn btn-pc-dark rounded-pill px-4 d-inline-flex align-items-center gap-2">
        <i class="bi bi-car-front-fill"></i>
        <span>Book Online</span>
      </a>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/components/page-loader.js"></script>
</body>
</html>
