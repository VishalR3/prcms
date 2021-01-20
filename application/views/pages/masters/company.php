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
            <h5 class="text-center">Add Company</h5>
          </div>
          <div class="card-body">
            <form id="add_company_form">
              <div class="mb-3">
                <label for="comp_name" class="form-label">Name of the Company</label>
                <input type='text' name='comp_name' id="comp_name" class="form-control" />
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address </label>
                <select name='address' id='address' class="form-select">
                  <?php foreach ($locations as $location) : ?>
                    <option value="<?= $location['loc_id']; ?>"><?= $location['loc_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="cin" class="form-label">Company Identification Number</label>
                <input type='text' name='cin' id='cin' class="form-control" />
              </div>
              <div class="mb-3">
                <label for="cont_person" class="form-label">Contractor </label>
                <select name='cont_person' id='cont_person' class="form-select">
                  <?php foreach ($contractors as $contractor) : ?>
                    <option value="<?= $contractor['cont_id']; ?>"><?= $contractor['cont_name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>


              <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number </label>
                <input type='text' name='mobile' id='mobile' class="form-control" />
              </div>

              <div class="mb-3">
                <h6>Weekly Off</h6>
                <div class="form-check">
                  <input class="form-check-input" type='radio' name='weekly_off' id="weekly_off_false" value="0" />
                  <label class='form-check-label' for='weekly_off_false'>False</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type='radio' name='weekly_off' id="weekly_off_true" value="1" />
                  <label class='form-check-label' for='weekly_off_true'>True</label>
                </div>
              </div>
              <button type='submit' class='btn btn-primary'>Add Company</button>

            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h5 class='text-center'>Existing Companies</h5>
          </div>
          <div class="card-body">
            <?php if ($companies) : ?>
              <?php foreach ($companies as $company) : ?>
                <div class='card mt-3 br-2 details_card'>
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h5><?= $company['comp_name']; ?></h5>
                        <span class='id'>Company ID : <?= $company['comp_id']; ?></span>
                      </div>
                      <div class='edit_div'>
                        <a href="<?= SITE_ROOT; ?>masters/edit/company/<?= $company['comp_id']; ?>" class='edit_btn'><i class="fa fa-edit mr-2"></i> Edit Company</a>
                      </div>
                    </div>
                    <div class="details">
                      <span class='detail'><?= $company['address']; ?></span>
                      <span class='detail'> <?= $company['cont_person']; ?></span>
                      <span class='detail'><i class="fa fa-phone-square"></i> <?= $company['mobile']; ?></span>
                      <span class='detail'> <?php if ($company['weekly_off']) {
                                              echo "<i class='fa fa-check mr-2'></i>Weekly Off";
                                            } else {
                                              echo "<i class='fa fa-times mr-2'></i>No Weekly Off";
                                            } ?> </span>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <p>No Companies Here</p>
            <?php endif; ?>
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