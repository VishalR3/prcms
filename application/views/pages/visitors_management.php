<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Contractor - Admin</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/style.css' ?>">
  <?= $links; ?>
</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <div class="center_card">
      <h3>Visitors Management</h3>
      <div class="col-sm-4 mt-5">
        <form id='visitor_login_form'>
          <div class="mb-3">
            <label for="visitor_name" class="form-label">Visitor Name</label>
            <input type="text" name='visitor_name' id='visitor_name' class="form-control">
          </div>
          <div class="mb-3">
            <label for="visitor_mobile" class="form-label">Mobile Number</label>
            <input type="text" name='visitor_mobile' id='visitor_mobile' class="form-control">
          </div>
          <button type='submit' class="btn btn-primary">Log In</button>
        </form>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script type='module' src="<?= ASSETS_URL . 'js/visitor.js' ?>"></script>
</body>

</html>