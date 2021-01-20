const SITE_ROOT= 'http://localhost/attendance/';
const MEET_REJECTED = 0;
const MEET_CONFIRMED = 1;
const MEET_SCHEDULED = 2;


$('#upload').change((e)=>{
  console.log(e.target.files[0].name);
  readFile(e.target.files[0]);
});
let List;

$('#emp_batch_form').submit((e)=>{
  e.preventDefault();
  if(!Array.isArray(List)){
    console.log('Nothing Selected!!');
    document.querySelector('#emp_batch_form').classList.add('was-validated');
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

$(function(){
  $('.delete_btn').click((e)=>{
    e.preventDefault();
    $.confirm({
      title:'Are You Sure?',
      content:"Do you want to continue?",
      buttons:{
        confirm:{
          btnClass:'btn-red',
          action:function(){
          window.location.href=e.target.href;
        }},
        cancel:function(){
          console.log('Cancelled!!');
        }
      }
    })
    
  })
});