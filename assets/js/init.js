const SITE_ROOT= 'https://ec2-13-232-85-72.ap-south-1.compute.amazonaws.com/';
const MEET_REJECTED = 0;
const MEET_CONFIRMED = 1;
const MEET_SCHEDULED = 2;



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
