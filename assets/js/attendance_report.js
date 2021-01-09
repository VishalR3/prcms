import {SITE_ROOT} from './init.js';

window.onload=()=>{
  $.get(SITE_ROOT+'api/getEmpReports',function(res){
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
  });

}