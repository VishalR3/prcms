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
      <div class="col-sm-6 offset-sm-3">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center">Add Department</h5>
          </div>
          <div class="card-body">
            <form id="update_department_form" method="POST" action="<?= SITE_ROOT; ?>masters/update/department/<?= $department['dept_id']; ?>">
              <div class="mb-3">
                <label for="dept_name" class="form-label">Department Name</label>
                <input type='text' name='dept_name' id='dept_name' value="<?= $department['dept_name']; ?>" class="form-control" />
              </div>

              <div class="mb-3">
                <label for="hod" class="form-label">HOD </label>
                <select name="hod" id="hod" class="form-select">
                  <?php foreach ($employees as $employee) : ?>
                    <?php if ($employee['empID'] == $department['hod']) : ?>
                      <option value="<?= $employee['empID']; ?>" selected><?= $employee['name']; ?></option>
                    <?php else : ?>
                      <option value="<?= $employee['empID']; ?>"><?= $employee['name']; ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>


              <div class="mb-3">
                <label for="mob" class="form-label">MOB</label>
                <input type='text' name='mob' id='mob' value="<?= $department['mob']; ?>" class="form-control" />
              </div>

              <button type='submit' class='btn btn-primary'>Update Department</button>
              <a href='<?= SITE_ROOT; ?>masters/delete/department/<?= $department['dept_id']; ?>' class="btn btn-danger delete_btn">Delete Department</a>

            </form>
          </div>
        </div>
      </div>

    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script src="<?= ASSETS_URL . 'js/department.js' ?>"></script>
</body>

</html>