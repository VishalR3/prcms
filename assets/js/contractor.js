import {SITE_ROOT} from './init.js';

$('#add_contractor_form').submit(function(e){
  e.preventDefault();

  let name = $(this).find('#cont_name').val();
  let address = $(this).find('#address option:selected').val();
  let cont_person_name = $(this).find('#cont_person_name').val();
  let mobile = $(this).find('#mobile').val();
  let email = $(this).find('#email').val();
  let active = $(this).find('input[name="active"]:checked').val();
  $.post(SITE_ROOT + 'api/addContractor',{
    'cont_name':name,
    'address':address,
    'cont_person_name':cont_person_name,
    'mobile':mobile,
    'email':email,
    'active':active
  },function(res){
    if(res){
      console.log("Succesful!!");
      console.log(JSON.parse(res));
    }
  });
  // console.log(`name : ${name}, address : ${address}, active : ${active}`);
});