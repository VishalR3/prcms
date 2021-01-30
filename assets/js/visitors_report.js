
var List = [];
var downloadableList = [];

window.onload=()=>{
  $.get(SITE_ROOT+'api/getVisitorReports',(res)=>{
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
      $.post(SITE_ROOT+'api/makePDF',{"html":html},function(res){$.alert('File Saved!!!')})
      break;
    case "csv":
      let rows = $.csv.fromObjects(downloadableList);
      let csvContent = 'data:text/csv;charset=utf-8,'+ rows;
      var encodedURI = encodeURI(csvContent);
      var link = document.createElement('a');
      link.setAttribute('href',encodedURI);
      link.setAttribute('download','Visitor Data.csv');
      link.classList='d-none';
      document.body.appendChild(link);
      link.click();
      break;
    case "xlsx":
      $.alert("Working On It!!");
      break;
  }

});

$('#search').change((e)=>{
  let term= e.target.value.toLowerCase();
  let FilteredList=[];
  List.forEach(item=>{
    if(item.to_meet.toLowerCase().search(term)!=-1){
      FilteredList.push(item);
    }
  });
  renderTable(FilteredList);
  console.log(FilteredList);
  e.target.value="";
})


document.querySelector('#from').addEventListener('change',function(){
  getDateReports();
});
document.querySelector('#to').addEventListener('change',function(){
  getDateReports();
});
function getDateReports(){
  let from = document.querySelector('#from').value;
  let to = document.querySelector('#to').value;
  let payload ={
    'from':from,
    'to':to
  } ;
  $.post(SITE_ROOT+'api/getVisitorReportsDateRange/',payload,(res)=>{
    renderTable(res);
    setList(res);
  });
}

//Render Table
function renderTable(res){
  downloadableList = res;
  let thead = document.createElement('thead');
    thead.classList='bg-dark text-white';
    let headers = ['Visit Id','Name','From Company','To Meet','Mobile','Date','In Time','Out Time','Purpose'];
    headers.forEach(header => {
      let col = document.createElement('td');
      col.setAttribute('scope','col');
      col.classList.add('p-2');
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
    console.log(res);
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
