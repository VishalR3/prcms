import {SITE_ROOT} from './init.js';

$('#add_employee_form').submit(function(e){
  e.preventDefault();

  let name= $(this).find('#name').val();
  let mobile= $(this).find('#mobile').val();
  let email= $(this).find('#email').val();
  let location= $(this).find('#location option:selected').val();
  let shift= $(this).find('#shift option:selected').val();
  let dept= $(this).find('#dept option:selected').val();
  let status= $(this).find('input[name="status"]:checked').val();
  let cont = '0';
  if(status){
    cont = $(this).find('#cont option:selected').val();
  }
  $.post(SITE_ROOT+'api/addEmployee',{
    'name':name,
    'mobile':mobile,
    'email':email,
    'location':location,
    'shift':shift,
    'dept':dept,
    'status':status,
    'cont':cont
  },function(res){
    if(res){
      console.log(JSON.parse(res));
    }
  })
  
});