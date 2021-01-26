<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>GateKeeper | Home</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/style.css' ?>">
  <?= $links; ?>

</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <div class="row">
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <div class="mb-3">
              <label for="master_type" class='form-label'>Select Data Type</label>
              <select name='master_type' id="master_type" class='form-select'>
                <option value='employee'>Employee</option>
                <option value='company'>Company</option>
                <option value='location'>Location</option>
                <option value='shift'>Shift</option>
                <option value='contractor'>Contractor</option>
                <option value='department'>Department</option>
                <option value='holiday'>Holiday</option>
              </select>
            </div>

            <a id='download_template' href='<?= ASSETS_URL; ?>templates/employee.csv' class='btn btn-primary'>Download Template</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <form id="upload_batch_form">
              <div class="form-group mb-3">
                <label class="form-label" for='upload'>Upload CSV file</label>
                <input type='file' name='upload' id='upload' accept=".csv" class="form-control" required>
                <div class="invalid-feedback">
                  Please provide a file.
                </div>
              </div>
              <div id="upload_progress" class="my-3">

              </div>
            </form>
            <button id='emp_batch_btn' class="btn btn-primary">Upload Employee Data</button>
            <button id='comp_batch_btn' class="btn btn-primary" style='display:none'>Upload Company Data</button>
            <button id='loc_batch_btn' class="btn btn-primary" style='display:none'>Upload Location Data</button>
            <button id='shift_batch_btn' class="btn btn-primary" style='display:none'>Upload Shift Data</button>
            <button id='cont_batch_btn' class="btn btn-primary" style='display:none'>Upload Contractor Data</button>
            <button id='dept_batch_btn' class="btn btn-primary" style='display:none'>Upload Department Data</button>
            <button id='holiday_batch_btn' class="btn btn-primary" style='display:none'>Upload Holiday Data</button>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-header">
        <h5 class="text-center">Preview Data</h5>
      </div>
      <div class="card-body">
        <table class="table table-responsive text-center" id='data_table'></table>
      </div>
    </div>
  </div>

  <?= $footer; ?>
  <?= $scripts; ?>

  <script src="<?= ASSETS_URL . 'js/jquery.csv.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/upload_data.js' ?>"></script>



</body>

</html>