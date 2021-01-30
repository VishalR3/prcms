/** @jsx createElement */
/*** @jsxFrag createFragment */

const createElement = (tag, props, ...children) => {
  if (typeof tag === "function") return tag(props, ...children);
  const element = document.createElement(tag);

  Object.entries(props || {}).forEach(([name, value]) => {
    if (name.startsWith("on") && name.toLowerCase() in window)
      element.addEventListener(name.toLowerCase().substr(2), value);
    else element.setAttribute(name, value.toString());
  });

  children.forEach(child => {
    appendChild(element, child);
  });

  return element;
};

const appendChild = (parent, child) => {
  if (Array.isArray(child))
    child.forEach(nestedChild => appendChild(parent, nestedChild));
  else
    parent.appendChild(child.nodeType ? child : document.createTextNode(child));
};

const createFragment = (props, ...children) => {
  return children;
};

let VisitList = [];
$(function(){
  $('#sign_visitor_out').click(()=>{
    $.confirm({
      title:'Sign Out this Visitor',
      buttons : {
        signOut: {
          text: 'Sign Out',
          btnClass : 'btn-red',
          action:function(){
            firebase.auth().signOut();
            console.log('Signed Out!!');
            window.location.href=SITE_ROOT+"visitors_management";
          }
        },
        cancel:function(){
        }
      }
    })
  });

  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {

    $('#visitor_details_form').submit(e=>{
      e.preventDefault();
      let payload = {
        'name':$('#name').val(),
        'uid':user.uid,
        'v_mobile':user.phoneNumber,
        'from_comp':$('#from_comp').val(),
        'no_of_people':$('#no_of_people').val(),
        'to_meet':$('#to_meet option:selected').val(),
        'purpose':$('#purpose option:selected').val(),
        'date_from':$('#date_from').val(),
        'time_from':$('#time_from').val(),
        'date_to':$('#date_to').val(),
        'time_to':$('#time_to').val(),
        'photo':$('#visitorPhoto').val()
      };
      $.post(SITE_ROOT+'visitor/sendDetails',payload,(res)=>{
        res=JSON.parse(res);
        window.location.reload();
      })
    });    


      let mobile = user.phoneNumber;
      getPreviousVisits(mobile);
  }});


  $('#purpose').select2();
  $('#to_meet').select2();

  $('#purpose').change((e)=>{
    if(e.target.value=='0'){
      document.getElementById('alt_purp').classList="form-control";
    }else{
      document.getElementById('alt_purp').classList="form-control d-none";
    }
  });
  document.getElementById('alt_purp').addEventListener('change',(e)=>{
    let purp = e.target.value;
    $.confirm({
      title : 'Add this Purpose ??',
      content:e.target.value,
      buttons:{
        confirm:function(){
          $.post(SITE_ROOT+'visitor/addPurpose',{'purpose':purp},(res)=>{
            if(res){
              res=JSON.parse(res);
              console.log(res);
              var option = new Option(purp, res.insert_id, true, true);
              $('#purpose').append(option).trigger('change');
            }
          });
        },
        cancel:function(){
          console.log('Cancelled!!');
        },
      }
    })

  });


  renderVideo();

  

  $('#searchVisit').change((e)=>{
    let val = e.target.value;
    let term= val.toLowerCase();
    let FilteredList=[];
    VisitList.forEach(item=>{
      if(item.purpose.toLowerCase().search(term)!=-1){
        FilteredList.push(item);
      }
    });
    document.getElementById('previous_visits').innerHTML='';
    FilteredList.forEach(visit=>{
      document.getElementById('previous_visits').appendChild(<VisitCard visit={visit}/>);
    })
    e.target.value="";

    let tag= document.createElement('div');
    tag.classList='closeTag';
    tag.innerHTML = val + "<i class='fa fa-times ml-2'></i>";
    tag.addEventListener('click',()=>{
      document.getElementById('previous_visits').innerHTML='';
      VisitList.forEach(visit=>{
        document.getElementById('previous_visits').appendChild(<VisitCard visit={visit}/>);
      })
      tag.remove();
    });
    document.querySelector('.searchWrapper').append(tag);
  })

  
  
});
function getPreviousVisits(mobile){
  let promise = new Promise((resolve)=>{
    $.post(SITE_ROOT+'visitor/getPreviousVisits',{'v_mobile':mobile},(res)=>{
      res=JSON.parse(res);
      VisitList = res;
        res.forEach(visit=>{
          document.getElementById('previous_visits').appendChild(<VisitCard visit={visit}/>)
        });
        resolve(true);
    });
  })
  promise.then(success => {
    if(success){
      // setTimeout(()=>{
        document.querySelectorAll('.copy_btn').forEach(Element=>{
          Element.addEventListener('click',(e)=>{
            e.preventDefault();
            let visit = JSON.parse(e.target.getAttribute('data'));
            $('#name').val(visit.name);
            $('#no_of_people').val(visit.no_of_people);
            $('#date_from').val(visit.dov_from.substr(0,10));
            $('#time_from').val(visit.dov_from.substr(11));
            $('#date_to').val(visit.dov_to.substr(0,10));
            $('#time_to').val(visit.dov_to.substr(11));
          });
        });
      // },1500);
    }
  }

  );
}

const VisitCard = (props) => {
  let colorClass ='';
  if(props.visit.to_meet_conf== MEET_REJECTED)
  {colorClass = 'm-reject'}
  else if(props.visit.to_meet_conf== MEET_CONFIRMED)
  {colorClass='m-confirm'}
  else if(props.visit.to_meet_conf== MEET_SCHEDULED){
    colorClass = 'm-reschedule'
  }
  return(
  <div class={`card mt-3 br-2 details_card ${colorClass}`}>
    <div class='card-body'>
      <div class='d-flex justify-content-between'>
        <div>
          <h5>{props.visit.name}</h5>
          <span class='id'>Visit ID : {props.visit.visit_id}</span>
        </div>
        <div class='copy_div'>
          <a href="#" class='copy_btn' data={JSON.stringify(props.visit)}><i class="fa fa-copy mr-2"></i>Copy Data</a>
        </div>
      </div>
      <div class='details'>
        <span class='detail'>To Meet : {props.visit.to_meet}</span>
        <span class='id'>{props.visit.dov_from} - {props.visit.dov_to}</span>
        <span class='detail mt-2'><b>Purpose : </b>{props.visit.purpose}</span>
        <i>{(props.visit.to_meet_conf== MEET_REJECTED) ? <b>Reason - {props.visit.denial_reason}</b>   :''}</i>
        {(props.visit.to_meet_conf== MEET_SCHEDULED) ? <b>Rescheduled At - {props.visit.proposed_time}</b>   :''}
      </div>
    </div>
  </div>
  )
};


var imgCapture;

const renderVideo = ()=> {
  var constraints = { audio: false, video: { width: 1280, height: 720} };
  
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
$('#capture_btn').click(e=>{
  e.preventDefault();

  takepicture();
  
})

function takepicture() {
  var canvas = document.getElementById('canvas');
  var video = document.querySelector('.camera_input');
  var photo = document.getElementById('photo');
  var context = canvas.getContext('2d');
  // let width = video.videoWidth;
  // let height = video.videoHeight;
  var width= 350;
  var height = width* video.videoHeight/video.videoWidth;
    canvas.width = width;
    canvas.height =height;
    context.drawImage(video, 0, 0, width, height);

    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
    $('#usephoto').show();
} 