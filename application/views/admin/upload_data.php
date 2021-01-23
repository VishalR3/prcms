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
            <form id="emp_batch_form" enctype="multipart/form-data">
              <div class="form-group mb-3">
                <label class="form-label" for='upload'>Upload CSV file</label>
                <input type='file' name='upload' id='upload' accept=".csv" class="form-control" required>
                <div class="invalid-feedback">
                  Please provide a file.
                </div>
              </div>
              <div id="upload_progress" class="my-3">

              </div>
              <button type="submit" class="btn btn-primary">Upload</button>
            </form>
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
  <script src="<?= ASSETS_URL . 'js/init.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/upload_data.js' ?>"></script>



</body>

</html>