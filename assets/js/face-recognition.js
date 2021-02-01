const MODEL_URL = SITE_ROOT+'assets/js/vendor/face-api/models'

const loadModules = new Promise(async resolve=>{
  await faceapi.loadSsdMobilenetv1Model(MODEL_URL)
  await faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL)
  await faceapi.loadFaceLandmarkModel(MODEL_URL)
  await faceapi.loadFaceRecognitionModel(MODEL_URL)
  resolve();
})

let inCamera = [];
setInterval(()=>{
  inCamera=[];
},600000)



loadModules.then(()=>{
  const input = document.getElementById('video')
  
  let progress = $('#faceRecProgress');
  let status = $('#status_span');
  progress.animate({width:'40%'})
  status.text('Models Loaded');
  
  progress.animate({width:'50%'})
  setTimeout(()=>{
    status.text('Loading Photos...');
  },500)

  $.get(SITE_ROOT+'api/getFaceDescriptors',(res)=>{
    res= res.map(x=>fromJSON(x));
    status.text('Photos Loaded');
    progress.animate({width:'100%'})
    setTimeout(()=>{
      status.text('Starting Face Recognition');
    },500)
    setTimeout(() => {
      $('#loading_state_card').fadeOut(800, ()=>{
        $(this).remove();
      });
    }, 1500);

    setInterval(() => {
      faceDetection(res);
    }, 250);
  })
})

async function faceDetection(labeledFaceDescriptors){
  const input = document.getElementById('video')
  const canvas = document.getElementById('face-canvas')
  canvas.getContext('2d').clearRect(0,0,canvas.width,canvas.height)
  //Face Detection
  let fullFaceDescriptions = await faceapi.detectSingleFace(input, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptor()
  if(fullFaceDescriptions){
    fullFaceDescriptions = faceapi.resizeResults(fullFaceDescriptions,canvas)
    faceapi.draw.drawDetections(canvas, fullFaceDescriptions)
    faceapi.draw.drawFaceLandmarks(canvas, fullFaceDescriptions)
    
    //Face Matching
    
    const maxDescriptorDistance = 0.6
    
    const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors,maxDescriptorDistance)
    const results = faceMatcher.findBestMatch(fullFaceDescriptions.descriptor)
    if(inCamera.indexOf(results.label)==-1){
      inCamera.push(results.label);
      if(results.label!='unknown'){
        $.post(SITE_ROOT+'api/postEmployeeAttendance',{
          'empID':results.label
        },(res)=>{console.log(res)})
      }else{
        $.post(SITE_ROOT+'api/postVisitorAttendance',(res)=>{console.log(res)})
      }
    }
    $('#frstatus').text(`Detected : ${results.label}`)
    const box = fullFaceDescriptions.detection.box
    const text = results.toString()
    const drawBox = new faceapi.draw.DrawBox(box, {label:text})
    drawBox.draw(canvas) 
  }else{
    $('#frstatus').show()
    $('#frstatus').text('No Face Detected!!')
  }

}


function getFaceDescriptors(){
  $.get(SITE_ROOT+'api/getFaceDescriptors',(res)=>{
    console.log(res);
  })
}

function fromJSON(json){
  const descriptors = json.descriptors.map(d=>{
    return new Float32Array(d);
  })
  return new faceapi.LabeledFaceDescriptors(json.label,descriptors);
}

