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
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <p class="text-center">Add Department</p>
          </div>
          <div class="card-body">
            <form id="add_department_form">
              <div class="mb-3">
                <label for="dept_name" class="form-label">Department Name</label>
                <input type='text' name='dept_name' id='dept_name' class="form-control" />
              </div>

              <div class="mb-3">
                <label for="hod" class="form-label">HOD </label>
                <input type='text' name="hod" id="hod" class="form-control" />
              </div>


              <div class="mb-3">
                <label for="mob" class="form-label">MOB</label>
                <input type='text' name='mob' id='mob' class="form-control" />
              </div>

              <button type='submit' class='btn btn-primary'>Add Department</button>

            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <p class='text-center'>Existing Departments</p>
          </div>
          <div class="card-body">
            <?php if ($departments) : ?>
              <?php foreach ($departments as $department) : ?>
                <div class='card mt-3'>
                  <div class="card-body">
                    <h5><?= $department['dept_name']; ?></h5>
                    <div>
                      <p>
                        <?= $department['hod']; ?>
                      </p>
                      <p>
                        <?= $department['mob']; ?>
                      </p>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <p>No Departments Added</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script type='module' src="<?= ASSETS_URL . 'js/department.js' ?>"></script>
</body>

</html>