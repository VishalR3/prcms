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
            <h5>Add Role</h5>
          </div>
          <div class="card-body">
            <form id="add_role_form">
              <div class="form-group form-floating mb-3">
                <input type="text" name="role" id='role' placeholder="role" class="form-control" />
                <label for='username'>Role</label>
              </div>
              <div class="form-group form-floating mb-3">
                <input type="text" name="roleColor" id='roleColor' placeholder="roleColor" class="form-control" />
                <label for='roleColor'>Role Color</label>
              </div>
              <h6>Permisssions</h6>
              <div class="form-check mb-3">
                <input type="checkbox" name="access" id='admin' value="admin" class="form-check-input" />
                <label for='admin' class="form-check-label">Admin (Highest Access)</label>
              </div>
              <div class="form-check mb-3">
                <input type="checkbox" name="access" id='allRead' value="all.read" class="form-check-input" />
                <label for='allRead' class="form-check-label">All Reads</label>
              </div>
              <div class="form-check mb-3">
                <input type="checkbox" name="access" id='alWrite' value="all.write" class="form-check-input" />
                <label for='allWrite' class="form-check-label">All Writes</label>
              </div>
              <div class="form-check mb-3">
                <input type="checkbox" name="access" id='allDelete' value="all.delete" class="form-check-input" />
                <label for='allDelete' class="form-check-label">All Deletes</label>
              </div>
              <button type="submit" class="btn btn-primary">Add Role</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h5>Roles</h5>
          </div>
          <div class="card-body">

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