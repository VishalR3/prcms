<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Upload Profile Picture | PRCMS</title>
  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/style.css' ?>">
  <link rel='stylesheet' href="<?= ASSETS_URL . 'css/profilePic.css' ?>">
  <?= $links; ?>

</head>

<body>
  <?= $header; ?>

  <div class="container mt-3" id="positionedContainer">
    <div class="centerCard">
      <div class="bigSqBtn" data-id='<?= $this->session->userdata('empData')['empID']; ?>'>
        <h6>Upload Profile Picture</h6>
      </div>
      <div id="faceRecProgressDiv">
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

  <?= $footer; ?>
  <?= $scripts; ?>



  <script src="<?= ASSETS_URL . 'js/vendor/face-api/face-api.min.js' ?>"></script>
  <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
  <script>
    const MODEL_URL = SITE_ROOT + 'assets/js/vendor/face-api/models'

    const loadModules = new Promise(async resolve => {
      await faceapi.loadSsdMobilenetv1Model(MODEL_URL)
      await faceapi.loadFaceLandmarkModel(MODEL_URL)
      await faceapi.loadFaceRecognitionModel(MODEL_URL)
      resolve();
    })
    var myWidget = cloudinary.createUploadWidget({
      cloudName: 'vishaltest',
      uploadPreset: 'vzibl1o1'
    }, (error, result) => {
      if (!error && result && result.event === "success") {
        console.log('Done! Here is the image info: ', result.info);
        $('#faceRecProgress').animate({
          width: '25%'
        });
        $('#status').text('Calculating Your Face');
        let path = result.info.path;
        let url = result.info.secure_url;
        let empID = $('.bigSqBtn').attr('data-id');
        let faceDescriptor = faceRec(empID, url);
        faceDescriptor.then(value => {
          $.post(SITE_ROOT + 'api/uploadEmployeePhoto', {
            'empID': empID,
            'photo': path,
            'face_descriptor': value
          }, res => {
            console.log(res)
            $('#faceRecProgress').animate({
              width: '100%'
            })
            $('#status').text('Calculation Done')
            $('#user_profile_pic').attr('src', url)
            $.alert('Profile Photo Updated')
            window.location.href = SITE_ROOT
          })
        })
      }
    })
    loadModules.then(() => {
      $('#faceRecProgress').animate({
        width: '100%'
      })
      $('#status').text('Models Loaded')
      $('.bigSqBtn').on('click', () => {
        myWidget.open();
      })
    })
    $('#status').text('Loading Models...')
    $('#faceRecProgress').style = 'width:0';
    async function faceRec(empID, url) {
      const imgUrl = url
      const img = await faceapi.fetchImage(imgUrl)

      const fullFaceDescription = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()

      if (!fullFaceDescription) {
        $.alert(`No Face detected for ${empID}`)
        $('#faceRecProgress').animate({
          width: '0%'
        });
        $('#status').text('No Face Detected !!')
        throw new Error(`No Face detected for ${empID}`)
      }

      const faceDescriptors = [fullFaceDescription.descriptor]
      const labeledFaceDescriptors = new faceapi.LabeledFaceDescriptors(empID, faceDescriptors)

      return labeledFaceDescriptors.toJSON()
    }
  </script>

</body>

</html>