<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>No Access | Error</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/style.css' ?>">
  <?= $links; ?>
</head>

<body>

  <div class="container mt-3">

    <div class="row">
      <div class="col-sm-8 offset-sm-2">
        <div class="card">
          <div class="card-body text-center">
            <h1>You Don't Have access to this Page</h1>
            <p>Go Back to <a href="<?= SITE_ROOT; ?>">Home Page</a></p>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script src="<?= ASSETS_URL . 'js/company.js' ?>"></script>
</body>

</html>