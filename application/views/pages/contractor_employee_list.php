<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Contractor List | PRCMS</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/style.css' ?>">
  <?= $links; ?>

</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <h4>Employee List</h4>
    <div class="card mt-3">
      <div class="card-body">
        <table class='table table-responsive text-center'>
          <thead class='bg-dark text-white shadow'>
            <td scope='col'>S.No</td>
            <td scope='col'>Name</td>
            <td scope='col'>Photo</td>
          </thead>
          <?php $i = 1 ?>
          <?php foreach ($employeesList as $employee) : ?>
            <tr scope='row'>
              <td><?= $i++; ?></td>
              <td><?= $employee['name']; ?></td>
              <td>
                <?php if ($employee['photo'] == 'v1611138371/employees/vishal2_gowht7.png') : ?>
                  <button class='btn btn-primary upload_emp_btn'>Upload Picture</button>
                <?php else : ?>
                  <img src='https://res.cloudinary.com/vishaltest/image/upload/<?= $employee['photo']; ?>' height='50' />
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script defer src="<?= ASSETS_URL . 'js/vendor/face-api/face-api.min.js' ?>"></script>
  <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
  <script src="<?= ASSETS_URL . 'js/contractor_list.js' ?>"></script>

</body>

</html>