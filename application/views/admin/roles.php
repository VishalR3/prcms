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
            <h5 class='text-center'>Add Role</h5>
          </div>
          <div class="card-body">
            <form id="add_role_form">
              <div class="form-group form-floating mb-3">
                <input type="text" name="role" id='role' placeholder="role" class="form-control" />
                <label for='username'>Role</label>
              </div>
              <div class="form-group form-floating mb-3">
                <!-- <input type="text" name="roleColor" id='roleColor' placeholder="roleColor" class="form-control" disabled />
                <label for='roleColor'>Role Color</label> -->
                <div class='mt-3' id="colorTest">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>

                      <button class='btn btn-primary m-2' id="color_change_btn">Change Role Color</button>
                    </div>
                    <div>
                      <span class='px-3' id='roleColor'></span>
                    </div>

                  </div>
                </div>
              </div>
              <h6>Permisssions</h6>
              <div class="form-check mb-3">
                <input type="checkbox" name="access" id='admin' value="admin" class="form-check-input" />
                <label for='admin' class="form-check-label">Admin (Highest Access)</label>
              </div>
              <div class="row">
                <div class="col-sm-6 mt-3">
                  <div class="form-check mb-3">
                    <input type="checkbox" name="accesshelper" id='allRead' value="all.read" class="form-check-input" />
                    <label for='allRead' class="form-check-label">All Reads</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="accesshelper" id='allWrite' value="all.write" class="form-check-input" />
                    <label for='allWrite' class="form-check-label">All Writes</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="accesshelper" id='allUpdate' value="all.update" class="form-check-input" />
                    <label for='allUpdate' class="form-check-label">All Update</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="accesshelper" id='allDelete' value="all.delete" class="form-check-input" />
                    <label for='allDelete' class="form-check-label">All Deletes</label>
                  </div>
                </div>
                <div class="col-sm-6 mt-3">
                  <div class="form-check mb-3">
                    <input type="checkbox" name="accesshelper" id='employeeAll' value="employee.all" class="form-check-input" />
                    <label for='employeeAll' class="form-check-label">Employee All</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="access" id='employeeRead' value="employee.read" class="form-check-input" />
                    <label for='employeeRead' class="form-check-label">Employee Reads</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="access" id='employeeWrite' value="employee.write" class="form-check-input" />
                    <label for='employeeWrite' class="form-check-label">Employee Writes</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="access" id='employeeUpdate' value="employee.update" class="form-check-input" />
                    <label for='employeeUpdate' class="form-check-label">Employee Update</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="access" id='employeeDelete' value="employee.delete" class="form-check-input" />
                    <label for='employeeDelete' class="form-check-label">Employee Deletes</label>
                  </div>
                </div>
                <div class="col-sm-6 mt-3">
                  <div class="form-check mb-3">
                    <input type="checkbox" name="accesshelper" id='masterAll' value="master.all" class="form-check-input" />
                    <label for='masterAll' class="form-check-label">Master All</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="access" id='masterRead' value="master.read" class="form-check-input" />
                    <label for='masterRead' class="form-check-label">Master Reads</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="access" id='masterWrite' value="master.write" class="form-check-input" />
                    <label for='masterWrite' class="form-check-label">Master Writes</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="access" id='masterUpdate' value="master.update" class="form-check-input" />
                    <label for='masterUpdate' class="form-check-label">Master Update</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="access" id='masterDelete' value="master.delete" class="form-check-input" />
                    <label for='masterDelete' class="form-check-label">Master Deletes</label>
                  </div>
                </div>
                <div class="col-sm-6 mt-3">
                  <div class="form-check mb-3">
                    <input type="checkbox" name="accesshelper" id='reportAll' value="report.all" class="form-check-input" />
                    <label for='reportAll' class="form-check-label">Report All</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="access" id='reportRead' value="report.read" class="form-check-input" />
                    <label for='reportRead' class="form-check-label">Report Reads</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="access" id='reportWrite' value="report.write" class="form-check-input" />
                    <label for='reportWrite' class="form-check-label">Report Writes</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="access" id='reportUpdate' value="report.update" class="form-check-input" />
                    <label for='reportUpdate' class="form-check-label">Report Update</label>
                  </div>
                  <div class="form-check mb-3">
                    <input type="checkbox" name="access" id='reportDelete' value="report.delete" class="form-check-input" />
                    <label for='reportDelete' class="form-check-label">Report Deletes</label>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Add Role</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h5 class='text-center'>Roles</h5>
          </div>
          <div class="card-body">
            <?php foreach ($roles as $role) : ?>
              <div class="card mt-3 details_card" style="background-color: <?= $role['roleColor']; ?>;">
                <div class="card-body">
                  <h5><?= $role['role']; ?></h5>
                  <div>
                    <h6><b>Permisssions</b></h6>
                    <ul>
                      <?php foreach (json_decode($role['access']) as $access) : ?>
                        <li><?= $access; ?></li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?= $footer; ?>
  <?= $scripts; ?>

  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  <script src="<?= ASSETS_URL . 'js/jsx.js' ?>"></script>
  <script type='text/babel' src="<?= ASSETS_URL . 'js/roles.js' ?>"></script>



</body>

</html>