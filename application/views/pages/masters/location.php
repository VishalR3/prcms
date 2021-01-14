<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Location - Admin </title>
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
            <p class="text-center">Add Location</p>
          </div>
          <div class="card-body">
            <form id="add_location_form">
              <div class="mb-3">
                <label for="loc_name" class="form-label">Location Name</label>
                <input type='text' name='loc_name' id='loc_name' class="form-control" />
              </div>
              <div class="mb-3">
                <label for="loc_address" class="form-label">Address</label>
                <input type='text' name='loc_address' id='loc_address' class="form-control" />
              </div>

              <button type='submit' class='btn btn-primary'>Add Location</button>

            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <p class='text-center'>Existing Locations</p>
          </div>
          <div class="card-body">
            <?php if ($locations) : ?>
              <?php foreach ($locations as $location) : ?>
                <div class='card  mt-3 br-2 details_card'>
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h5><?= $location['loc_name']; ?></h5>
                        <span class="id">Location ID : <?= $location['loc_id']; ?></span>
                      </div>
                      <div class='edit_div'>
                        <a href="<?= SITE_ROOT; ?>masters/edit/location/<?= $location['loc_id']; ?>" class='edit_btn'><i class="fa fa-edit mr-2"></i>Edit Location</a>
                      </div>
                    </div>
                    <div class="details">
                      <span class="detail">Address : <?= $location['loc_address']; ?></span>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <p>No Location Added</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script type='module' src="<?= ASSETS_URL . 'js/location.js' ?>"></script>
</body>

</html>