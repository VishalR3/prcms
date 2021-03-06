<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>Attendance Report | PRCMS</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/style.css' ?>">
  <?= $links; ?>
</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <div class="page-heading">
      <h4>Reports</h4>
    </div>
    <div class="wrapper">
      <div class="d-md-flex justify-content-between">
        <div class="table-heading">
          <h6>Attendance Report</h6>
        </div>
        <div class="searchWrapper">
          <select name='company' id='company' class="input-select">
            <option value="all">Contractor</option>
            <?php foreach ($contractors as $contractor) : ?>
              <option value="<?= $contractor['cont_id']; ?>"><?= $contractor['cont_name']; ?></option>
            <?php endforeach; ?>
          </select>
          <select name='location' id='location' class="input-select">
            <option value="all">Location</option>
            <?php foreach ($locations as $location) : ?>
              <option value="<?= $location['loc_name']; ?>"><?= $location['loc_name']; ?></option>
            <?php endforeach; ?>
          </select>
          <select name='dept' id='dept' class="input-select">
            <option value="all">Department</option>
            <?php foreach ($departments as $department) : ?>
              <option value="<?= $department['dept_name']; ?>"><?= $department['dept_name']; ?></option>
            <?php endforeach; ?>
          </select>
          <input type="text" name="search" id='search' placeholder="Search An Employee" class='input-text' />
        </div>
      </div>
      <div class="table-wrapper table-responsive">
        <table class='table text-center' id='emp_report'>

        </table>
      </div>
    </div>
    <div class="table-footer d-md-flex justify-content-between">
      <div class="date-filter">
        Data Showing From <input type='date' name='from' id='from' value="<?php echo date('Y-m-d'); ?>" class='input-date' /> to <input type='date' name='to' id='to' value="<?php echo date('Y-m-d'); ?>" class='input-date' />
      </div>
      <div class="download-Wrapper">
        <select name='download_type' id='download_type' class="input-select mr-2">
          <option selected value="csv">.csv</option>
          <option value="xlsx">.xlsx</option>
          <option value="json">.json</option>
          <option value="pdf">.pdf</option>
        </select>
        <button id="download_btn" class="btn btn-primary">Download Data</button>
      </div>
    </div>
  </div>

  <?= $footer; ?>
  <?= $scripts; ?>

  <script src="<?= ASSETS_URL . 'js/jquery.csv.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/attendance_report.js' ?>"></script>
</body>

</html>