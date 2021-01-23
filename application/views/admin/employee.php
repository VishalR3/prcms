<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Contractor - Admin</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/style.css' ?>">
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/employee.css' ?>">
  <?= $links; ?>
</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <div class="card">
      <div class="card-body" id='emp_card'>
        <div class="row">
          <div class="col-sm-4">
            <img class="dp" src="http://res.cloudinary.com/vishaltest/image/upload/<?= $employee['photo'] ?>" alt="user_profile">
          </div>
          <div class="col-sm-8">
            <h4><?= $employee['name']; ?></h4>
            <div class="details">
              <span><?= $employee['shift']; ?> Shift</span>
              <span>Employee ID : <?= $employee['empID']; ?></span>
              <span>Mobile : <b><?= $employee['mobile']; ?></b></span>
              <span>Email : <a href='mailto:<?= $employee['email']; ?>'><?= $employee['email']; ?></a></span>
              <span>Department : <?= $employee['dept']; ?></span>
              <span>Location : <?= $employee['location']; ?></span>
              <span>Vehicle Number : <?= $employee['vehicle_number']; ?></span>
              <span>License : <?= $employee['license']; ?></span>
              <span>Emission Expiry : <?= $employee['emission_exp']; ?></span>
              <span>Active Status : <?= $employee['active']; ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script src="<?= ASSETS_URL . 'js/employee.js' ?>"></script>
</body>

</html>