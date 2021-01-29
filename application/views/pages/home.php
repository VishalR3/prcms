<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Home | PRCMS</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/style.css' ?>">
  <?= $links; ?>

</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <?php if ($this->session->userdata('login_success')) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo "SuccessFully Logged In"; ?>
        <?php $this->session->unset_userdata('login_success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-sm-6">
        <div class="card mb-3" id='loading_state_card'>
          <div class="card-body">
            <div class="progress mt-3" style="height:5px;">
              <div class="progress-bar" id="faceRecProgress">
              </div>
            </div>
            <div>
              <span id="status_span" style="font-size:0.75rem;">Loading Models...</span>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <p>Logged In : <b><?= $this->session->username; ?></b></p>
            <div class="form-group">
              <label for="input_video" class='form-label'>Select Input Source</label>
              <select name='input_video' id='input_video' class='form-select'>
              </select>
            </div>
            <div id='frdiv' class="frdiv" style='position:relative;'>
              <video id='video' class="camera_input mt-3">
              </video>
              <canvas id="face-canvas" style="position: absolute;top:1rem;left:0;right:0;"></canvas>
            </div>
          </div>
        </div>
        <div class="card mt-3">
          <div class="card-body">
            <h5 class='text-center'>Employee Identification</h5>
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
            </div>
            <table class="table table-responsive" id='realtime_data'>
              <thead class="bg-dark text-white">
                <td scope='col'>Emp Id</td>
                <td scope='col'>Name</td>
                <td scope='col'>In Time</td>
                <td scope='col'>Out Time</td>
              </thead>
            </table>
          </div>
        </div>

      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>



  <script defer src="<?= ASSETS_URL . 'js/vendor/face-api/face-api.min.js' ?>"></script>
  <script defer src="<?= ASSETS_URL . 'js/face-recognition.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/home.js' ?>"></script>

</body>

</html>