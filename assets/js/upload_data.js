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
  List.forEach(row=>{
    if(Array.isArray(row)){
      let payload = {
        'name': row[0],
        'location':row[1],
        'shift':row[2],
        'dept':row[3],
        'status':row[4],
        'active':row[5],
        'mobile':row[6],
        'email':row[7]
      }
      $.post(SITE_ROOT+ 'api/addEmployee',payload,function(res){
        res=JSON.parse(res);
        if(res.success){
          console.log('Emp ID : '+res.empID);
        }else{
          console.log(`${res.name} is not inserted, Error : ${res.errors}`)
        }
      });
    }else{
      console.log((row+1)+' Added!!');
    }
  });
})

$(function(){
  $('#master_type').on('change',e=>{
    console.log($('#master_type').val())
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
    let thead = document.createElement('thead');
    thead.classList='bg-dark text-white shadow py-2';
    let headers = ['S.No.','Name','Location','Shift','Department','Status','Active','Mobile','Email'];
    headers.forEach(header => {
      let col = document.createElement('td');
      col.setAttribute('scope','col');
      col.innerHTML= header;
      thead.append(col);
    })
    $('#data_table').html(thead);

    data.forEach((row,i)=>{
       let tr= document.createElement('tr');
       tr.setAttribute('scope','row');
       let td=document.createElement('td');
       td.innerHTML=i+1;
       tr.append(td);
       List.push(i);
       row.forEach(col=>{
         let td=document.createElement('td');
         td.innerHTML=col;
         tr.append(td);
       });
       $('#data_table').append(tr);
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
