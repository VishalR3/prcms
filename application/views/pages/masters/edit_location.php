<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Edit Location | PRCMS</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/style.css' ?>">
  <?= $links; ?>
</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <div class="row g-4">
      <div class="col-sm-6 offset-sm-3">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center">Edit Location</h5>
          </div>
          <div class="card-body">
            <form id="edit_location_form" method="POST" action="<?= SITE_ROOT; ?>masters/update/location/<?= $location['loc_id']; ?>">
              <div class="mb-3">
                <label for="loc_name" class="form-label">Location Name</label>
                <input type='text' name='loc_name' id='loc_name' value="<?= $location['loc_name']; ?>" class="form-control" />
              </div>
              <div class="mb-3">
                <label for="loc_address" class="form-label">Address</label>
                <input type='text' name='loc_address' id='loc_address' value="<?= $location['loc_address']; ?>" class="form-control" />
              </div>

              <button type='submit' class='btn btn-primary'>Update Location</button>
              <a href='<?= SITE_ROOT; ?>masters/delete/location/<?= $location['loc_id']; ?>' class="btn btn-danger delete_btn">Delete Location</a>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script src="<?= ASSETS_URL . 'js/location.js' ?>"></script>
</body>

</html>