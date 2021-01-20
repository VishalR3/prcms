<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Company - Admin</title>
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
            <h5 class="text-center">Edit Company</h5>
          </div>
          <div class="card-body">
            <form id="edit_company_form" method="POST" action="<?= SITE_ROOT; ?>masters/update/company/<?= $company['comp_id']; ?>">
              <div class="mb-3">
                <label for="comp_name" class="form-label">Name of the Company</label>
                <input type='text' name='comp_name' id='comp_name' value="<?= $company['comp_name']; ?>" class="form-control" />
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address </label>
                <select name='address' id='address' class="form-select">
                  <?php foreach ($locations as $location) : ?>
                    <option value="<?= $location['loc_id']; ?>" <?= ($company['address'] == $location['loc_id']) ? "selected" : "" ?>><?= $location['loc_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="cin" class="form-label">Company Identification Number</label>
                <input type='text' name='cin' id='cin' value="<?= $company['cin']; ?>" class="form-control" />
              </div>
              <div class="mb-3">
                <label for="cont_person" class="form-label">Contractor </label>
                <select name='cont_person' id='cont_person' class="form-select">
                  <?php foreach ($contractors as $contractor) : ?>
                    <option value="<?= $contractor['cont_id']; ?>" <?= ($company['cont_person'] == $contractor['cont_id']) ? "selected" : "" ?>><?= $contractor['cont_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>


              <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number </label>
                <input type='text' name='mobile' id='mobile' value="<?= $company['mobile']; ?>" class="form-control" />
              </div>

              <div class="mb-3">
                <h6>Weekly Off</h6>
                <div class="form-check">
                  <input class="form-check-input" type='radio' name='weekly_off' id="weekly_off_false" value="0" <?= ($company['weekly_off']) ? '' : 'checked' ?> />
                  <label class='form-check-label' for='weekly_off_false'>False</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type='radio' name='weekly_off' id="weekly_off_true" value="1" <?= ($company['weekly_off']) ? 'checked' : '' ?> />
                  <label class='form-check-label' for='weekly_off_true'>True</label>
                </div>
              </div>
              <button type='submit' class='btn btn-primary'>Update Company</button>
              <a href='<?= SITE_ROOT; ?>masters/delete/company/<?= $company['comp_id']; ?>' class="btn btn-danger delete_btn">Delete Company</a>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script type='module' src="<?= ASSETS_URL . 'js/company.js' ?>"></script>
</body>

</html>