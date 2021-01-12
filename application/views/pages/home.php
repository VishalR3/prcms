<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>GateKeeper | Home</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/style.css' ?>">
  <?= $links; ?>

</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <?php if ($this->session->tempdata('login_success')) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo "SuccessFully Logged In"; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('login_msg')) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo "SuccessFully Logged In"; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <p>Employee Attendance Website</p>
            <p>Logged In : <b><?= $this->session->username; ?></b></p>
            <div id="fbrealtime"></div>
          </div>
        </div>
        <div class="card mt-3">
          <div class="card-body">
            <h5>Employee Identification</h5>
            <table class="table table-responsive" id='realtime_table'>
              <thead class='bg-dark text-white'>
                <th scope='col'>Emp ID</th>
                <th scope='col'>Name</th>
                <th scope='col'>Shift</th>
              </thead>
            </table>
          </div>
        </div>
        <div id='react'></div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="searchWrapper">
              <div class="input-group my-3">
                <input type="text" name="search" id='search' class="form-control" placeholder="Search An Employee" />
                <div class="input-group-append">
                  <span class="input-group-text" id='input-icon'>
                    <i class="fa fa-search"></i>
                  </span>
                </div>
              </div>
              <div class="filters row my-3">
                <div class="col">
                  <select name='company' id='company' class="form-select">
                    <option value="all">All</option>
                    <?php foreach ($companies as $company) : ?>
                      <option value="<?= $company['comp_id']; ?>"><?= $company['comp_name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col">
                  <select name='location' id='location' class="form-select">
                    <option value="all">All</option>
                    <?php foreach ($locations as $location) : ?>
                      <option value="<?= $location['loc_name']; ?>"><?= $location['loc_name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col">
                  <select name='dept' id='dept' class="form-select">
                    <option value="all">All</option>
                    <?php foreach ($departments as $department) : ?>
                      <option value="<?= $department['dept_name']; ?>"><?= $department['dept_name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <table class="table table-responsive" id='realtime_data'></table>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>

  <!-- The core Firebase JS SDK is always required and must be listed first -->
  <script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-app.js"></script>

  <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
  <script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-analytics.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.2.2/firebase-database.js"></script>
  <script src="<?= ASSETS_URL . 'js/firebase.config.js' ?>"></script>

  <script type='module' src="<?= ASSETS_URL . 'js/home.js' ?>"></script>
  <script type='module' src="<?= ASSETS_URL . 'js/init.js' ?>"></script>

</body>

</html>