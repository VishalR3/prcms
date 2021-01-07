import {SITE_ROOT} from './init.js';

$('#add_holiday_form').submit(function(e){
  e.preventDefault();

  let name = $(this).find('#name').val();
  let start = $(this).find('#start').val();
  let end = $(this).find('#end').val();
  $.post(SITE_ROOT + 'api/addHoliday',{
    'name':name,
    'start':start,
    'end':end
  },function(res){
    if(res){
      console.log("Succesful!!");
      console.log(JSON.parse(res));
    }
  });
});