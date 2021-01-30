$.cloudinary.config({cloud_name:'vishaltest',secure:true})

$(function() {
  if($.fn.cloudinary_fileupload !== undefined) {
    $("input.cloudinary-fileupload[type=file]").cloudinary_fileupload();
  }
});

$('.cloudinary-fileupload').on('cloudinarydone', (e, data)=> { 
  $('#visitorPhoto').val(data.result.public_id); 
  $('#visitorPhotoPreviewDiv').append($.cloudinary.imageTag(data.result.public_id,{class:'img-fluid'}).toHtml());   
});

$('.cloudinary-fileupload').on('cloudinaryprogress', function(e, data) { 
  $('.progress-bar').css('width', Math.round((data.loaded * 100.0) / data.total) + '%');
});


$('#usephoto').on('click',e=>{
  e.preventDefault();
  $('#uploadProgress').show();
  let data = $('#photo').attr('src');
  $('.cloudinary-fileupload').fileupload('option', 'formData').file = data;
  $('.cloudinary-fileupload').fileupload('add', { files: [ data ] });
})

