$('#upload').change((e)=>{
  console.log(e.target.files[0].name);
  readFile(e.target.files[0]);
});
let List;

$('#emp_batch_btn').on('click',(e)=>{
  e.preventDefault();
  if(!Array.isArray(List)){
    console.log('Nothing Selected!!');
    document.querySelector('#upload_batch_form').classList.add('was-validated');
    return;
  }
  List.forEach((row,i)=>{
    if(Array.isArray(row)){
      if(i){
        let payload = {
          'name': row[0],
          'location':row[1],
          'shift':row[2],
          'dept':row[3],
          'dob':row[4],
          'status':row[5],
          'active':row[6],
          'mobile':row[7],
          'email':row[8]
        }
        $.post(SITE_ROOT+ 'api/addEmployee',payload,function(res){
          res=JSON.parse(res);
          if(res.success){
            console.log('Emp ID : '+res.empID);
          }else{
            console.log(`${res.name} is not inserted, Error : ${res.errors}`)
          }
        });
      }
    }else{
      console.log((row+1)+' Added!!');
    }
  });
})
$('#comp_batch_btn').on('click',(e)=>{
  e.preventDefault();
  if(!Array.isArray(List)){
    console.log('Nothing Selected!!');
    document.querySelector('#upload_batch_form').classList.add('was-validated');
    return;
  }
  List.forEach((row,i)=>{
    if(Array.isArray(row)){
      if(i){
        let payload = {
          'comp_name': row[0],
          'address':row[1],
          'cin':row[2],
          'cont_person':row[3],
          'mobile':row[4],
          'weekly_off':row[5],
        }
        $.post(SITE_ROOT+ 'api/addCompany',payload,function(res){
          res=JSON.parse(res);
          console.log('Company ID : '+res);
        });
      }
    }else{
      console.log((row+1)+' Added!!');
    }
  });
})
$('#loc_batch_btn').on('click',(e)=>{
  e.preventDefault();
  if(!Array.isArray(List)){
    console.log('Nothing Selected!!');
    document.querySelector('#upload_batch_form').classList.add('was-validated');
    return;
  }
  List.forEach((row,i)=>{
    if(Array.isArray(row)){
      if(i){
        let payload = {
          'loc_name': row[0],
          'loc_address':row[1]
        }
        $.post(SITE_ROOT+ 'api/addLocation',payload,function(res){
          res=JSON.parse(res);
          console.log('Location ID : '+res);
        });
      }
    }else{
      console.log((row+1)+' Added!!');
    }
  });
})
$('#shift_batch_btn').on('click',(e)=>{
  e.preventDefault();
  if(!Array.isArray(List)){
    console.log('Nothing Selected!!');
    document.querySelector('#upload_batch_form').classList.add('was-validated');
    return;
  }
  List.forEach((row,i)=>{
    if(Array.isArray(row)){
      if(i){
        let payload = {
          'shift_name': row[0],
          'start':row[1],
          'end':row[2],
          'lunch_bk_start':row[3],
          'lunch_bk_end':row[4],
          'other_bk_start':row[5],
          'other_bk_end':row[6]
        }
        $.post(SITE_ROOT+ 'api/addShift',payload,function(res){
          res=JSON.parse(res);
          console.log('Shift ID : '+res);
        });
      }
    }else{
      console.log((row+1)+' Added!!');
    }
  });
})
$('#cont_batch_btn').on('click',(e)=>{
  e.preventDefault();
  if(!Array.isArray(List)){
    console.log('Nothing Selected!!');
    document.querySelector('#upload_batch_form').classList.add('was-validated');
    return;
  }
  List.forEach((row,i)=>{
    if(Array.isArray(row)){
      if(i){
        let payload = {
          'cont_name': row[0],
          'address':row[1],
          'cont_person_name':row[2],
          'mobile':row[3],
          'email':row[4],
          'active':row[5]
        }
        $.post(SITE_ROOT+ 'api/addContractor',payload,function(res){
          res=JSON.parse(res);
          console.log('Contractor ID : '+res);
        });
      }
    }else{
      console.log((row+1)+' Added!!');
    }
  });
})
$('#dept_batch_btn').on('click',(e)=>{
  e.preventDefault();
  if(!Array.isArray(List)){
    console.log('Nothing Selected!!');
    document.querySelector('#upload_batch_form').classList.add('was-validated');
    return;
  }
  List.forEach((row,i)=>{
    if(Array.isArray(row)){
      if(i){
        let payload = {
          'dept_name': row[0],
          'hod':row[1],
          'mob':row[2]
        }
        $.post(SITE_ROOT+ 'api/addDepartment',payload,function(res){
          res=JSON.parse(res);
          console.log('Department ID : '+res);
        });
      }
    }else{
      console.log((row+1)+' Added!!');
    }
  });
})
$('#holiday_batch_btn').on('click',(e)=>{
  e.preventDefault();
  if(!Array.isArray(List)){
    console.log('Nothing Selected!!');
    document.querySelector('#upload_batch_form').classList.add('was-validated');
    return;
  }
  List.forEach((row,i)=>{
    if(Array.isArray(row)){
      if(i){
        let payload = {
          'name': row[0],
          'start':row[1],
          'end':row[2]
        }
        $.post(SITE_ROOT+ 'api/addHoliday',payload,function(res){
          res=JSON.parse(res);
          console.log('Holiday ID : '+res);
        });
      }
    }else{
      console.log((row+1)+' Added!!');
    }
  });
})

$(function(){
  $('#master_type').on('change',e=>{
    List = [];
    $('.progress').remove();
    $('#data_table').html('');
    switch(e.target.value){
      case 'employee': 
        $('#emp_batch_btn').show()
        $('#comp_batch_btn').hide()
        $('#loc_batch_btn').hide()
        $('#shift_batch_btn').hide()
        $('#cont_batch_btn').hide()
        $('#dept_batch_btn').hide()
        $('#holiday_batch_btn').hide()
        $('#download_template').attr('href',SITE_ROOT+'assets/templates/employee.csv');
        break;
      case 'company': 
        $('#emp_batch_btn').hide()
        $('#comp_batch_btn').show()
        $('#loc_batch_btn').hide()
        $('#shift_batch_btn').hide()
        $('#cont_batch_btn').hide()
        $('#dept_batch_btn').hide()
        $('#holiday_batch_btn').hide()
        $('#download_template').attr('href',SITE_ROOT+'assets/templates/company.csv');
        break;
      case 'location': 
        $('#emp_batch_btn').hide()
        $('#comp_batch_btn').hide()
        $('#loc_batch_btn').show()
        $('#shift_batch_btn').hide()
        $('#cont_batch_btn').hide()
        $('#dept_batch_btn').hide()
        $('#holiday_batch_btn').hide()
        $('#download_template').attr('href',SITE_ROOT+'assets/templates/location.csv');
        break;
      case 'shift': 
        $('#emp_batch_btn').hide()
        $('#comp_batch_btn').hide()
        $('#loc_batch_btn').hide()
        $('#shift_batch_btn').show()
        $('#cont_batch_btn').hide()
        $('#dept_batch_btn').hide()
        $('#holiday_batch_btn').hide()
        $('#download_template').attr('href',SITE_ROOT+'assets/templates/shift.csv');
        break;
      case 'contractor': 
        $('#emp_batch_btn').hide()
        $('#comp_batch_btn').hide()
        $('#loc_batch_btn').hide()
        $('#shift_batch_btn').hide()
        $('#cont_batch_btn').show()
        $('#dept_batch_btn').hide()
        $('#holiday_batch_btn').hide()
        $('#download_template').attr('href',SITE_ROOT+'assets/templates/contractor.csv');
        break;
      case 'department': 
        $('#emp_batch_btn').hide()
        $('#comp_batch_btn').hide()
        $('#loc_batch_btn').hide()
        $('#shift_batch_btn').hide()
        $('#cont_batch_btn').hide()
        $('#dept_batch_btn').show()
        $('#holiday_batch_btn').hide()
        $('#download_template').attr('href',SITE_ROOT+'assets/templates/department.csv');
        break;
      case 'holiday': 
        $('#emp_batch_btn').hide()
        $('#comp_batch_btn').hide()
        $('#loc_batch_btn').hide()
        $('#shift_batch_btn').hide()
        $('#cont_batch_btn').hide()
        $('#dept_batch_btn').hide()
        $('#holiday_batch_btn').show()
        $('#download_template').attr('href',SITE_ROOT+'assets/templates/holiday.csv');
        break;
    }
  })

})

function readFile(file) {
  const reader = new FileReader();
  reader.addEventListener('load', (event) => {
    const result = event.target.result;
    let data=$.csv.toArrays(result)
    List = data;
    data.forEach((row,i)=>{
      if(i){
        let tr= document.createElement('tr');
        tr.setAttribute('scope','row');
        let td=document.createElement('td');
        td.innerHTML=i;
        tr.append(td);
        List.push(i);
        row.forEach(col=>{
          let td=document.createElement('td');
          td.innerHTML=col;
          tr.append(td);
        });
        $('#data_table').append(tr);
      }else{
        let thead = document.createElement('thead');
        thead.classList='bg-dark text-white shadow py-2';
        let col = document.createElement('td');
        col.setAttribute('scope','col');
        col.innerHTML= 'S.No.';
        thead.append(col);
        row.forEach(header => {
          let col = document.createElement('td');
          col.setAttribute('scope','col');
          col.innerHTML= header;
          thead.append(col);
        })
        $('#data_table').html(thead);
      }
    });

  });

  let progress = document.createElement('div');
  progress.classList= 'progress';
  let bar = document.createElement('div');
  bar.classList ='progress-bar bg-danger progress-bar-striped';
  bar.setAttribute('role','progressbar');
  progress.append(bar);
  document.querySelector('#upload_progress').append(progress);


  reader.addEventListener('progress', (event) => {
    if (event.loaded && event.total) {
      const percent = (event.loaded / event.total) * 100;
      bar.style.width=Math.round(percent)+'%';
      bar.innerHTML=Math.round(percent)+'% Uploaded';
      console.log(`Progress: ${Math.round(percent)}`);
    }
  });
  reader.readAsText(file);
}