<?php $access = json_decode($this->session->userdata('access')); ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Company | PRCMS</title>
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
                  <select name='weekly_off' class='form-select'>
                    <option value="1">Sunday</option>
                    <option value="2">Monday</option>
                    <option value="3">Tuesday</option>
                    <option value="4">Wednesday</option>
                    <option value="5">Thursday</option>
                    <option value="6">Friday</option>
                    <option value="7">Saturday</option>
                  </select>
                </div>
                <button type='submit' class='btn btn-primary'>Add Company</button>

              </form>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="col-sm-6 <?php if (!in_array('master.write', $access)) {
                              echo "offset-sm-3";
                            } ?>">
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
                      <span class='detail'>
                        <?php switch ($company['weekly_off']) {
                          case '1':
                            echo "Sunday Off";
                            break;
                          case '2':
                            echo "Monday Off";
                            break;
                          case '3':
                            echo "Tuesday Off";
                            break;
                          case '4':
                            echo "Wednesday Off";
                            break;
                          case '5':
                            echo "Thursday Off";
                            break;
                          case '6':
                            echo "Friday Off";
                            break;
                          case '7':
                            echo "Saturday Off";
                            break;
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
  <script src="<?= ASSETS_URL . 'js/company.js' ?>"></script>
</body>

</html>