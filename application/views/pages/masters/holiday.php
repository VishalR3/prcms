<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Department - Admin</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/style.css' ?>">
  <?= $links; ?>
</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <?php if ($this->session->userdata('success_msg')) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $this->session->userdata('success_msg'); ?>
        <?php $this->session->unset_userdata('success_msg'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <?php if ($this->session->userdata('error_msg')) : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $this->session->userdata('error_msg'); ?>
        <?php $this->session->unset_userdata('error_msg'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center">Add Holiday</h5>
          </div>
          <div class="card-body">
            <form id="add_holiday_form">
              <div class="mb-3">
                <label for="name" class="form-label">Holiday Name</label>
                <input type='text' name='name' id='name' class="form-control" />
              </div>
              <div class="row">
                <div class="col-sm-6">

                  <div class="mb-3">
                    <label for="start" class="form-label">Start Date </label>
                    <input type='date' name="start" id="start" class="form-control" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label for="end" class="form-label">End Date</label>
                    <input type='date' name='end' id='end' class="form-control" />
                  </div>

                </div>
              </div>



              <button type='submit' class='btn btn-primary'>Add Holiday</button>

            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class='text-center'>Holidays</h5>
          </div>
          <div class="card-body">
            <?php if ($holidays) : ?>
              <?php foreach ($holidays as $holiday) : ?>
                <div class='card mt-3 br-2 details_card'>
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h5><?= $holiday['name']; ?></h5>
                      </div>
                      <div class='edit_div'>
                        <a href="<?= SITE_ROOT; ?>masters/edit/holiday/<?= $holiday['_id']; ?>" class='edit_btn'><i class="fa fa-edit mr-2"></i> Edit Holiday</a>
                      </div>
                    </div>
                    <div class="details">
                      <p> From
                        <?= date('d/m/Y', strtotime($holiday['start'])); ?>
                        to
                        <?= date('d/m/Y', strtotime($holiday['end'])); ?>
                      </p>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <p>No Holidays</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script type='module' src="<?= ASSETS_URL . 'js/holiday.js' ?>"></script>
</body>

</html>