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

</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h5>Add User</h5>
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
                <input type="checkbox" name="is_employee" id='is_employee' value="1" class="form-check-input" />
                <label for='is_employee' class="form-check-label">Is Employee</label>
              </div>
              <div class="form-group form-floating mb-3" id='empIdDiv'>
                <input type="text" name="empID" id='empID' placeholder="empID" class="form-control" />
                <label for='username'>Employee ID</label>
              </div>
              <div class="form-group mb-3">
                <label for='role' class="form-label">Role</label>
                <select name="role" id='role' class="form-select">
                  <option value="1">Manager</option>
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
            <h5>Users</h5>
          </div>
          <div class="card-body">
            <?php if ($users) : ?>
              <?php foreach ($users as $user) : ?>
                <div class="card mt-3">
                  <div class="card-body">
                    <h6><?= $user['username']; ?></h6>
                    <span class='userid'>User ID : <?= $user['user_id']; ?></span>
                    <div class="userdata">
                      <pre id="json">
                      <?php $data = json_encode($user);
                      echo $data;
                      ?>
                    </pre>
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

  <script type='module' src="<?= ASSETS_URL . 'js/admin.js' ?>"></script>
  <script type='module' src="<?= ASSETS_URL . 'js/init.js' ?>"></script>



</body>

</html>