

$('#add_employee_form').submit(function(e){
  e.preventDefault();

  let name= $(this).find('#name').val();
  let mobile= $(this).find('#mobile').val();
  let email= $(this).find('#email').val();
  let location= $(this).find('#location option:selected').val();
  let shift= $(this).find('#shift option:selected').val();
  let dept= $(this).find('#dept option:selected').val();
  let dob= $(this).find('#dob').val();
  let status= $(this).find('input[name="status"]:checked').val();
  let cont = '0';
  let weekly_off = $(this).find('#weekly_off option:selected').val();
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
    'dob':dob,
    'status':status,
    'cont':cont,
    'weekly_off':weekly_off
  },function(res){
    if(res){
      console.log(JSON.parse(res));
      window.location.reload();
    }
  })
  
});

$('input[name="status"]').change((e)=>{
  if(e.target.value=="1"){
    $('#cont_div').show()
  }else{
    $('#cont_div').hide()
  }
})

$(function() {
  var cache = {};
  $("#searchEmp").autocomplete({
    minLength: 2,
    source: function(request, response) {
      var term = request.term;
      if (term in cache) {
        response(cache[term]);
        return;
      }

      $.post(SITE_ROOT + "api/searchEmployee", request, (res) => {
        cache[term] = res;
        response(res);
      });
    },
    select: function( event, ui ) {
      window.location.href = SITE_ROOT+'masters/employee/#emp'+ui.item.empID;
    }
  });
});