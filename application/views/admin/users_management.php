<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>GateKeeper | Home</title>
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
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h5 class='text-center'>Add User</h5>
          </div>
          <div class="card-body">
            <form id="reg_user_form">
              <div class="form-group form-floating mb-3">
                <input type="text" name="username" id='username' placeholder="username" class="form-control" />
                <label for='username'>Full Name</label>
              </div>
              <div class="form-group form-floating mb-3">
                <input type="text" name="mobile" id='mobile' placeholder="mobile" class="form-control" />
                <label for='username'>Mobile</label>
              </div>
              <div class="form-group form-floating mb-3">
                <input type="text" name="password" id='password' placeholder="password" class="form-control" />
                <label for='username'>Password</label>
              </div>
              <div class="form-check mb-3">
                <input type="checkbox" name="is_employee" id='is_employee' value="1" class="form-check-input" checked />
                <label for='is_employee' class="form-check-label">Is Employee</label>
              </div>
              <div class="form-group form-floating mb-3" id='empIdDiv'>
                <input type="text" name="empID" id='empID' placeholder="empID" class="form-control" />
                <label for='username'>Employee ID (Search Employee By Name)</label>
              </div>
              <div class="form-group mb-3">
                <label for='role' class="form-label">Role</label>
                <select name="role" id='role' class="form-select">
                  <?php foreach ($roles as $role) : ?>
                    <option value="<?= $role['_id']; ?>"><?= $role['role']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Add User</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h5 class='text-center'>Users</h5>
          </div>
          <div class="card-body" id="users_list">
            <?php if ($users) : ?>
              <?php foreach ($users as $user) : ?>
                <div class="card mt-3 br-2 user_card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h5><?= $user['username']; ?></h5>
                        <span class='userId'>User ID : <?= $user['user_id']; ?></span>
                      </div>
                      <div class='edit_div'>
                        <a href='<?= SITE_ROOT; ?>admin/edit/user/<?= $user['user_id']; ?>' class="edit_btn"><i class="fa fa-edit mx-2"></i>Edit User</a>
                      </div>
                    </div>
                    <div class='user_details'>
                      <span class='detail'>Mobile : <?= $user['mobile']; ?></span>
                      <span class='detail'>Email : <?= $user['data']['email']; ?></span>
                    </div>
                    <div class='user_role' style="background-color: <?= $user['role_color']; ?>;">
                      <?= $user['role']; ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <h5>No Users</h5>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?= $footer; ?>
  <?= $scripts; ?>

  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  <script src="<?= ASSETS_URL . 'js/jsx.js' ?>"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type='text/babel' src="<?= ASSETS_URL . 'js/admin.js' ?>"></script>



</body>

</html>