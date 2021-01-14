
/** @jsx createElement */
/*** @jsxFrag createFragment */


window.onload=()=>{
  $('#empIdDiv').hide();
  
};

$('#is_employee').change(()=>{
  $('#empIdDiv').toggle();
})

//User Registration

$('#reg_user_form').submit((e)=>{
  e.preventDefault();
  let payload={
    'username': $('#username').val(),
    'mobile':$('#mobile').val(),
    'password':$('#password').val(),
    'is_employee':document.getElementById('is_employee').checked?'1':'0',
    'empID': document.getElementById('is_employee').checked?$('#empID').val():'0',
    'role':$('#role option:selected').val(),
  }
  $.post(SITE_ROOT+'user/registerUser',payload,(res)=>{
    res=JSON.parse(res);
    console.log(res);
    if(res){
      let user = {
        'username':payload.username,
        'user_id':res.insert_id,
        'mobile':payload.mobile,
        'role':payload.role
      }
      document.getElementById('users_list').appendChild(<Card user={user} />);
    }
  });
  console.log(payload);
});

const Card =(props) => (
  <div class="card mt-3 br-2 user_card">
    <div class="card-body">
    <div class="d-flex justify-content-between">
      <div>
        <h5>{props.user.username}</h5>
        <span class='userId'>User ID : {props.user.user_id}</span>
      </div>
      <div class='edit_user'>
        <a href='#' class="edit_btn"><i class="fa fa-edit mx-2"></i>Edit User</a>
      </div>
    </div>
    <div class='user_details'>
      <span class='detail'>Mobile : {props.user.mobile}</span>
    </div>
    <div class='user_role'>
      {props.user.role}
    </div>
    </div>
  </div>
);

