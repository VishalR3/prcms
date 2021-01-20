let access=[];
$(function(){
  let color =getRandomColor();
  $('#roleColor').text(color);
  $("#colorTest").css("background-color", color);
  
  $('#color_change_btn').click((e)=>{
    e.preventDefault();
    let color =getRandomColor();
    $('#roleColor').text(color);
    $("#colorTest").css("background-color", color);
  })

  

  $('#add_role_form').submit((e)=>{
    e.preventDefault();

    let payload ={
      'role':$('#role').val(),
      'roleColor':$('#roleColor').text(),
      'access':JSON.stringify(access)
    }
    console.log(payload);
    $.post(SITE_ROOT+'admin/addRole',payload,(res)=>{
      console.log(res);
      setTimeout(()=>{
        window.location.reload();
      },200)
    });
  })

  document.querySelectorAll('input[name="access"]').forEach(input=>{
    input.addEventListener('change',e=>{
      if(e.target.checked){
        access.push(e.target.value);
      }else{
        const index = access.indexOf(e.target.value);
        if (index > -1) {
          access.splice(index, 1);
        }
      }
    })
  })

  //Roles Multi Select

  //Admin
  document.getElementById('admin').addEventListener('change',e=>{
    let checked = e.target.checked;
    console.log(checked);
    document.querySelectorAll("input[name='access']").forEach(input =>{
      addAccess(input,checked);
    })
  })
  //All Reads
  document.getElementById('allRead').addEventListener('change',e=>{
    let checked = e.target.checked;
    console.log(checked);
    addAccess(document.querySelector('#employeeRead'),checked);
    addAccess(document.querySelector('#masterRead'),checked);
    addAccess(document.querySelector('#reportRead'),checked);
  })
  //All Writes
  document.getElementById('allWrite').addEventListener('change',e=>{
    let checked = e.target.checked;
    console.log(checked);
    addAccess(document.querySelector('#employeeWrite'),checked);
    addAccess(document.querySelector('#masterWrite'),checked);
    addAccess(document.querySelector('#reportWrite'),checked);
  })
  //All Updates
  document.getElementById('allUpdate').addEventListener('change',e=>{
    let checked = e.target.checked;
    console.log(checked);
    addAccess(document.querySelector('#employeeUpdate'),checked);
    addAccess(document.querySelector('#masterUpdate'),checked);
    addAccess(document.querySelector('#reportUpdate'),checked);
  })
  //All Deletes
  document.getElementById('allDelete').addEventListener('change',e=>{
    let checked = e.target.checked;
    console.log(checked);
    addAccess(document.querySelector('#employeeDelete'),checked);
    addAccess(document.querySelector('#masterDelete'),checked);
    addAccess(document.querySelector('#reportDelete'),checked);
  })
  //Employee All
  document.getElementById('employeeAll').addEventListener('change',e=>{
    let checked = e.target.checked;
    console.log(checked);
    addAccess(document.querySelector('#employeeRead'),checked);
    addAccess(document.querySelector('#employeeWrite'),checked);
    addAccess(document.querySelector('#employeeUpdate'),checked);
    addAccess(document.querySelector('#employeeDelete'),checked);
  })
  //Master All
  document.getElementById('masterAll').addEventListener('change',e=>{
    let checked = e.target.checked;
    console.log(checked);
    addAccess(document.querySelector('#masterRead'),checked);
    addAccess(document.querySelector('#masterWrite'),checked);
    addAccess(document.querySelector('#masterUpdate'),checked);
    addAccess(document.querySelector('#masterDelete'),checked);
  })
  //Report All
  document.getElementById('reportAll').addEventListener('change',e=>{
    let checked = e.target.checked;
    console.log(checked);
    addAccess(document.querySelector('#reportRead'),checked);
    addAccess(document.querySelector('#reportWrite'),checked);
    addAccess(document.querySelector('#reportUpdate'),checked);
    addAccess(document.querySelector('#reportDelete'),checked);
  })

})


function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}
function addAccess(element,checked){
  element.checked= checked;
  let index = access.indexOf(element.value);
  if(checked){
    if (index == -1) {
      access.push(element.value);
    }
  }else{
    if (index > -1) {
      access.splice(index, 1);
    }
  }
}