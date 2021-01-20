/** @jsx createElement */
/*** @jsxFrag createFragment */

$('.shutter-title').click(function(){
  $(this).next().slideToggle();
});

$(function(){
  $('.accept_link').click((e)=>{
    let visit_id = e.target.getAttribute('data-id');
    $.post(SITE_ROOT+'api/approveVisit',{'visit_id':visit_id},(res)=>{
      console.log(res);
      if(res){
        window.location.reload();
      }
    })
  })
  
  $('.reject_link').click((e)=>{
    let visit_id = e.target.getAttribute('data-id');
    const getReason  = new Promise((resolve,reject)=>{
      $.confirm({
        title:'Reason For Denial',
        content:"<input type='text' name='reason' id='reason' class='form-control'/>",
        closeIcon:true,
        buttons : {
          confirm: function(){
            let reason = this.$body.find('#reason').val()
            if(reason!=""){
              resolve(reason);
            }else{
              reject("No Value Entered!!");
            }
          }
        }
      })
    })
    getReason.then(reason=>{
      $.post(SITE_ROOT+'api/rejectVisit',{'visit_id':visit_id,"reason":reason},(res)=>{
        console.log(res);
        if(res){
          window.location.reload();
        }
      })
    }).catch(error => $.alert(error,'Rejection Failed'));


  })
  $('.reschedule_link').click((e)=>{
    let visit_id = e.target.getAttribute('data-id');
    const getReason  = new Promise((resolve,reject)=>{
      $.confirm({
        title:'Enter Proposed Time',
        content:"<input type='date' name='date' id='date' class='form-control'/><input type='time' name='time' id='time' class='form-control'/>",
        closeIcon:true,
        buttons : {
          confirm: function(){
            let date = this.$body.find('#date').val();
            let time = this.$body.find('#time').val();
            let data = date+" "+time;
            if(date!=""){
              resolve(data);
            }else{
              reject("No Date Entered!!");
            }
          }
        }
      })
    })
    getReason.then((datetime)=>{
      $.post(SITE_ROOT+'api/rescheduleVisit',{'visit_id':visit_id,"datetime":datetime},(res)=>{
        console.log(res);
        if(res){
          window.location.reload();
        }
      })
    }).catch(error => $.alert(error,'ReScheduling Failed'));


  })
})

$('.exit_meet').click((e)=>{
  let visit_id = e.target.getAttribute('data-id');
  $.post(SITE_ROOT+'api/finishVisit',{'visit_id':visit_id},(res)=>{
    console.log(res);
    if(res){
      window.location.reload();
    }
  })
})

