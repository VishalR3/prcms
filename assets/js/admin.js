import {SITE_ROOT} from './init.js';

window.onload=()=>{
  $('#empIdDiv').hide();
  let data = JSON.parse($('#json').html());
  data = JSON.stringify(data, null, 3);
  $('#json').html(data);
};

$('#is_employee').change(()=>{
  $('#empIdDiv').toggle();
})

//User Registration

$('#reg_user_form').submit((e)=>{
  e.preventDefault();
  let payload={
    'username': $('#username').val(),
    'mobile':$('#mobile').val(),
    'password':$('#password').val(),
    'is_employee':document.getElementById('is_employee').checked?'1':'0',
    'empID': document.getElementById('is_employee').checked?$('#empID').val():'0',
    'role':$('#role option:selected').val(),
  }
  $.post(SITE_ROOT+'user/registerUser',payload,(res)=>{
    console.log(res);
  });
  console.log(payload);
});