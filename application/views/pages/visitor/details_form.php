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
        <div class="card mb-4">
          <div class="card-body">
            <div class="mb-3">
              <input name="file" type="file" class="cloudinary-fileupload" style="display: none;" data-cloudinary-field="image_id" data-form-data="{ &quot;upload_preset&quot;:  &quot;uyvjq26j&quot;, &quot;callback&quot;: &quot;<?= SITE_ROOT; ?>cloudinary_cors.html&quot;}"></input>
            </div>
            <div class="mb-3">
              <div id="uploadProgress" class="progress" style="display: none;">
                <div class="progress-bar">

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <video class="camera_input mb-3">
                </video>
                <div class="mb-3 text-center">
                  <button id='capture_btn' class='btn btn-default'>Capture Image</button>
                </div>
              </div>
              <div class="col-sm-6 ">
                <canvas class='d-none' id='canvas'></canvas>
                <div id='output'>
                  <img id='photo' style='width:100%;' class='mb-3' />
                  <div class='mt-3 text-center'>
                    <button id="usephoto" class='btn btn-success' style="display: none;">Use This Photo</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <form id="visitor_details_form">
              <div class="row">
                <div class="col-sm-7">
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
                    <label for="no_of_people" class="form-label">Number Of People</label>
                    <input type='text' name='no_of_people' id='no_of_people' class="form-control" />
                  </div>
                </div>
                <div class="col-sm-5">
                  <div class="mb-3">
                    <label for="visitorPhoto" class='form-label'>Visitor Photo</label>
                    <input type='hidden' name="visitorPhoto" id="visitorPhoto">
                  </div>
                  <div id="visitorPhotoPreviewDiv">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="from_comp" class="form-label">From Company</label>
                <input name='from_comp' id='from_comp' class="form-control" />
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
            <div class="searchWrapper">
              <div class="input-group my-3">
                <input type="text" name='searchVisit' id='searchVisit' class="form-control" placeholder="Search Previous Visits">
                <div class="input-group-append">
                  <span class="input-group-text" id='input-icon'>
                    <i class="fa fa-search"></i>
                  </span>
                </div>
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
  <script src="<?= ASSETS_URL . 'js/node_modules/blueimp-file-upload/js/vendor/jquery.ui.widget.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/node_modules/blueimp-file-upload/js/jquery.iframe-transport.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/node_modules/blueimp-file-upload/js/jquery.fileupload.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/node_modules/cloudinary-jquery-file-upload/cloudinary-jquery-file-upload.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/cloudinary.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/visitor-compiled.js' ?>"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


</body>

</html>