<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>GateKeeper | Home</title>
  <!-- Bootstrap CSS -->

  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/loginPage.css' ?>">
  <?= $links; ?>
</head>

<body>
  <div class='wrapper'>
    <div class="card">
      <div class="card-body">
        <h2 class="text-center">PRC - Management System</h2>
        <h5 class="text-center mt-4">First Login</h5>
        <div class="form">
          <p>We noticed its your first time login, It is recommended that you change your password now. </p>
          <form>
            <div class="form-floating my-3">
              <input type="password" name="password" id='password' class="form-control" placeholder="password@123">
              <label for="password">Change Password</label>
            </div>
            <button type="submit" class="btn btn-primary form-control">Change Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?= $scripts; ?>

</body>

</html>