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
    <div class="card">
      <div class="card-body">
        <h5><?= $employee['name']; ?></h5>
        <span class="emp_id">Emp ID : <?= $employee['empID']; ?></span>
        <div class="location">
          <span><?= $employee['location']; ?></span>
        </div>
        <div class="shift">
          <span><?= $employee['shift']; ?> Shift</span>
        </div>
        <div class="details">
          <span>Mobile : <?= $employee['mobile']; ?></span>
          <span>Email : <?= $employee['email']; ?></span>
          <span>Department : <?= $employee['dept']; ?></span>
          <span>Vehicle Number : <?= $employee['vehicle_number']; ?></span>
          <span>License : <?= $employee['license']; ?></span>
          <span>Emission Expiry : <?= $employee['emission_exp']; ?></span>
        </div>
        <span>Active Status : <?= $employee['active']; ?></span>
        <div class="col-3">
          <img class="dp" src="<?= ASSETS_URL ?>images/profile.png" alt="user_profile">
        </div>
      </div>
    </div>
  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script type='module' src="<?= ASSETS_URL . 'js/employee.js' ?>"></script>
</body>

</html>