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
        <h5 class="text-center mt-4">Login</h5>
        <div class="form">
          <form>
            <div class="form-floating mb-3">
              <input type="text" name="mobile" id='mobile' class="form-control" placeholder="0000000000">
              <label for="mobile">Mobile Number</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" name="password" id='password' class="form-control" placeholder="password@123">
              <label for="password">Password</label>
            </div>
            <button type="submit" class="btn btn-primary form-control">Log In</button>
          </form>
          <div class="mt-5">
            <a href='#' class='link'>Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?= $scripts; ?>

</body>

</html>