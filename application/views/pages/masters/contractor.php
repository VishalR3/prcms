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
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <p class="text-center">Add Contractor</p>
          </div>
          <div class="card-body">
            <form id="add_contractor_form">
              <div class="mb-3">
                <label for="cont_name" class="form-label">Contractor Name</label>
                <input type='text' name='cont_name' id='cont_name' class="form-control" />
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address </label>
                <select name='address' class="form-select" id='address'>
                  <?php foreach ($locations as $location) : ?>
                    <option value="<?= $location['loc_id']; ?>"><?= $location['loc_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-3">
                <label for="cont_person_name" class="form-label">Cont. Person Name </label>
                <input type='text' name="cont_person_name" id="cont_person_name" class="form-control" />
              </div>


              <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number </label>
                <input type='text' name='mobile' id='mobile' class="form-control" />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email </label>
                <input type='text' name='email' id='email' class="form-control" />
              </div>

              <div class="mb-3">
                <h6>Active</h6>
                <div class="form-check">
                  <input class="form-check-input" type='radio' name='active' id="active_false" value="0" />
                  <label class='form-check-label' for='active_false'>False</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type='radio' name='active' id="active_true" value="1" />
                  <label class='form-check-label' for='active_true'>True</label>
                </div>
              </div>
              <button type='submit' class='btn btn-primary'>Add Contractor</button>

            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <p class='text-center'>Existing Contractors</p>
          </div>
          <div class="card-body">
            <?php if ($contractors) : ?>
              <?php foreach ($contractors as $contractor) : ?>
                <div class='card mt-3'>
                  <div class="card-body">
                    <h5><?= $contractor['cont_name']; ?></h5>
                    <div>
                      <p><?= $contractor['address']; ?></p>
                      <p> <?= $contractor['mobile']; ?></p>
                      <p> <?= $contractor['email']; ?></p>
                      <p> <?php if ($contractor['active']) {
                            echo "Active";
                          } else {
                            echo "Deactivated";
                          } ?></p>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <p>No Contractors Here</p>
            <?php endif; ?>
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