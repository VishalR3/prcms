

$('#add_department_form').submit(function(e){
  e.preventDefault();

  let name = $(this).find('#dept_name').val();
  let hod = $(this).find('#hod option:selected').val();
  let mob = $(this).find('#mob').val();
  $.post(SITE_ROOT + 'api/addDepartment',{
    'dept_name':name,
    'hod':hod,
    'mob':mob
  },function(res){
    if(res){
      console.log("Succesful!!");
      console.log(JSON.parse(res));
    }
  });
});