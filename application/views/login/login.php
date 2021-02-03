<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login | PRCMS</title>
  <!-- Bootstrap CSS -->

  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/loginPage.css' ?>">
  <?= $links; ?>
</head>

<body>
  <div class='wrapper'>
    <div class="card">
      <div class="card-body">
        <h2 class="text-center">PRC - Management System</h2>
        <h5 id='loginHeading' class="text-center mt-4">Login</h5>
        <div class="form">
          <?php if ($this->session->userdata('errors')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?php echo $this->session->userdata('errors');
              $this->session->unset_userdata('errors');
              ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>
          <form action='user/login' method="POST">
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