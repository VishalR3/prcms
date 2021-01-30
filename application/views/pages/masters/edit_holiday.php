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
    <div class="row g-4">
      <div class="col-md-6 offset-md-3">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center">Edit Holiday</h5>
          </div>
          <div class="card-body">
            <form id="update_holiday_form" method="POST" action='<?= SITE_ROOT; ?>masters/update/holiday/<?= $holiday['_id']; ?>'>
              <div class="mb-3">
                <label for="name" class="form-label">Holiday Name</label>
                <input type='text' name='name' id='name' class="form-control" value="<?= $holiday['name']; ?>" />
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label for="start" class="form-label">Start Date </label>
                    <input type='date' name="start" id="start" value="<?= date("Y-m-d", strtotime($holiday['start'])); ?>" class="form-control" />
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label for="end" class="form-label">End Date</label>
                    <input type='date' name='end' id='end' value="<?= date("Y-m-d", strtotime($holiday['end'])); ?>" class="form-control" />
                  </div>

                </div>
              </div>



              <button type='submit' class='btn btn-primary'>Update Holiday</button>
              <a href='<?= SITE_ROOT; ?>masters/delete/holiday/<?= $holiday['_id']; ?>' class="btn btn-danger delete_btn">Delete Holiday</a>

            </form>
          </div>
        </div>
      </div>

    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script src="<?= ASSETS_URL . 'js/holiday.js' ?>"></script>
</body>

</html>