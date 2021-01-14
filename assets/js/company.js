

$('#add_company_form').submit(function(e){
  e.preventDefault();

  let name = $(this).find('input[name="comp_name"]').val();
  let address = $(this).find('select[name="address"]').find('option:selected').val();
  let cin = $(this).find('#cin').val();
  let cont_person = $(this).find('select[name="cont_person"]').find('option:selected').val();
  let mobile = $(this).find('input[name="mobile"]').val();
  let weekly_off = $(this).find('input[name="weekly_off"]:checked').val();
  $.post(SITE_ROOT + 'api/addCompany',{
    "comp_name":name,
    "address":address,
    "cin":cin,
    "cont_person":cont_person,
    "mobile":mobile,
    "weekly_off":weekly_off
  },function(res){
    if(res){
      console.log(res);
    }
  });
});