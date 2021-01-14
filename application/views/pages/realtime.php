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
  <style>
    .chatbox {
      width: 100%;
      min-height: 250px;
      border: 1px solid black;

    }
  </style>

</head>

<body>
  <?= $header; ?>

  <div class="container mt-3">
    <div class="row">
      <div class="col-md-6 offset-md-3" id="col">
        <div class="card">
          <div class="card-body">
            <div class="chatbox">
            </div>
            <div class="my-3">
              <div class="mb-3">
                <input type='text' name='msg' id='msg' class='form-control'>
              </div>
              <button id='send_btn' class='btn btn-primary'>Send Message</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?= $footer; ?>
  <?= $scripts; ?>
  <script>
    let url = window.location.href;
    let base = url.split('/')[2];
    let socket = new WebSocket(`ws://${base}:8282`);
    socket.onmessage = e => {
      let res = JSON.parse(e.data);

      if (res.type == "msg") {
        let msg = document.createElement('div');
        msg.classList = 'bg-danger text-white p-2';
        msg.innerHTML = res.data;
        document.querySelector('.chatbox').append(msg);
      }
    }

    $(function() {
      $('#send_btn').click(() => {
        let message = $('#msg').val();

        let encmsg = JSON.stringify({
          "type": "msg",
          "data": message
        });

        socket.send(encmsg);
        let msg = document.createElement('div');
        msg.classList = 'bg-success text-white p-2';
        msg.innerHTML = message;
        document.querySelector('.chatbox').append(msg);

      });

    });
  </script>



  <!-- <script type='module' src="<?= ASSETS_URL . 'js/home.js' ?>"></script> -->

</body>

</html>