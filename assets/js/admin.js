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



$('input[name="user_type"]').on('change',function (e) {
  console.log(document.getElementById('is_employee').checked?'1':'0')
  if(e.target.value =='0'){
    $('#empIdDiv').find('label').text('Contractor ID (Search Contactor by name)')
    $('#cont_id').attr('type','text')
    $('#empID').attr('type','hidden')
  }else{
    $('#empIdDiv').find('label').text('Employee ID (Search Employee by name)')
    $('#cont_id').attr('type','hidden')
    $('#empID').attr('type','text')
  }
});

//User Registration

$('#reg_user_form').on('submit',(e)=>{
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
    if(res.success){
      let user = {
        'username':payload.username,
        'user_id':res.insert_id,
        'mobile':payload.mobile,
        'role':payload.role
      }
      document.getElementById('users_list').appendChild(<Card user={user} />);
      window.location.reload();
    }else{
      $.alert(`${res.errors}`,'Operation Failed')
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

$(function() {
  let empID;
  var cache = {};
  $("#empID").autocomplete({
    minLength: 2,
    source: function(request, response) {
      var term = request.term;
      if (term in cache) {
        response(cache[term]);
        return;
      }

      $.post(SITE_ROOT + "api/searchEmployee", request, (res) => {
        cache[term] = res;
        response(res);
      });
    },
    select: function( event, ui ) {
      empID = ui.item.empID;
      $('#username').val(ui.item.name)
      $('#mobile').val(ui.item.mobile)
      $('#password').val(ui.item.name.substr(0,3) + ui.item.dob.replace(/-/g,''))
      $('#empID').trigger('empEvent');
    }
  });
  $('#empID').on('empEvent',e=>{
    setTimeout(()=>{
      $('#empID').val(empID);
    },50)
  })
  let contID;
  var contCache = {};
  $("#cont_id").autocomplete({
    minLength: 2,
    source: function(request, response) {
      var term = request.term;
      if (term in contCache) {
        response(contCache[term]);
        return;
      }

      $.post(SITE_ROOT + "api/searchContractor", request, (res) => {
        contCache[term] = res;
        response(res);
      });
    },
    select: function( event, ui ) {
      contID = ui.item.cont_id;
      $('#username').val(ui.item.cont_name)
      $('#mobile').val(ui.item.mobile)
      $('#password').val(ui.item.cont_name.substr(0,3) + ui.item.mobile.slice(-10,-3))
      $('#cont_id').trigger('contEvent');
    }
  });
  $('#cont_id').on('contEvent',()=>{
    setTimeout(()=>{
      $('#cont_id').val(contID);
    },50)
  })
});

