<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Contractor - Admin</title>
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
            <p class="text-center">Edit Contractor</p>
          </div>
          <div class="card-body">
            <form id="edit_contractor_form" method="POST" action="<?= SITE_ROOT; ?>masters/update/contractor/<?= $contractor['cont_id']; ?>">
              <div class="mb-3">
                <label for="cont_name" class="form-label">Contractor Name</label>
                <input type='text' name='cont_name' id='cont_name' value="<?= $contractor['cont_name']; ?>" class="form-control" />
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address </label>
                <select name='address' class="form-select" id='address'>
                  <?php foreach ($locations as $location) : ?>
                    <option value="<?= $location['loc_id']; ?>" <?= ($contractor['address'] == $location['loc_id']) ? 'selected' : '' ?>><?= $location['loc_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-3">
                <label for="cont_person_name" class="form-label">Cont. Person Name </label>
                <input type='text' name="cont_person_name" id="cont_person_name" value="<?= $contractor['cont_person_name']; ?>" class="form-control" />
              </div>


              <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number </label>
                <input type='text' name='mobile' id='mobile' value="<?= $contractor['mobile']; ?>" class="form-control" />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email </label>
                <input type='text' name='email' id='email' value="<?= $contractor['email']; ?>" class="form-control" />
              </div>

              <div class="mb-3">
                <h6>Active</h6>
                <div class="form-check">
                  <input class="form-check-input" type='radio' name='active' id="active_false" value="0" <?= $contractor['active'] ? '' : 'checked' ?> />
                  <label class='form-check-label' for='active_false'>False</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type='radio' name='active' id="active_true" value="1" <?= $contractor['active'] ? 'checked' : '' ?> />
                  <label class='form-check-label' for='active_true'>True</label>
                </div>
              </div>
              <button type='submit' class='btn btn-primary'>Update Contractor</button>
              <a href='<?= SITE_ROOT; ?>masters/delete/contractor/<?= $contractor['cont_id']; ?>' class="btn btn-danger delete_btn">Delete Contractor</a>

            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script type='module' src="<?= ASSETS_URL . 'js/contractor.js' ?>"></script>
</body>

</html>