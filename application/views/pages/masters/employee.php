<?php $access = json_decode($this->session->userdata('access')); ?>
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
              <h5 class='text-center'>Add Employee</h5>
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
                <div class="row">
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="location">Location</label>
                      <select name='location' id='location' class="form-select">
                        <?php foreach ($locations as $location) : ?>
                          <option value='<?= $location['loc_id']; ?>'><?= $location['loc_name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="shift">Shift</label>
                      <select name='shift' id='shift' class="form-select">
                        <?php foreach ($shifts as $shift) : ?>
                          <option value='<?= $shift['shift_id']; ?>'><?= $shift['shift_name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="dept">Department</label>
                      <select name='dept' id='dept' class="form-select">
                        <?php foreach ($departments as $department) : ?>
                          <option value='<?= $department['dept_id']; ?>'><?= $department['dept_name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for='dob'>Date Of Birth</label>
                      <input type="date" name='dob' id='dob' class='form-control' />
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <h6>Status</h6>
                  <div class="form-check">
                    <input class="form-check-input" type='radio' name='status' id="status_c" value="1" />
                    <label class='form-check-label' for='status_c'>C</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type='radio' name='status' id="status_p" value="0" />
                    <label class='form-check-label' for='status_p'>P</label>
                  </div>
                </div>
                <div id="cont_div" class="mb-3" style='display:none;'>
                  <label for="cont">Contractor</label>
                  <select name='cont' id='cont' class="form-select">
                    <?php foreach ($contractors as $contractor) : ?>
                      <option value='<?= $contractor['cont_id']; ?>'><?= $contractor['cont_name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="mb-3">
                  <h6>Weekly Off</h6>
                  <select name='weekly_off' id='weekly_off' class='form-select'>
                    <option value="1">Sunday</option>
                    <option value="2">Monday</option>
                    <option value="3">Tuesday</option>
                    <option value="4">Wednesday</option>
                    <option value="5">Thursday</option>
                    <option value="6">Friday</option>
                    <option value="7">Saturday</option>
                  </select>
                </div>
                <button type='submit' class="btn btn-primary">Add Employee</button>
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
            <h5 class='text-center'>Employee List</h5>
          </div>
          <div class="card-body">
            <div class="input-group my-3">
              <input type="text" class="form-control" name="searchEmp" id='searchEmp' placeholder="Search An Employee">
              <div class="input-group-append">
                <span class="input-group-text" id='input-icon'>
                  <i class="fa fa-search"></i>
                </span>
              </div>
            </div>
            <?php if ($employees) : ?>
              <?php foreach ($employees as $employee) : ?>
                <div class="card mt-3 br-2 details_card" id='emp<?= $employee['empID']; ?>'>
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h5><?= $employee['name']; ?></h5>
                        <span class="id">Emp ID : <?= $employee['empID']; ?></span>
                      </div>
                      <div class='edit_div'>
                        <a href="<?= SITE_ROOT; ?>masters/edit/employee/<?= $employee['empID']; ?>" class='edit_btn'><i class="fa fa-edit mr-2"></i>Edit Employee</a>
                      </div>
                    </div>
                    <div class="details">
                      <span class='detail'><i class="fa fa-phone-square mr-2"></i><?= $employee['mobile']; ?></span>
                      <span class='detail'><i class="fa fa-envelope mr-2"></i><?= $employee['email']; ?></span>
                    </div>
                  </div>
                  <div class="card-footer">
                    <a href='<?= SITE_ROOT; ?>admin/employee/<?= $employee['empID']; ?>'>More Details<i class="fa fa-arrow-circle-right ml-2"></i></a>
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
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="<?= ASSETS_URL . 'js/employee.js' ?>"></script>
</body>

</html>