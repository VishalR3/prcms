<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>GateKeeper | Home</title>
  <!-- Bootstrap CSS -->
  <?= $links; ?>
  <link rel="stylesheet" href="<?= ASSETS_URL; ?>css/style.css">
</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <div class="row">
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <img class="dp" src="<?= ASSETS_URL ?>images/profile.png" alt="user_profile">
            <h5 class="username">Vishal Rana</h5>
            <div class="userdata">
              <div class="data-row ">
                <div class="key">
                  EmpID
                </div>
                <div class="value">324</div>
              </div>
              <div class="data-row ">
                <div class="key">
                  EmpID
                </div>
                <div class="value">324</div>
              </div>
              <div class="data-row ">
                <div class="key">
                  EmpID
                </div>
                <div class="value">324</div>
              </div>
              <div class="data-row ">
                <div class="key">
                  EmpID
                </div>
                <div class="value">324</div>
              </div>
              <div class="data-row ">
                <div class="key">
                  EmpID
                </div>
                <div class="value">324</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-9">
        <div class="card">
          <div class="card-header">
            <h5>Requests for meeting By Visitors</h5>
          </div>
          <div class="shutter">
            <div class="shutter-title">
              <div>New Requests</div>
              <div><i class="fa fa-chevron-down"></i></div>
            </div>
            <div class="shutter-body">
            </div>
          </div>
          <div class="shutter">
            <div class="shutter-title">
              <div>Scheduled</div>
              <div><i class="fa fa-chevron-down"></i></div>
            </div>
            <div class="shutter-body">
            </div>
          </div>
          <div class="shutter">
            <div class="shutter-title">
              <div>Finished</div>
              <div><i class="fa fa-chevron-down"></i></div>
            </div>
            <div class="shutter-body">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?= $footer; ?>
  <?= $scripts; ?>

  <script type='module' src="<?= ASSETS_URL . 'js/dashboard.js' ?>"></script>

</body>

</html>