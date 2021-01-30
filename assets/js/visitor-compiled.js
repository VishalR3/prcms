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

var VisitList = [];
$(function () {
  $('#sign_visitor_out').click(function () {
    $.confirm({
      title: 'Sign Out this Visitor',
      buttons: {
        signOut: {
          text: 'Sign Out',
          btnClass: 'btn-red',
          action: function action() {
            firebase.auth().signOut();
            console.log('Signed Out!!');
            window.location.href = SITE_ROOT + "visitors_management";
          }
        },
        cancel: function cancel() {}
      }
    });
  });
  firebase.auth().onAuthStateChanged(function (user) {
    if (user) {
      $('#visitor_details_form').submit(function (e) {
        e.preventDefault();
        var payload = {
          'name': $('#name').val(),
          'uid': user.uid,
          'v_mobile': user.phoneNumber,
          'from_comp': $('#from_comp').val(),
          'no_of_people': $('#no_of_people').val(),
          'to_meet': $('#to_meet option:selected').val(),
          'purpose': $('#purpose option:selected').val(),
          'date_from': $('#date_from').val(),
          'time_from': $('#time_from').val(),
          'date_to': $('#date_to').val(),
          'time_to': $('#time_to').val(),
          'photo': $('#visitorPhoto').val()
        };
        $.post(SITE_ROOT + 'visitor/sendDetails', payload, function (res) {
          res = JSON.parse(res);
          window.location.reload();
        });
      });
      var mobile = user.phoneNumber;
      getPreviousVisits(mobile);
    }
  });
  $('#purpose').select2();
  $('#to_meet').select2();
  $('#purpose').change(function (e) {
    if (e.target.value == '0') {
      document.getElementById('alt_purp').classList = "form-control";
    } else {
      document.getElementById('alt_purp').classList = "form-control d-none";
    }
  });
  document.getElementById('alt_purp').addEventListener('change', function (e) {
    var purp = e.target.value;
    $.confirm({
      title: 'Add this Purpose ??',
      content: e.target.value,
      buttons: {
        confirm: function confirm() {
          $.post(SITE_ROOT + 'visitor/addPurpose', {
            'purpose': purp
          }, function (res) {
            if (res) {
              res = JSON.parse(res);
              console.log(res);
              var option = new Option(purp, res.insert_id, true, true);
              $('#purpose').append(option).trigger('change');
            }
          });
        },
        cancel: function cancel() {
          console.log('Cancelled!!');
        }
      }
    });
  });
  renderVideo();
  $('#searchVisit').change(function (e) {
    var val = e.target.value;
    var term = val.toLowerCase();
    var FilteredList = [];
    VisitList.forEach(function (item) {
      if (item.purpose.toLowerCase().search(term) != -1) {
        FilteredList.push(item);
      }
    });
    document.getElementById('previous_visits').innerHTML = '';
    FilteredList.forEach(function (visit) {
      document.getElementById('previous_visits').appendChild(createElement(VisitCard, {
        visit: visit
      }));
    });
    e.target.value = "";
    var tag = document.createElement('div');
    tag.classList = 'closeTag';
    tag.innerHTML = val + "<i class='fa fa-times ml-2'></i>";
    tag.addEventListener('click', function () {
      document.getElementById('previous_visits').innerHTML = '';
      VisitList.forEach(function (visit) {
        document.getElementById('previous_visits').appendChild(createElement(VisitCard, {
          visit: visit
        }));
      });
      tag.remove();
    });
    document.querySelector('.searchWrapper').append(tag);
  });
});

function getPreviousVisits(mobile) {
  var promise = new Promise(function (resolve) {
    $.post(SITE_ROOT + 'visitor/getPreviousVisits', {
      'v_mobile': mobile
    }, function (res) {
      res = JSON.parse(res);
      VisitList = res;
      res.forEach(function (visit) {
        document.getElementById('previous_visits').appendChild(createElement(VisitCard, {
          visit: visit
        }));
      });
      resolve(true);
    });
  });
  promise.then(function (success) {
    if (success) {
      // setTimeout(()=>{
      document.querySelectorAll('.copy_btn').forEach(function (Element) {
        Element.addEventListener('click', function (e) {
          e.preventDefault();
          var visit = JSON.parse(e.target.getAttribute('data'));
          $('#name').val(visit.name);
          $('#no_of_people').val(visit.no_of_people);
          $('#date_from').val(visit.dov_from.substr(0, 10));
          $('#time_from').val(visit.dov_from.substr(11));
          $('#date_to').val(visit.dov_to.substr(0, 10));
          $('#time_to').val(visit.dov_to.substr(11));
        });
      }); // },1500);
    }
  });
}

var VisitCard = function VisitCard(props) {
  var colorClass = '';

  if (props.visit.to_meet_conf == MEET_REJECTED) {
    colorClass = 'm-reject';
  } else if (props.visit.to_meet_conf == MEET_CONFIRMED) {
    colorClass = 'm-confirm';
  } else if (props.visit.to_meet_conf == MEET_SCHEDULED) {
    colorClass = 'm-reschedule';
  }

  return createElement("div", {
    "class": "card mt-3 br-2 details_card ".concat(colorClass)
  }, createElement("div", {
    "class": "card-body"
  }, createElement("div", {
    "class": "d-flex justify-content-between"
  }, createElement("div", null, createElement("h5", null, props.visit.name), createElement("span", {
    "class": "id"
  }, "Visit ID : ", props.visit.visit_id)), createElement("div", {
    "class": "copy_div"
  }, createElement("a", {
    href: "#",
    "class": "copy_btn",
    data: JSON.stringify(props.visit)
  }, createElement("i", {
    "class": "fa fa-copy mr-2"
  }), "Copy Data"))), createElement("div", {
    "class": "details"
  }, createElement("span", {
    "class": "detail"
  }, "To Meet : ", props.visit.to_meet), createElement("span", {
    "class": "id"
  }, props.visit.dov_from, " - ", props.visit.dov_to), createElement("span", {
    "class": "detail mt-2"
  }, createElement("b", null, "Purpose : "), props.visit.purpose), createElement("i", null, props.visit.to_meet_conf == MEET_REJECTED ? createElement("b", null, "Reason - ", props.visit.denial_reason) : ''), props.visit.to_meet_conf == MEET_SCHEDULED ? createElement("b", null, "Rescheduled At - ", props.visit.proposed_time) : '')));
};

var imgCapture;

var renderVideo = function renderVideo() {
  var constraints = {
    audio: false,
    video: {
      width: 1280,
      height: 720
    }
  };
  navigator.mediaDevices.getUserMedia(constraints).then(function (mediaStream) {
    var video = document.querySelector('.camera_input');
    video.srcObject = mediaStream;

    video.onloadedmetadata = function (e) {
      video.play();
    };
  })["catch"](function (err) {
    console.log(err.name + ": " + err.message);
  }); // always check for errors at the end.
};

$('#capture_btn').click(function (e) {
  e.preventDefault();
  takepicture();
});

function takepicture() {
  var canvas = document.getElementById('canvas');
  var video = document.querySelector('.camera_input');
  var photo = document.getElementById('photo');
  var context = canvas.getContext('2d'); // let width = video.videoWidth;
  // let height = video.videoHeight;

  var width = 350;
  var height = width * video.videoHeight / video.videoWidth;
  canvas.width = width;
  canvas.height = height;
  context.drawImage(video, 0, 0, width, height);
  var data = canvas.toDataURL('image/png');
  photo.setAttribute('src', data);
  $('#usephoto').show();
}
