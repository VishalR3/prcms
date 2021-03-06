<?php $access = json_decode($this->session->userdata('access')); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class=" container-fluid">
    <a class="navbar-brand" href="<?= SITE_ROOT; ?>">PRC - Management System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if (in_array('admin', $access)) : ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Admin
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>admin/users_management">Users Management</a></li>
              <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>admin/upload_data">Upload Data</a></li>
              <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>admin/roles">Roles</a></li>
              <li><a class="dropdown-item" href="#">General Settings</a></li>
              <li><a class="dropdown-item" href="#">Password Policy</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if (in_array('master.read', $access)) : ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Master
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>masters/employee/">Employee</a></li>
              <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>masters/company/">Company</a></li>
              <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>masters/location/">Location</a></li>
              <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>masters/shift/">Shift</a></li>
              <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>masters/contractor/">Contractor</a></li>
              <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>masters/department/">Department</a></li>
              <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>masters/holiday/">Holiday</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if (in_array('visitor.write', $access)) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= SITE_ROOT; ?>visitors_management/">Visitors Management</a>
          </li>
        <?php endif; ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reports/Dashboard
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php if (in_array('report.read', $access)) : ?>
              <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>reports/attendance_report/">Attendance Report</a></li>
              <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>reports/visitors_report/">Visitors Report</a></li>
            <?php endif; ?>
            <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>reports/dashboard/">Visitor Request</a></li>
          </ul>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href="<?= SITE_ROOT; ?>contractor_employee_list">Contractor List</a>
        </li>
      </ul>
    </div>
    <div class='user_details'>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item no-wrap">
          <a class="nav-link" href="<?= SITE_ROOT; ?>user/logout">Log Out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>