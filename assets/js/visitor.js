import {SITE_ROOT} from './init.js';

$('#visitor_login_form').submit(function(e){
  e.preventDefault();

  window.location.href= SITE_ROOT+'visitor/details_form';
});