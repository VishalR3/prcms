import {SITE_ROOT} from './init.js';

window.onload=()=>{
  $.get(SITE_ROOT+'api/getEmpReports',(res)=>{
      renderTable(res);
  });

}


document.querySelector('#from').addEventListener('change',function(){
  let from = this.value;
  let to = document.querySelector('#to').value;
  let payload ={
    'from':from,
    'to':to
  } ;
  $.post(SITE_ROOT+'api/getEmpReportsDateRange/',payload,(res)=>{
    renderTable(res);
  });
});
document.querySelector('#to').addEventListener('change',function(){
  let from = document.querySelector('#from').value;
  let to = this.value;
  let payload ={
    'from':from,
    'to':to
  } ;
  $.post(SITE_ROOT+'api/getEmpReportsDateRange/',payload,(res)=>{
    renderTable(res);
  });
});
function renderTable(res){
  let thead = document.createElement('thead');
    thead.classList='bg-dark text-white';
    let headers = ['Emp Id','Name','Location','Shift','Department','Mobile','Date','In Time','Out Time','Total Time Spent'];
    headers.forEach(header => {
      let col = document.createElement('td');
      col.setAttribute('scope','col');
      col.innerHTML= header;
      thead.append(col);
    })
    $('#emp_report').html(thead);
    res.forEach(tran => {
      let row = document.createElement('tr');
      row.setAttribute('scope',"row");
      for (let key in tran){
          let col = document.createElement('td');
          col.innerHTML = tran[key];
          row.append(col);
      }
      $('#emp_report').append(row);
    });
}