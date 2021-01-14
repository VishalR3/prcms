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
      <div class="col-sm-6 offset-sm-3">
        <div class="card">
          <div class="card-header">
            <h5 class='text-center'>Edit Employee</h5>
          </div>
          <div class="card-body">
            <form id="edit_employee_form" method="POST" action="<?= SITE_ROOT; ?>masters/update/employee/<?= $employee['empID']; ?>">
              <div class="form-floating mb-3">
                <input type="text" name="name" id="name" class='form-control' value="<?= $employee['name']; ?>" placeholder="name">
                <label for="name" class="form-label">Name</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" name="mobile" id="mobile" class='form-control' value="<?= $employee['mobile']; ?>" placeholder="mobile">
                <label for="mobile" class="form-label">Mobile</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" name="email" id="email" class='form-control' value="<?= $employee['email']; ?>" placeholder="email">
                <label for="email" class="form-label">Email</label>
              </div>
              <div class="mb-3">
                <label for="location">Location</label>
                <select name='location' id='location' class="form-select">
                  <?php foreach ($locations as $location) : ?>
                    <option value='<?= $location['loc_id']; ?>' <?= ($employee['location'] == $location['loc_id']) ? 'selected' : '' ?>><?= $location['loc_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="shift">Shift</label>
                <select name='shift' id='shift' class="form-select">
                  <?php foreach ($shifts as $shift) : ?>
                    <option value='<?= $shift['shift_id']; ?>' <?= ($employee['shift'] == $shift['shift_id']) ? 'selected' : '' ?>><?= $shift['shift_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="dept">Department</label>
                <select name='dept' id='dept' class="form-select">
                  <?php foreach ($departments as $department) : ?>
                    <option value='<?= $department['dept_id']; ?>' <?= ($employee['dept'] == $department['dept_id']) ? 'selected' : '' ?>><?= $department['dept_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <h6>Status</h6>
                <div class="form-check">
                  <input class="form-check-input" type='radio' name='status' id="status_c" value="1" <?= ($employee['status']) ? 'checked' : '' ?> />
                  <label class='form-check-label' for='status_c'>C</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type='radio' name='status' id="status_p" value="0" <?= ($employee['status']) ? '' : 'checked' ?> />
                  <label class='form-check-label' for='status_p'>P</label>
                </div>
              </div>
              <div class="mb-3">
                <label for="cont">Contractor</label>
                <select name='cont' id='cont' class="form-select">
                  <?php foreach ($contractors as $contractor) : ?>
                    <option value='<?= $contractor['cont_id']; ?>' <?= ($employee['cont'] == $contractor['cont_id']) ? 'selected' : '' ?>><?= $contractor['cont_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <button type='submit' class="btn btn-primary">Update Employee</button>
              <a href='<?= SITE_ROOT; ?>masters/delete/employee/<?= $employee['empID']; ?>' class="btn btn-danger delete_btn">Delete Employee</a>
            </form>
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