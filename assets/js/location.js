

$('#add_location_form').submit(function(e){
  e.preventDefault();

  let name = $(this).find('#loc_name').val();
  let address = $(this).find('#loc_address').val();
  $.post(SITE_ROOT + 'api/addLocation',{
    "loc_name":name,
    "loc_address":address
  },function(res){
    if(res){
      console.log("Succesful!!");
      console.log(JSON.parse(res));
    }
  });
});