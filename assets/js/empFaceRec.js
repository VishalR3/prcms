const MODEL_URL = SITE_ROOT+'assets/js/vendor/face-api/models'

const loadModules = new Promise(async resolve=>{
  await faceapi.loadSsdMobilenetv1Model(MODEL_URL)
  await faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL)
  await faceapi.loadFaceLandmarkModel(MODEL_URL)
  await faceapi.loadFaceRecognitionModel(MODEL_URL)
  resolve();
})

$('#update_pic_btn').click(e=>{
  e.preventDefault();
  $('#faceRecProgressDiv').show();
  $('#status').text('Loading Models...')
  $('#faceRecProgress').style = 'width:0';
  loadModules.then(()=>{
    $('#faceRecProgress').animate({width:'100%'})
    $('#status').text('Models Loaded')
    $('#upload_widget').click();
  })
})

var myWidget = cloudinary.createUploadWidget({
  cloudName: 'vishaltest',
  uploadPreset: 'vzibl1o1'
}, (error, result) => {
  if (!error && result && result.event === "success") {
    console.log('Done! Here is the image info: ', result.info);
    let path = result.info.path;
    let url = result.info.secure_url;
    let empID = $('#upload_widget').attr('data-id');
    let faceDescriptor = faceRec(empID,url);
    faceDescriptor.then(value  => {
      $('#faceRecProgress').animate({width:'25%'});
      $('#status').text('Calculating Your Face');
      
      $.post(SITE_ROOT+'api/uploadEmployeePhoto',{
        'empID':empID,
        'photo':path,
        'face_descriptor':value
      },res=>{
        console.log(res)
        $('#faceRecProgress').animate({width:'100%'})
        $('#status').text('Calculation Done')
        $('#user_profile_pic').attr('src',url)
        $('#faceRecProgressDiv').hide();

      })
    })
  }
})

document.getElementById("upload_widget").addEventListener("click", function() {
  myWidget.open();
}, false);
 


async function faceRec(empID, url){
   const imgUrl = url
   const img = await faceapi.fetchImage(imgUrl)

   const fullFaceDescription = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()

   if(!fullFaceDescription){
     throw new Error(`no faces detected for ${empID}`)
   }

   const faceDescriptors = [fullFaceDescription.descriptor]
   const labeledFaceDescriptors = new faceapi.LabeledFaceDescriptors(empID,faceDescriptors)

   return labeledFaceDescriptors.toJSON()
}