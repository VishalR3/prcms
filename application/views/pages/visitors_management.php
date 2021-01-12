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
  <script src="https://www.gstatic.com/firebasejs/ui/4.7.1/firebase-ui-auth.js"></script>
  <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/4.7.1/firebase-ui-auth.css" />
  <script type="text/javascript">
    // FirebaseUI config.
    var uiConfig = {
      signInSuccessUrl: '<?= SITE_ROOT; ?>visitor/details_form',
      signInOptions: [
        // Leave the lines as is for the providers you want to offer your users.
        firebase.auth.PhoneAuthProvider.PROVIDER_ID
      ],
      // tosUrl and privacyPolicyUrl accept either url string or a callback
      // function.
      // Terms of service url/callback.
      tosUrl: '<?php echo site_url('tos'); ?>',
      // Privacy policy url/callback.
      privacyPolicyUrl: function() {
        window.location.assign('<?= site_url('privacy_policy'); ?>');
      }
    };

    // Initialize the FirebaseUI Widget using Firebase.
    var ui = new firebaseui.auth.AuthUI(firebase.auth());
    // The start method will wait until the DOM is loaded.
    ui.start('#firebaseui-auth-container', uiConfig);
  </script>
</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <div class="center_card">
      <h3>Visitors Management</h3>
      <div class="col-sm-4 mt-5">
        <div id="firebaseui-auth-container"></div>
      </div>
    </div>

  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script type='module' src="<?= ASSETS_URL . 'js/visitor.js' ?>"></script>
</body>

</html>