<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Contractor - Admin</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/style.css' ?>">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <?= $links; ?>
  <script type="text/javascript">
    initApp = function() {
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          // User is signed in.
          var uid = user.uid;
          var phoneNumber = user.phoneNumber;
          var providerData = user.providerData;
          user.getIdToken().then(function(accessToken) {
            document.getElementById('sign-in').textContent = 'Sign out ' + phoneNumber;
            document.getElementById('v_mobile').value = phoneNumber;
            document.getElementById('uid').value = uid;
            console.log({
              phoneNumber: phoneNumber,
              uid: uid,
              accessToken: accessToken,
            });
          });
        } else {
          // User is signed out.
          document.getElementById('sign-in').textContent = 'Sign in';
        }
      }, function(error) {
        console.log(error);
      });
    };

    window.addEventListener('load', function() {
      initApp()
    });
  </script>
</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <div class="page-heading">
      <div class="d-flex justify-content-between">
        <div>
          <h4>Visitors Management</h4>
        </div>
        <div>
          <button id='sign_visitor_out' class='btn btn-primary'>
            <span id="sign-in"></span>
            <i class="fa fa-sign-out"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="row g-4 mt-3">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <form id="visitor_details_form">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type='text' name='name' id='name' class="form-control" />
                <input type='hidden' name='uid' id='uid' class="form-control" />
              </div>
              <div class="mb-3">
                <label for="v_mobile" class="form-label">Mobile</label>
                <input type='text' name='v_mobile' id='v_mobile' value="" disabled class="form-control" />
              </div>
              <div class="mb-3">
                <label for="from_comp" class="form-label">From Company</label>
                <select name='from_comp' id='from_comp' class="form-select">
                  <?php foreach ($companies as $company) : ?>
                    <option value="<?= $company['comp_id']; ?>"><?= $company['comp_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="no_of_people" class="form-label">Number Of People</label>
                <input type='text' name='no_of_people' id='no_of_people' class="form-control" />
              </div>
              <div class="mb-3">
                <label for="to_meet" class="form-label">Employee To Meet </label>
                <select name='to_meet' class="form-select" id='to_meet'>
                  <?php foreach ($employees as $employee) : ?>
                    <option value="<?= $employee['empID']; ?>"><?= $employee['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="purpose" class="form-label">Reason For Visiting </label>
                <select name='purpose' id='purpose' class="form-select">
                  <?php foreach ($purposes as $purpose) : ?>
                    <option value="<?= $purpose['purp_id']; ?>"><?= $purpose['purpose']; ?></option>
                  <?php endforeach; ?>
                  <option value="0">Other</option>
                </select>
              </div>
              <div class="mb-3">
                <input type='text' name='alt_purp' id='alt_purp' class="form-control d-none" />
              </div>
              <div class="mb-3">
                <label for='date_from' class="form-label">Preferred Date and Time From</label>
                <div class="row">
                  <div class="col">
                    <input type="date" name="date_from" id="date_from" class="form-control">
                  </div>
                  <div class="col">
                    <input type="time" name="time_from" id="time_from" class="form-control">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for='date_to' class="form-label">Preferred Date and Time to</label>
                <div class="row">
                  <div class="col">
                    <input type="date" name="date_to" id="date_to" class="form-control">
                  </div>
                  <div class="col">
                    <input type="time" name="time_to" id="time_to" class="form-control">
                  </div>
                </div>
              </div>
              <button type='submit' class='btn btn-primary form-control'>Submit</button>

            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="input-group my-3">
              <input type="text" class="form-control" placeholder="Search Previous Visits">
              <div class="input-group-append">
                <span class="input-group-text" id='input-icon'>
                  <i class="fa fa-search"></i>
                </span>
              </div>
            </div>
            <div id="previous_visits">
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script src="<?= ASSETS_URL . 'js/jsx.js' ?>"></script>
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  <script type='text/babel' src="<?= ASSETS_URL . 'js/visitor.js' ?>"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


</body>

</html>