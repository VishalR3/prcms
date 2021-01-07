<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>GateKeeper | Home</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/shift.css' ?>">
  <?= $links; ?>
</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <p class="text-center">Add Shift</p>
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
              <button type='submit' class='btn btn-primary'>Add Shift</button>

            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <p class='text-center'>Existing Shift</p>
          </div>
          <div class="card-body">
            <?php if ($shifts) : ?>
              <?php foreach ($shifts as $shift) : ?>
                <div class='card'>
                  <div class="card-body">
                    <h5><?= $shift['shift_name']; ?></h5>
                    <div>
                      <p><?= $shift['start'] . ' - ' . $shift['end']; ?></p>
                      <p>Lunch Break : <?= $shift['lunch_bk_start'] . " - " . $shift['lunch_bk_end']; ?></p>
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
  <script type='module' src="<?= ASSETS_URL . 'js/shift.js' ?>"></script>
</body>

</html>