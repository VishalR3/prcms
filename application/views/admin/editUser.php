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
      <div class="col-sm-6 offset-sm-3">
        <div class="card">
          <div class="card-header">
            <h5 class='text-center'>Edit User</h5>
          </div>
          <div class="card-body">
            <form id="edit_user_form" method="POST" action="<?= SITE_ROOT; ?>admin/update/user/<?= $user['user_id']; ?>">
              <div class="form-group form-floating mb-3">
                <input type="text" name="username" id='username' placeholder="username" value="<?= $user['username']; ?>" class="form-control" />
                <label for='username'>Full Name</label>
              </div>
              <div class="form-group mb-3">
                <label for='role' class="form-label">Role</label>
                <select name="role" id='role' class="form-select">
                  <?php foreach ($roles as $role) : ?>
                    <option value="<?= $role['_id']; ?>" <?= ($role['_id'] == $user['role']) ? 'selected' : '' ?>><?= $role['role']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Edit User</button>
              <a href='<?= SITE_ROOT; ?>admin/delete/user/<?= $user['user_id']; ?>' class="btn btn-danger delete_btn">Delete User</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?= $footer; ?>
  <?= $scripts; ?>

  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  <script src="<?= ASSETS_URL . 'js/jsx.js' ?>"></script>
  <script type='text/babel' src="<?= ASSETS_URL . 'js/admin.js' ?>"></script>



</body>

</html>