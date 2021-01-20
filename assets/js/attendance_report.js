
var List = [];
var downloadableList = [];

window.onload=()=>{
  $.get(SITE_ROOT+'api/getEmpReports',(res)=>{
      renderTable(res);
      setList(res);
  });
}

$('#download_btn').click(()=>{
  let type = document.querySelector('#download_type').value;
  console.log(type);
  switch(type){
    case "pdf":
      var table = document.querySelector('#emp_report').innerHTML;
      var html = `<table>${table}</table>`;
      $.post(SITE_ROOT+'api/makePDF',{"html":html},function(res){
        console.log(res);
        $.alert('File Saved!!');
      })
      break;
    case "csv":
      let rows = $.csv.fromObjects(downloadableList);
      let csvContent = 'data:text/csv;charset=utf-8,'+ rows;
      let encodedURI = encodeURI(csvContent);
      let link = document.createElement('a');
      link.setAttribute('href',encodedURI);
      link.setAttribute('download','Attendance Data.csv');
      link.classList='d-none';
      document.body.appendChild(link);
      link.click();
      break;
    case "xlsx":
      $.alert("Working On It!!");
      break;
    case 'json':
      let jsonContent = 'data:text/json;charset=utf-8,'+ JSON.stringify(downloadableList);
      encodedURI = encodeURI(jsonContent);
      link = document.createElement('a');
      link.setAttribute('href',encodedURI);
      link.setAttribute('download','Attendance Data.json');
      link.classList='d-none';
      document.body.appendChild(link);
      link.click();
      break;
  }

});

$('#search').change((e)=>{
  let term= e.target.value.toLowerCase();
  let FilteredList=[];
  List.forEach(item=>{
    if(item.name.toLowerCase().search(term)!=-1){
      FilteredList.push(item);
    }
  });
  renderTable(FilteredList);
  console.log(FilteredList);
  e.target.value="";
})

$('#location').on('change',()=>{
  getDateReports();
});
$('#dept').on('change',()=>{
  getDateReports();
});


document.querySelector('#from').addEventListener('change',function(){
  getDateReports();
});
document.querySelector('#to').addEventListener('change',function(){
  getDateReports();
});
function getDateReports(){
  let from = document.querySelector('#from').value;
  let to = document.querySelector('#to').value;
  let loc_filter = $('#location option:selected').val();
  let dept_filter = $('#dept option:selected').val();
  let payload ={
    'from':from,
    'to':to,
    'loc_filter':loc_filter,
    'dept_filter':dept_filter
  } ;
  $.post(SITE_ROOT+'api/getEmpReportsDateRange/',payload,(res)=>{
    renderTable(res);
    setList(res);
  });
}

//Render Table
function renderTable(res){
  downloadableList = res;
  let thead = document.createElement('thead');
    thead.classList='bg-dark text-white';
    let headers = ['Emp Id','Name','Location','Shift','Department','Mobile','Date','In Time','Out Time','Total Time Spent'];
    headers.forEach(header => {
      let col = document.createElement('td');
      col.setAttribute('scope','col');
      col.classList.add('p-2');
      col.innerHTML= header;
      thead.append(col);
    })
    $('#emp_report').html(thead);
    if(Array.isArray(res)){
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
  }
  function setList(res){
    List = res;
}

function filterLocation(val){
  let res=[];
  getDateReports();
  if(val!="all"){
    setTimeout(()=>{
      List.forEach(tran=>{
        if(tran.location==val){
          res.push(tran);
        }
      });
      renderTable(res);
    },200);
  }else{
    renderTable(List);
  }
}
