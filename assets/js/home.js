
// window.onload=()=>{
//   $.get(SITE_ROOT+'api/getEmpReportsForHome',(res)=>{
//       renderTable(res);
//   });
// }

// //Render Table
// function renderTable(res){
//   let thead = document.createElement('thead');
//     thead.classList='bg-dark text-white';
//     let headers = ['Emp Id','Name','In Time','Out Time'];
//     headers.forEach(header => {
//       let col = document.createElement('td');
//       col.setAttribute('scope','col');
//       col.classList.add('p-2');
//       col.innerHTML= header;
//       thead.append(col);
//     })
//     $('#realtime_data').html(thead);
//     res.forEach(tran => {
//       let row = document.createElement('tr');
//       row.setAttribute('scope',"row");
//       for (let key in tran){
//           let col = document.createElement('td');
//           col.innerHTML = tran[key];
//           row.append(col);
//       }
//       $('#realtime_data').append(row);
//     });
// }


const table =document.getElementById('realtime_table');
const liveCam = firebase.database().ref().child('liveCam');

liveCam.on('child_added',snap=>{
  let tr = document.createElement('tr');
  tr.id=snap.key;
  let id = document.createElement('td');
  id.innerHTML=snap.val().empID;
  let name = document.createElement('td');
  name.innerHTML=snap.val().name;
  let shift = document.createElement('td');
  shift.innerHTML=snap.val().shift;
  tr.append(id,name,shift);
  table.append(tr);
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
liveCam.on('child_removed',snap=>{
  let tr=document.getElementById(snap.key);
  tr.remove();
});

const todayTable =document.getElementById('realtime_data');
const today = firebase.database().ref().child('today');
today.on('child_added',snap=>{
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