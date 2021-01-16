<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//API
//read
$route['api/searchEmployee'] = 'api/searchEmployee';
$route['api/getEmpReportsDateRange'] = 'api/getEmpReportsDateRange';
$route['api/getEmpReports'] = 'api/getEmpReports';
$route['api/getEmpAttendance'] = 'api/getEmpAttendance';
$route['api/getEmployees'] = 'api/getEmployees';
$route['api/getLocations'] = 'api/getLocations';
//write
$route['api/finishVisit'] = 'api/finishVisit';
$route['api/rescheduleVisit'] = 'api/rescheduleVisit';
$route['api/rejectVisit'] = 'api/rejectVisit';
$route['api/approveVisit'] = 'api/approveVisit';
$route['api/makePDF/(:any)'] = 'api/makePDF/$1';
$route['api/postVisitorAttendance'] = 'api/postVisitorAttendance';
$route['api/postEmployeeAttendance'] = 'api/postEmployeeAttendance';
$route['api/addHoliday'] = 'api/addHoliday';
$route['api/addDepartment'] = 'api/addDepartment';
$route['api/addContractor'] = 'api/addContractor';
$route['api/addCompany'] = 'api/addCompany';
$route['api/addShift'] = 'api/addShift';

//Visitor
$route['visitor/addPurpose'] = 'api/addPurpose';
$route['visitor/getPreviousVisits'] = 'api/getPreviousVisits';
$route['visitor/sendDetails'] = 'api/sendVisitorDetails';
$route['visitor/(:any)'] = 'Pages/visitor/$1';

//Reports
$route['reports/dashboard'] = 'Pages/dashboard';
$route['reports/(:any)'] = 'Pages/reports/$1';

//Masters
$route['masters/delete/employee/(:any)'] = 'Master/deleteEmployee/$1';
$route['masters/update/employee/(:any)'] = 'Master/updateEmployee/$1';
$route['masters/edit/employee/(:any)'] = 'Master/editEmployee/$1';
$route['masters/delete/company/(:any)'] = 'Master/deleteCompany/$1';
$route['masters/update/company/(:any)'] = 'Master/updateCompany/$1';
$route['masters/edit/company/(:any)'] = 'Master/editCompany/$1';
$route['masters/delete/location/(:any)'] = 'Master/deleteLocation/$1';
$route['masters/update/location/(:any)'] = 'Master/updateLocation/$1';
$route['masters/edit/location/(:any)'] = 'Master/editLocation/$1';
$route['masters/delete/shift/(:any)'] = 'Master/deleteShift/$1';
$route['masters/update/shift/(:any)'] = 'Master/updateShift/$1';
$route['masters/edit/shift/(:any)'] = 'Master/editShift/$1';
$route['masters/delete/contractor/(:any)'] = 'Master/deleteContractor/$1';
$route['masters/update/contractor/(:any)'] = 'Master/updateContractor/$1';
$route['masters/edit/contractor/(:any)'] = 'Master/editContractor/$1';
$route['masters/delete/department/(:any)'] = 'Master/deleteDepartment/$1';
$route['masters/update/department/(:any)'] = 'Master/updateDepartment/$1';
$route['masters/edit/department/(:any)'] = 'Master/editDepartment/$1';
$route['masters/delete/holiday/(:any)'] = 'Master/deleteHoliday/$1';
$route['masters/update/holiday/(:any)'] = 'Master/updateHoliday/$1';
$route['masters/edit/holiday/(:any)'] = 'Master/editHoliday/$1';
$route['masters/(:any)'] = 'Pages/masters/$1';

//Admin
$route['admin/employee/$1'] = 'Admin/employee/$1';
$route['admin/(:any)'] = 'Admin/view/$1';

//Users
$route['user/logout'] = 'User/logout';
$route['user/firstLogin'] = 'User/firstLogin';
$route['user/login'] = 'User/login';

//Any
$route['f_login'] = 'Pages/first_login';
$route['login'] = 'Pages/login';
$route['(:any)'] = 'Pages/view/$1';

$route['default_controller'] = 'Pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
