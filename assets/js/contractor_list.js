const MODEL_URL = SITE_ROOT + "assets/js/vendor/face-api/models";

var toastElList = [].slice.call(document.querySelectorAll(".toast"));
var toastList = toastElList.map(function (toastEl) {
  return new bootstrap.Toast(toastEl);
});

toastList[0].show();

const loadModules = new Promise(async (resolve) => {
  await faceapi.loadSsdMobilenetv1Model(MODEL_URL);
  await faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL);
  await faceapi.loadFaceLandmarkModel(MODEL_URL);
  await faceapi.loadFaceRecognitionModel(MODEL_URL);
  resolve();
});

loadModules.then(() => {
  $(".toast-header strong").text("Models Loaded");
  $("#models_progress").animate({ width: "100%" });
  setTimeout(() => {
    $(".toastWrapper").fadeOut(500);
  }, 400);
});

$.cloudinary.config({ cloud_name: "vishaltest", secure: true });
$(function () {
  if ($.fn.cloudinary_fileupload !== undefined) {
    $("#empPhoto").cloudinary_fileupload();
  }
});

$(".upload_emp_btn").on("click", (e) => {
  let empID = e.target.getAttribute("data-id");
  console.log(empID);
  $("#empPhoto").attr("data-id", empID);
  $("#empUpload").click();
});

$("#empPhoto").on("cloudinarydone", (e, data) => {
  let empID = e.target.getAttribute("data-id");
  let url = data.result.secure_url;
  $("tr[data-id = '" + empID + "'] .photoStatus").html(
    $.cloudinary.imageTag(data.result.public_id, { height: "50" }).toHtml()
  );
  $("tr[data-id = '" + empID + "'] .small-font").html(
    "<i>Photo Uploaded</i><br><i>Searching Face...</i>"
  );
  let faceDescriptor = faceRec(empID, url);
  faceDescriptor.then((value) => {
    let progress = document.createElement("div");
    progress.classList = "progress";
    progress.style = "height:5px";
    let bar = document.createElement("div");
    bar.classList = "progress-bar";
    bar.style = "width: 25%;";
    progress.append(bar);
    $("tr[data-id = '" + empID + "'] .small-font").html(progress);

    $.post(
      SITE_ROOT + "api/uploadEmployeePhoto",
      {
        empID: empID,
        photo: data.result.path,
        face_descriptor: value,
      },
      (res) => {
        console.log(res);
        bar.style = "width: 100%";
        setTimeout(() => {
          $("tr[data-id = '" + empID + "'] .small-font").html(
            "Face Registered"
          );
        }, 200);
      }
    );
  });
});

$("#empPhoto").on("cloudinaryprogress", function (e, data) {
  let empID = e.target.getAttribute("data-id");
  let progress = document.createElement("div");
  progress.classList = "progress";
  progress.style = "height:5px";
  let bar = document.createElement("div");
  bar.classList = "progress-bar";
  bar.style = "width:" + Math.round((data.loaded * 100.0) / data.total) + "%;";
  progress.append(bar);
  $("tr[data-id = '" + empID + "'] .small-font").html(progress);
});

async function faceRec(empID, url) {
  const imgUrl = url;
  const img = await faceapi.fetchImage(imgUrl);

  const fullFaceDescription = await faceapi
    .detectSingleFace(img)
    .withFaceLandmarks()
    .withFaceDescriptor();

  if (!fullFaceDescription) {
    throw new Error(`no faces detected for ${empID}`);
  }

  const faceDescriptors = [fullFaceDescription.descriptor];
  const labeledFaceDescriptors = new faceapi.LabeledFaceDescriptors(
    empID,
    faceDescriptors
  );

  return labeledFaceDescriptors.toJSON();
}
