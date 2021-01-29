<?php $access = json_decode($this->session->userdata('access')); ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Shift | PRCMS</title>
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
      <?php if (in_array('master.write', $access)) : ?>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-header">
              <h5 class="text-center">Add Shift</h5>
            </div>
            <div class="card-body">
              <form id="add_shift_form">
                <div class="mb-3">
                  <label for="shift_name" class="form-label">Name of the Shift</label>
                  <input type='text' name='shift_name' class="form-control" />
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="start" class="form-label">Starts at </label>
                      <input type='time' name='start' class="form-control" />
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="end" class="form-label">Ends at </label>
                      <input type='time' name='end' class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="my-3">
                  <h6>Lunch Break</h6>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label for="lunch_bk_start" class="form-label">Starts at </label>
                        <input type='time' name='lunch_bk_start' class="form-control" />
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label for="lunch_bk_end" class="form-label">Ends at </label>
                        <input type='time' name='lunch_bk_end' class="form-control" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="my-3">
                  <h6>Other Break <span class='small-font'>(Only for Night Shift)</span></h6>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label for="other_bk_start" class="form-label">Starts at </label>
                        <input type='time' name='other_bk_start' id='other_bk_start' class="form-control" />
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="mb-3">
                        <label for="other_bk_end" class="form-label">Ends at </label>
                        <input type='time' name='other_bk_end' id='other_bk_end' class="form-control" />
                      </div>
                    </div>
                  </div>
                </div>
                <button type='submit' class='btn btn-primary'>Add Shift</button>

              </form>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="col-sm-6 <?php if (!in_array('master.write', $access)) {
                              echo "offset-sm-3";
                            } ?>">
        <div class="card">
          <div class="card-header">
            <h5 class='text-center'>Existing Shift</h5>
          </div>
          <div class="card-body">
            <?php if ($shifts) : ?>
              <?php foreach ($shifts as $shift) : ?>
                <div class='card mt-3 br-2 details_card'>
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h5><?= $shift['shift_name']; ?></h5>
                        <span class="id">Shift ID : <?= $shift['shift_id']; ?></span>
                      </div>
                      <div class='edit_div'>
                        <a href="<?= SITE_ROOT; ?>masters/edit/shift/<?= $shift['shift_id']; ?>" class='edit_btn'><i class="fa fa-edit mr-2"></i> Edit Shift</a>
                      </div>
                    </div>
                    <div class="details">
                      <span class="detail"><?= $shift['start'] . ' - ' . $shift['end']; ?></span>
                      <span class="detail">Lunch Break : <?= $shift['lunch_bk_start'] . " - " . $shift['lunch_bk_end']; ?></span>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <p>No Shifts Here</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script src="<?= ASSETS_URL . 'js/shift.js' ?>"></script>
</body>

</html>