<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>GateKeeper | Home</title>
  <!-- Bootstrap CSS -->
  <?= $links; ?>
</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <p>Employee Attendance Website</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5>To Do List</h5>
            <ul>
              <li>Upload Excel Sheet</li>
              <li>API for sending list of employees to python software</li>
              <li>API for recieving python output</li>
              <li>Feature for Marking Attendance of Employees</li>
              <li>Sorting Employees in accordance with various filters</li>
              <li>Visitor
                <ul>
                  <li>Visitor Attendance</li>
                  <li>Reason for coming</li>
                  <li>Dates Approval</li>
                  <li>Dates Cancelation</li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>

  <script type='module' src="<?= ASSETS_URL . 'js/init.js' ?>"></script>

</body>

</html>