<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Contractor List | PRCMS</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/style.css' ?>">
  <?= $links; ?>

</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <h4>Employee List</h4>
    <div class="card mt-3">
      <div class="card-body">
        <label for='empPhoto' id='empUpload' class='d-none'>Upload</label>
        <input type='file' name='file' id='empPhoto' class='d-none' data-cloudinary-field="image_id" data-form-data="{ &quot;upload_preset&quot;:  &quot;vzibl1o1&quot;, &quot;callback&quot;: &quot;<?= SITE_ROOT; ?>cloudinary_cors.html&quot;}" />
        <div id='visitorPhoto'></div>
        <table class='table table-responsive text-center'>
          <thead class='bg-dark text-white shadow'>
            <td scope='col'>S.No</td>
            <td scope='col'>Name</td>
            <td scope='col'>Photo</td>
            <td scope='col'>Status</td>
          </thead>
          <?php $i = 1 ?>
          <?php foreach ($employeesList as $employee) : ?>
            <tr scope='row' data-id="<?= $employee['empID']; ?>">
              <td><?= $i++; ?></td>
              <td><?= $employee['name']; ?></td>
              <td class='photoStatus'>
                <?php if ($employee['photo'] == DEFAULT_PHOTO) : ?>
                  <button class='btn btn-primary upload_emp_btn' data-id='<?= $employee['empID']; ?>'>Upload Picture</button>
                <?php else : ?>
                  <img src='https://res.cloudinary.com/vishaltest/image/upload/<?= $employee['photo']; ?>' height='50' />
                <?php endif; ?>
              </td>
              <td class="small-font" style="vertical-align:middle;">
                <?php if ($employee['photo'] == DEFAULT_PHOTO) : ?>
                  <i>No Photo Uploaded</i>
                <?php else : ?>
                  <i>Face Registered</i>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
  <div class="toastWrapper">
    <div class="toast-container">
      <div class="toast" role="alert" data-bs-autohide="false" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto">Loading Models</strong>
        </div>
        <div class="toast-body">
          <div class="progress" style="height: 5px;">
            <div class="progress-bar" id='models_progress'>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script src="<?= ASSETS_URL . 'js/vendor/face-api/face-api.min.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/node_modules/blueimp-file-upload/js/vendor/jquery.ui.widget.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/node_modules/blueimp-file-upload/js/jquery.iframe-transport.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/node_modules/blueimp-file-upload/js/jquery.fileupload.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/node_modules/cloudinary-jquery-file-upload/cloudinary-jquery-file-upload.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/contractor_list.js' ?>"></script>

</body>

</html>