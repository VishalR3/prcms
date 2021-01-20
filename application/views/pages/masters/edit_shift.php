<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Shift - Admin</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/style.css' ?>">
  <?= $links; ?>
</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <div class="row g-4">
      <div class="col-sm-6 offset-sm-3">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center">Edit Shift</h5>
          </div>
          <div class="card-body">
            <form id="edit_shift_form" method="POST" action="<?= SITE_ROOT; ?>masters/update/shift/<?= $shift['shift_id']; ?>">
              <div class="mb-3">
                <label for="shift_name" class="form-label">Name of the Shift</label>
                <input type='text' name='shift_name' class="form-control" value="<?= $shift['shift_name']; ?>" />
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label for="start" class="form-label">Starts at </label>
                    <input type='time' name='start' value="<?= $shift['start']; ?>" class="form-control" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label for="end" class="form-label">Ends at </label>
                    <input type='time' name='end' value="<?= $shift['end']; ?>" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="my-3">
                <h6>Lunch Break</h6>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="lunch_bk_start" class="form-label">Starts at </label>
                      <input type='time' name='lunch_bk_start' value="<?= $shift['lunch_bk_start']; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="lunch_bk_end" class="form-label">Ends at </label>
                      <input type='time' name='lunch_bk_end' value="<?= $shift['lunch_bk_end']; ?>" class="form-control" />
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
                      <input type='time' name='other_bk_start' id='other_bk_start' value="<?= $shift['other_bk_start']; ?>" class="form-control" />
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="other_bk_end" class="form-label">Ends at </label>
                      <input type='time' name='other_bk_end' id='other_bk_end' value="<?= $shift['other_bk_end']; ?>" class="form-control" />
                    </div>
                  </div>
                </div>
              </div>
              <button type='submit' class='btn btn-primary'>Update Shift</button>
              <a href='<?= SITE_ROOT; ?>masters/delete/shift/<?= $shift['shift_id']; ?>' class="btn btn-danger delete_btn">Delete Shift</a>

            </form>
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