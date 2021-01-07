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
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <p class="text-center">Add Holiday</p>
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
            <p class='text-center'>Holidays</p>
          </div>
          <div class="card-body">
            <?php if ($holidays) : ?>
              <?php foreach ($holidays as $holiday) : ?>
                <div class='card mt-3'>
                  <div class="card-body">
                    <h5><?= $holiday['name']; ?></h5>
                    <div>
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