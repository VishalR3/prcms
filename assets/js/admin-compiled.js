"use strict";

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

/** @jsx createElement */

/*** @jsxFrag createFragment */
var createElement = function createElement(tag, props) {
  for (var _len = arguments.length, children = new Array(_len > 2 ? _len - 2 : 0), _key = 2; _key < _len; _key++) {
    children[_key - 2] = arguments[_key];
  }

  if (typeof tag === "function") return tag.apply(void 0, [props].concat(children));
  var element = document.createElement(tag);
  Object.entries(props || {}).forEach(function (_ref) {
    var _ref2 = _slicedToArray(_ref, 2),
        name = _ref2[0],
        value = _ref2[1];

    if (name.startsWith("on") && name.toLowerCase() in window) element.addEventListener(name.toLowerCase().substr(2), value);else element.setAttribute(name, value.toString());
  });
  children.forEach(function (child) {
    appendChild(element, child);
  });
  return element;
};

var appendChild = function appendChild(parent, child) {
  if (Array.isArray(child)) child.forEach(function (nestedChild) {
    return appendChild(parent, nestedChild);
  });else parent.appendChild(child.nodeType ? child : document.createTextNode(child));
};

var createFragment = function createFragment(props) {
  for (var _len2 = arguments.length, children = new Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {
    children[_key2 - 1] = arguments[_key2];
  }

  return children;
};

$('#is_employee').change(function () {
  $('#empIdDiv').toggle();
}); //User Registration

$('#reg_user_form').submit(function (e) {
  e.preventDefault();
  var payload = {
    'username': $('#username').val(),
    'mobile': $('#mobile').val(),
    'password': $('#password').val(),
    'is_employee': document.getElementById('is_employee').checked ? '1' : '0',
    'empID': document.getElementById('is_employee').checked ? $('#empID').val() : '0',
    'role': $('#role option:selected').val()
  };
  $.post(SITE_ROOT + 'user/registerUser', payload, function (res) {
    res = JSON.parse(res);
    console.log(res);

    if (res.success) {
      var user = {
        'username': payload.username,
        'user_id': res.insert_id,
        'mobile': payload.mobile,
        'role': payload.role
      };
      document.getElementById('users_list').appendChild(createElement(Card, {
        user: user
      }));
      window.location.reload();
    } else {
      $.alert("".concat(res.errors), 'Operation Failed');
    }
  });
  console.log(payload);
});

var Card = function Card(props) {
  return createElement("div", {
    "class": "card mt-3 br-2 user_card"
  }, createElement("div", {
    "class": "card-body"
  }, createElement("div", {
    "class": "d-flex justify-content-between"
  }, createElement("div", null, createElement("h5", null, props.user.username), createElement("span", {
    "class": "userId"
  }, "User ID : ", props.user.user_id)), createElement("div", {
    "class": "edit_user"
  }, createElement("a", {
    href: "#",
    "class": "edit_btn"
  }, createElement("i", {
    "class": "fa fa-edit mx-2"
  }), "Edit User"))), createElement("div", {
    "class": "user_details"
  }, createElement("span", {
    "class": "detail"
  }, "Mobile : ", props.user.mobile)), createElement("div", {
    "class": "user_role"
  }, props.user.role)));
};

$(function () {
  var empID;
  var cache = {};
  $("#empID").autocomplete({
    minLength: 2,
    source: function source(request, response) {
      var term = request.term;

      if (term in cache) {
        response(cache[term]);
        return;
      }

      $.post(SITE_ROOT + "api/searchEmployee", request, function (res) {
        cache[term] = res;
        response(res);
      });
    },
    select: function select(event, ui) {
      empID = ui.item.empID;
      $('#empID').trigger('myEvent');
    }
  });
  $('#empID').on('myEvent', function (e) {
    setTimeout(function () {
      $('#empID').val(empID);
    }, 50);
  });
});
