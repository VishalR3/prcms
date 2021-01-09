<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Contractor - Admin</title>
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
            <h5>Add Employee</h5>
          </div>
          <div class="card-body">
            <form id="add_employee_form">
              <div class="form-floating mb-3">
                <input type="text" name="name" id="name" class='form-control' placeholder="name">
                <label for="name" class="form-label">Name</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" name="mobile" id="mobile" class='form-control' placeholder="mobile">
                <label for="mobile" class="form-label">Mobile</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" name="email" id="email" class='form-control' placeholder="email">
                <label for="email" class="form-label">Email</label>
              </div>
              <div class="mb-3">
                <label for="location">Location</label>
                <select name='location' id='location' class="form-select">
                  <?php foreach ($locations as $location) : ?>
                    <option value='<?= $location['loc_id']; ?>'><?= $location['loc_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="shift">Shift</label>
                <select name='shift' id='shift' class="form-select">
                  <?php foreach ($shifts as $shift) : ?>
                    <option value='<?= $shift['shift_id']; ?>'><?= $shift['shift_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="dept">Department</label>
                <select name='dept' id='dept' class="form-select">
                  <?php foreach ($departments as $department) : ?>
                    <option value='<?= $department['dept_id']; ?>'><?= $department['dept_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <h6>Status</h6>
                <div class="form-check">
                  <input class="form-check-input" type='radio' name='status' id="status_p" value="0" />
                  <label class='form-check-label' for='status_c'>C</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type='radio' name='status' id="status_c" value="1" />
                  <label class='form-check-label' for='status_p'>P</label>
                </div>
              </div>
              <div class="mb-3">
                <label for="cont">Contractor</label>
                <select name='cont' id='cont' class="form-select">
                  <?php foreach ($contractors as $contractor) : ?>
                    <option value='<?= $contractor['cont_id']; ?>'><?= $contractor['cont_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <button type='submit' class="btn btn-primary">Add Employee</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h5>Employee List</h5>
          </div>
          <div class="card-body">
            <div class="input-group my-3">
              <input type="text" class="form-control" placeholder="Search An Employee">
              <div class="input-group-append">
                <span class="input-group-text" id='input-icon'>
                  <i class="fa fa-search"></i>
                </span>
              </div>
            </div>
            <?php if ($employees) : ?>
              <?php foreach ($employees as $employee) : ?>
                <div class="card mt-3">
                  <div class="card-body">
                    <h6><?= $employee['name']; ?></h6>
                    <span class="emp_id">Emp ID : <?= $employee['empID']; ?></span>
                  </div>
                  <div class="card-footer">
                    <a href='<?= SITE_ROOT; ?>admin/employee/<?= $employee['empID']; ?>'>More Details</a>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              No Employees
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script type='module' src="<?= ASSETS_URL . 'js/employee.js' ?>"></script>
</body>

</html>