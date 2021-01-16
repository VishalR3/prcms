/** @jsx createElement */
/*** @jsxFrag createFragment */


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
      };

      console.log(payload);
      $.post(SITE_ROOT+'visitor/sendDetails',payload,(res)=>{
        res=JSON.parse(res);
        console.log(res);
        window.location.reload();
      })
    });    


      let mobile = user.phoneNumber;
      getPreviousVisits(mobile);
  }});

  $('#purpose').select2();
  $('#to_meet').select2();
  $('#from_comp').select2();

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
  
});
function getPreviousVisits(mobile){
  $.post(SITE_ROOT+'visitor/getPreviousVisits',{'v_mobile':mobile},(res)=>{
    res=JSON.parse(res);
    console.log(res);
    res.forEach(visit=>{
      document.getElementById('previous_visits').appendChild(<VisitCard visit={visit}/>)

    });
  });
}

const VisitCard = (props) => {
  let colorClass ='';
  if(props.visit.to_meet_conf== MEET_REJECTED)
  {colorClass = 'm-reject'}
  else if(props.visit.to_meet_conf== MEET_CONFIRMED)
  {colorClass='m-confirm'}
  return(
  <div class={`card mt-3 br-2 details_card ${colorClass}`}>
    <div class='card-body'>
      <div class='d-flex justify-content-between'>
        <div>
          <h5>{props.visit.name}</h5>
          <span class='id'>Visit ID : {props.visit.visit_id}</span>
        </div>
        <div class='copy_div'>
          <a href="#" class='copy_btn'><i class="fa fa-copy mr-2"></i>Copy Data</a>
        </div>
      </div>
      <div class='details'>
        <span class='detail'>To Meet : {props.visit.to_meet}</span>
        <span class='id'>{props.visit.dov_from} - {props.visit.dov_to}</span>
        <span class='detail mt-2'><b>Purpose : </b>{props.visit.purpose}</span>
        <i>{(props.visit.to_meet_conf== MEET_REJECTED) ? <b>Reason - {props.visit.denial_reason}</b>   :''}</i>
      </div>
    </div>
  </div>
  )
};