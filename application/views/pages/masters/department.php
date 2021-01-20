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
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center">Add Department</h5>
          </div>
          <div class="card-body">
            <form id="add_department_form">
              <div class="mb-3">
                <label for="dept_name" class="form-label">Department Name</label>
                <input type='text' name='dept_name' id='dept_name' class="form-control" />
              </div>

              <div class="mb-3">
                <label for="hod" class="form-label">HOD </label>
                <select name="hod" id="hod" class="form-select">
                  <?php foreach ($employees as $employee) : ?>
                    <option value="<?= $employee['empID']; ?>"><?= $employee['name']; ?></option>
                  <?php endforeach; ?>
                </select>
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
            <h5 class='text-center'>Existing Departments</h5>
          </div>
          <div class="card-body">
            <?php if ($departments) : ?>
              <?php foreach ($departments as $department) : ?>
                <div class='card mt-3 br-2 details_card'>
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h5><?= $department['dept_name']; ?></h5>
                        <span class="id">Department ID : <?= $department['dept_id']; ?></span>
                      </div>
                      <div class='edit_div'>
                        <a href="<?= SITE_ROOT; ?>masters/edit/department/<?= $department['dept_id']; ?>" class='edit_btn'><i class="fa fa-edit mr-2"></i> Edit Department</a>
                      </div>
                    </div>
                    <div class="details">
                      <span class="detail">
                        <?= $department['hod']; ?>
                      </span>
                      <span class="detail">
                        <?= $department['mob']; ?>
                      </span>
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