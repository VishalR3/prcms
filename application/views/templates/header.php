<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= SITE_ROOT; ?>">PRC - Management System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Admin
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Users Management</a></li>
            <li><a class="dropdown-item" href="#">Upload Data</a></li>
            <li><a class="dropdown-item" href="#">Roles</a></li>
            <li><a class="dropdown-item" href="#">Privilages</a></li>
            <li><a class="dropdown-item" href="#">General Settings</a></li>
            <li><a class="dropdown-item" href="#">Password Policy</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Master
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Employee</a></li>
            <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>masters/company/">Company</a></li>
            <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>masters/location/">Location</a></li>
            <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>masters/shift/">Shift</a></li>
            <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>masters/contractor/">Contractor</a></li>
            <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>masters/department/">Department</a></li>
            <li><a class="dropdown-item" href="<?= SITE_ROOT; ?>masters/holiday/">Holiday</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Attendance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Visitors Management</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reports/Dashboard
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Attendance Report</a></li>
            <li><a class="dropdown-item" href="#">Visitors Report</a></li>
            <li><a class="dropdown-item" href="#">Dashboard</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <div class='user_details'>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item no-wrap">
          <a class="nav-link" href="#">Log Out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<style>
  .no-wrap {
    white-space: nowrap;
  }
</style>