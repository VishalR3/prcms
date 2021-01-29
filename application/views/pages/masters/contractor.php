<?php $access = json_decode($this->session->userdata('access')); ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Contractor | PRCMS</title>
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
      <?php if (in_array('master.write', $access)) : ?>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-header">
              <h5 class="text-center">Add Contractor</h5>
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
                    <input class="form-check-input" type='radio' name='active' id="active_true" value="1" checked />
                    <label class='form-check-label' for='active_true'>True</label>
                  </div>
                </div>
                <button type='submit' class='btn btn-primary'>Add Contractor</button>

              </form>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="col-sm-6 <?php if (!in_array('master.write', $access)) {
                              echo "offset-sm-3";
                            } ?>">
        <div class="card ">
          <div class="card-header">
            <h5 class='text-center'>Existing Contractors</h5>
          </div>
          <div class="card-body">
            <?php if ($contractors) : ?>
              <?php foreach ($contractors as $contractor) : ?>
                <div class='card mt-3 br-2 details_card'>
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div>
                        <h5><?= $contractor['cont_name']; ?></h5>
                        <span class="id">Contractor ID : <?= $contractor['cont_id']; ?></span>
                      </div>
                      <div class='edit_div'>
                        <a href="<?= SITE_ROOT; ?>masters/edit/contractor/<?= $contractor['cont_id']; ?>" class='edit_btn'><i class="fa fa-edit mr-2"></i> Edit Contractor</a>
                      </div>
                    </div>
                    <div class="details">
                      <span class='detail'><?= $contractor['address']; ?></span>
                      <span class='detail'> <?= $contractor['mobile']; ?></span>
                      <span class='detail'> <?= $contractor['email']; ?></span>
                      <span class='detail'> <?php if ($contractor['active']) {
                                              echo "Active";
                                            } else {
                                              echo "Deactivated";
                                            } ?></span>
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
  <script src="<?= ASSETS_URL . 'js/contractor.js' ?>"></script>
</body>

</html>