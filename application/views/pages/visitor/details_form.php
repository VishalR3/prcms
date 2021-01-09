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
    <div class="page-heading">
      <h4>Visitors Management</h4>
    </div>
    <div class="row g-4 mt-3">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <form id="visitor_details_form">
              <div class="mb-3">
                <label for="from_comp" class="form-label">From Company</label>
                <input type='text' name='from_comp' id='from_comp' class="form-control" />
              </div>
              <div class="mb-3">
                <label for="no_of_people" class="form-label">Number Of People</label>
                <input type='text' name='no_of_people' id='no_of_people' class="form-control" />
              </div>
              <div class="mb-3">
                <label for="to_meet" class="form-label">Employee To Meet </label>
                <select name='address' class="form-select" id='address'>
                  <option value="1">Vishal Rana</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="purpose" class="form-label">Reason For Visiting </label>
                <select name='purpose' id='purpose' class="form-select">
                  <option value="1">Vishal Rana</option>
                </select>
              </div>
              <div class="mb-3">
                <label for='date_from' class="form-label">Preferred Date and Time From</label>
                <div class="row">
                  <div class="col">
                    <input type="date" name="date_from" id="date_from" class="form-control">
                  </div>
                  <div class="col">
                    <input type="time" name="time_from" id="time_from" class="form-control">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for='date_to' class="form-label">Preferred Date and Time to</label>
                <div class="row">
                  <div class="col">
                    <input type="date" name="date_to" id="date_to" class="form-control">
                  </div>
                  <div class="col">
                    <input type="time" name="time_to" id="time_to" class="form-control">
                  </div>
                </div>
              </div>
              <button type='submit' class='btn btn-primary form-control'>Submit</button>

            </form>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="input-group my-3">
              <input type="text" class="form-control" placeholder="Search Previous Visits">
              <div class="input-group-append">
                <span class="input-group-text" id='input-icon'>
                  <i class="fa fa-search"></i>
                </span>
              </div>
            </div>
            <div class='card mt-3 br-2'>
              <div class="card-body">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script type='module' src="<?= ASSETS_URL . 'js/visitor.js' ?>"></script>
</body>

</html>