<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>GateKeeper | Home</title>
  <!-- Bootstrap CSS -->
  <?= $links; ?>
  <link rel="stylesheet" href="<?= ASSETS_URL; ?>css/style.css">
  <link rel="stylesheet" href="<?= ASSETS_URL; ?>css/dashboard.css">
</head>

<body>
  <?= $header; ?>
  <?php $user = $this->session->userdata('empData'); ?>

  <div class="container mt-3">
    <div class="row">
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body">
            <img id='user_profile_pic' class="dp" src="https://res.cloudinary.com/vishaltest/image/upload/<?= $user['photo'] ?>" alt="user_profile">
            <h5 class="username"><?= $user['name']; ?></h5>
            <div class="userdata">
              <div class="data-row ">
                <div class="key">
                  Emp ID
                </div>
                <div class="value"><?= $user['empID']; ?></div>
              </div>
              <div class="data-row ">
                <div class="key">
                  Mobile
                </div>
                <div class="value"><?= $user['mobile']; ?></div>
              </div>
              <div class="data-row ">
                <div class="key">
                  Email
                </div>
                <div class="value"><?= $user['email']; ?></div>
              </div>
              <div class="data-row ">
                <div class="key">
                  Shift
                </div>
                <div class="value"><?= $user['shift']; ?></div>
              </div>
              <div class="data-row ">
                <div class="key">
                  Department
                </div>
                <div class="value"><?= $user['dept']; ?></div>
              </div>
              <div class="data-row ">
                <div class="key">
                  Location
                </div>
                <div class="value"><?= $user['location']; ?></div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mt-3">
          <div class="card-body text-center" id='update_pic_card'>
            <button type="button" id="update_pic_btn" class="btn btn-primary">
              Update Profile Picture
            </button>
            <button type="button" id="upload_widget" class="d-none" data-id="<?= $user['empID']; ?>">
              Update Profile Picture
            </button>
            <div id="faceRecProgressDiv" style='display:none;'>
              <div class="progress mt-3" style="height:5px;">
                <div class="progress-bar" id="faceRecProgress">
                </div>
              </div>
              <div>
                <span id="status">Loading Models...</span>
              </div>
            </div>

          </div>

        </div>
      </div>
      <div class="col-sm-9">
        <div class="card">
          <div class="card-header">
            <h5 class='text-center'>Requests for meeting By Visitors</h5>
          </div>
          <div class="shutter">
            <div class="shutter-title">
              <div>New Requests</div>
              <div><i class="fa fa-chevron-down"></i></div>
            </div>
            <div class="shutter-body" id='pending'>
              <?php if ($PendingMeets) : ?>
                <?php foreach ($PendingMeets as $meet) : ?>
                  <div class="card mt-2 shadow" id="visit<?= $meet['visit_id']; ?>">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-9">
                          <h5><?= $meet['name']; ?></h5>
                          <div class="meet_details">
                            <span class='d-block'><b><?= $meet['dov_from']; ?></b> - <?= $meet['dov_to']; ?></span>
                            <span class='d-block'>Mobile : <b><?= $meet['v_mobile']; ?></b></span>
                            <span class='d-block'>No. Of People : <?= $meet['no_of_people']; ?></span>
                          </div>
                          <div class='my-2'><?= $meet['purpose']; ?></div>
                        </div>
                        <div class="col-sm-3">
                          <?php if ($meet['photo'] != NULL) : ?>
                            <img class='img-fluid' src='https://res.cloudinary.com/vishaltest/image/upload/v1611147354/<?= $meet['photo']; ?>' alt="visitor Photo">
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="d-flex">
                        <div data-id='<?= $meet['visit_id']; ?>' class="accept_link text-success mr-3">
                          <i class='fa fa-check mr-1'></i> Accept
                        </div>
                        <div data-id='<?= $meet['visit_id']; ?>' class="reject_link text-danger mr-3">
                          <i class='fa fa-times mr-1'></i> Reject
                        </div>
                        <div data-id='<?= $meet['visit_id']; ?>' class="reschedule_link text-warning mr-3">
                          <i class='fa fa-history mr-1'></i>Accept and Suggest a later time
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else : ?>
                <div class="p-3">
                  No New Meeting Requests
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="shutter">
            <div class="shutter-title">
              <div>Scheduled</div>
              <div><i class="fa fa-chevron-down"></i></div>
            </div>
            <div class="shutter-body" id="scheduled">
              <?php if ($ScheduledMeets) : ?>
                <?php foreach ($ScheduledMeets as $meet) : ?>
                  <div class="card mt-2 shadow <?= ($meet['to_meet_conf'] == MEET_REJECTED) ? 'm-reject' : 'm-confirm' ?>"">
                    <div class=" card-body">
                    <div class="row">
                      <div class="col-sm-9">
                        <h5><?= $meet['name']; ?></h5>
                        <div class="meet_details">
                          <span class='d-block'><b><?= $meet['dov_from']; ?></b> - <?= $meet['dov_to']; ?></span>
                          <span class='d-block'>Mobile : <b><?= $meet['v_mobile']; ?></b></span>
                          <span class='d-block'>No. Of People : <?= $meet['no_of_people']; ?></span>
                        </div>
                        <div class='my-2'><?= $meet['purpose']; ?></div>
                      </div>
                      <div class="col-sm-3">
                        <?php if ($meet['photo'] != NULL) : ?>
                          <img class='img-fluid' src='https://res.cloudinary.com/vishaltest/image/upload/v1611147354/<?= $meet['photo']; ?>' alt="visitor Photo">
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer bg-primary text-white">
                    <?php if ($meet['to_meet_conf'] == MEET_CONFIRMED) : ?>
                      <?php if ($meet['dov_to'] > date('Y-m-d H:i:s') && $meet['dov_from'] < date('Y-m-d H:i:s')) : ?>
                        <div class='d-flex justify-content-between'>
                          <div>Ongoing Meet</div>
                          <div data-id="<?= $meet['visit_id']; ?>" class='exit_meet'>Exit Meet</div>
                        </div>
                      <?php else : ?>
                        <div>Scheduled at <?= $meet['dov_from']; ?></div>
                      <?php endif; ?>
                    <?php elseif ($meet['to_meet_conf'] == MEET_SCHEDULED) : ?>
                      <div>Scheduled at <?= $meet['proposed_time']; ?></div>
                    <?php endif; ?>
                  </div>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <div class="p-3">
            Your Schedule is All Clear
          </div>
        <?php endif; ?>
          </div>
        </div>
        <div class="shutter">
          <div class="shutter-title">
            <div>Finished</div>
            <div><i class="fa fa-chevron-down"></i></div>
          </div>
          <div class="shutter-body" id="finished">
            <?php if ($FinishedMeets) : ?>
              <?php foreach ($FinishedMeets as $meet) : ?>
                <div class="card mt-2 shadow <?= ($meet['to_meet_conf'] == MEET_REJECTED) ? 'm-reject' : 'm-confirm' ?>">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-9">
                        <h5><?= $meet['name']; ?></h5>
                        <div class="meet_details">
                          <span class='d-block'><b><?= $meet['dov_from']; ?></b> - <?= $meet['dov_to']; ?></span>
                          <span class='d-block'>Mobile : <b><?= $meet['v_mobile']; ?></b></span>
                          <span class='d-block'>No. Of People : <?= $meet['no_of_people']; ?></span>
                        </div>
                        <div class='my-2'><?= $meet['purpose']; ?></div>
                        <?php if ($meet['to_meet_conf'] == MEET_REJECTED) : ?>
                          <div class='my-2'><i><b>Reason</b> : <?= $meet['denial_reason']; ?></i></div>
                        <?php endif; ?>
                      </div>
                      <div class="col-sm-3">
                        <?php if ($meet['photo'] != NULL) : ?>
                          <img class='img-fluid' src='https://res.cloudinary.com/vishaltest/image/upload/v1611147354/<?= $meet['photo']; ?>' alt="visitor Photo">
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else : ?>
              <div class="p-3">
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script defer src="<?= ASSETS_URL . 'js/vendor/face-api/face-api.min.js' ?>"></script>
  <script src="<?= ASSETS_URL . 'js/dashboard.js' ?>"></script>
  <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
  <script defer src="<?= ASSETS_URL . 'js/empFaceRec.js' ?>"></script>

</body>

</html>