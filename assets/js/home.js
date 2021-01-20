
// window.onload=()=>{
//   $.get(SITE_ROOT+'api/getEmpReportsForHome',(res)=>{
//       renderTable(res);
//   });
// }

let TodayList = [];

//Render Table
function renderTable(res){
    let thead = document.createElement('thead');
    thead.classList='bg-dark text-white';
    let headers = ['Emp Id','Name','In Time','Out Time'];
    headers.forEach(header => {
      let col = document.createElement('td');
      col.setAttribute('scope','col');
      col.classList.add('p-2');
      col.innerHTML= header;
      thead.append(col);
    })
    $('#realtime_data').html(thead);
    res.forEach(tran => {
      let row = document.createElement('tr');
      row.setAttribute('scope',"row");
      let col = document.createElement('td');
      col.innerHTML = tran['empID'];
      row.append(col);
      col = document.createElement('td');
      col.innerHTML = tran['name'];
      row.append(col);
      col = document.createElement('td');
      col.innerHTML = tran['in_time'];
      row.append(col);
      col = document.createElement('td');
      col.innerHTML = tran['out_time'];
      row.append(col);
      $('#realtime_data').append(row);
    });
}


const table =document.getElementById('realtime_table');
const liveCam = firebase.database().ref().child('liveCam');

liveCam.on('child_added',snap=>{
  let tr = document.createElement('tr');
  tr.id=snap.key;
  if(snap.val().visitor == true){
    let id = document.createElement('td');
    id.innerHTML="V1";
    let name = document.createElement('td');
    name.innerHTML="Visitor";
    let shift = document.createElement('td');
    shift.innerHTML="<a href='"+SITE_ROOT+"visitors_management'>Visitor Management</a>";
    tr.append(id,name,shift);
  }else{
    console.log('Employee');
    let id = document.createElement('td');
    id.innerHTML=snap.val().empID;
    let name = document.createElement('td');
    name.innerHTML=snap.val().name;
    let shift = document.createElement('td');
    shift.innerHTML=snap.val().shift;
    tr.append(id,name,shift);
  }
  table.append(tr);
  setTimeout(()=>{
    tr.remove();
  },60000);
});
liveCam.on('child_changed',snap=>{
  let tr=document.getElementById(snap.key);
  let id = document.createElement('td');
  id.innerHTML=snap.val().empID;
  let name = document.createElement('td');
  name.innerHTML=snap.val().name;
  let shift = document.createElement('td');
  shift.innerHTML=snap.val().shift;
  tr.innerHTML='';
  tr.append(id,name,shift);
});




navigator.mediaDevices.enumerateDevices()
.then(function(devices) {
  devices.forEach(function(device) {
    if(device.kind.startsWith('video')){
      let option = new Option(device.label,device.deviceId);
      document.querySelector('#input_video').append(option);
    }
  });
})
.catch(function(err) {
  console.log(err.name + ": " + err.message);
});

window.onload = ()=>{
  renderVideo();
  renderRealtimeData();
}

$('#search').change(e=>{
  let val = e.target.value;
  let term= val.toLowerCase();
  let FilteredList=[];
  TodayList.forEach(item=>{
    if(item.name.toLowerCase().search(term)!=-1){
      FilteredList.push(item);
    }
  });
  renderTable(FilteredList);
  e.target.value="";

  let tag= document.createElement('div');
  tag.classList='closeTag';
  tag.innerHTML = val + "<i class='fa fa-times ml-2'></i>";
  tag.addEventListener('click',()=>{
    renderRealtimeData();
    tag.remove();
  });
  document.querySelector('.searchWrapper').append(tag);
})
$('#input_video').change(()=>{
  renderVideo();
})

function renderRealtimeData(){
  let thead = document.createElement('thead');
  thead.classList='bg-dark text-white';
  let headers = ['Emp Id','Name','In Time','Out Time'];
  headers.forEach(header => {
    let col = document.createElement('td');
    col.setAttribute('scope','col');
    col.classList.add('p-2');
    col.innerHTML= header;
    thead.append(col);
  })
  $('#realtime_data').html(thead);
  const todayTable =document.getElementById('realtime_data');
  const today = firebase.database().ref().child('today');
  today.on('child_added',snap=>{
    TodayList.push(snap.val());
    let tr = document.createElement('tr');
    tr.id=snap.key;
    let id = document.createElement('td');
    id.innerHTML=snap.val().empID;
    let name = document.createElement('td');
    name.innerHTML=snap.val().name;
    let inTime = document.createElement('td');
    inTime.innerHTML=snap.val().in_time;
    let outTime = document.createElement('td');
    outTime.innerHTML=snap.val().out_time;
    tr.append(id,name,inTime,outTime);
    todayTable.append(tr);
  });
  today.on('child_changed',snap=>{
    let tr=document.getElementById(snap.key);
    let id = document.createElement('td');
    id.innerHTML=snap.val().empID;
    let name = document.createElement('td');
    name.innerHTML=snap.val().name;
    let inTime = document.createElement('td');
    inTime.innerHTML=snap.val().in_time;
    let outTime = document.createElement('td');
    outTime.innerHTML=snap.val().out_time;
    tr.innerHTML='';
    tr.append(id,name,inTime,outTime);
  });
  today.on('child_removed',snap=>{
    let tr=document.getElementById(snap.key);
    tr.remove();
  });

}

const renderVideo = ()=> {
  let prefDevice = document.querySelector('#input_video').value;
  var constraints = { audio: false, video: { width: 1280, height: 720, deviceId: prefDevice } };
  
  navigator.mediaDevices.getUserMedia(constraints)
  .then(function(mediaStream) {
    var video = document.querySelector('.camera_input');
    video.srcObject = mediaStream;
    video.onloadedmetadata = function(e) {
      video.play();
    };
  })
  .catch(function(err) { console.log(err.name + ": " + err.message); }); // always check for errors at the end.
}


