

$('#add_shift_form').submit(function(e){
  e.preventDefault();

  let name = $(this).find('input[name="shift_name"]').val();
  let start = $(this).find('input[name="start"]').val();
  let end = $(this).find('input[name="end"]').val();
  let lunch_start = $(this).find('input[name="lunch_bk_start"]').val();
  let lunch_end = $(this).find('input[name="lunch_bk_end"]').val();
  let other_start = $(this).find('input[name="other_bk_start"]').val();
  let other_end = $(this).find('input[name="other_bk_end"]').val();
  $.post(SITE_ROOT + 'api/addShift',{
    'shift_name':name,
    'start':start,
    'end':end,
    'lunch_bk_start':lunch_start,
    'lunch_bk_end':lunch_end,
    'other_bk_start':other_start,
    'other_bk_end':other_end,
  },function(res){
    if(res){
      console.log(res);
      window.location.reload();
    }
  });
})