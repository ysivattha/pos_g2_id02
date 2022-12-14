<?php

use App\Http\Controllers\AbsentController;
use App\Http\Controllers\AbsentTypeController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AttachFileController;
use App\Http\Controllers\CategController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmpStatusController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PayTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResultTypeController;
use App\Http\Controllers\SexController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrainingCourseController;
use App\Http\Controllers\TypeAttachController;
use App\Http\Controllers\TypeExpense;
use App\Http\Controllers\TypeIncome;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', 'Auth\LoginController@login')->name('login');
Route::post('user-login', 'Auth\LoginController@customLogin')->name('login.custom');

Route::group(['middleware' => 'auth'], function () {
  Route::get('/', 'HomeController@index');
  Route::get('/print/letter-head', 'HomeController@print');
  // user
  Route::get('user', 'UserController@index')->name('user.index');
  Route::post('user/save', 'UserController@save')->name('user.store');
  Route::get('user/profile', 'UserController@profile')->name('user.profile');

  Route::post('user/profile/update', 'UserController@save_profile')->name('save.profile');
  Route::post('user/update', 'UserController@update')->name('user.update');
  Route::get('user/logout', 'UserController@logout')->name('user.logout');
  // role
  Route::get('role', 'RoleController@index')->name('role.index');
  Route::get('role/delete/{id}', 'RoleController@delete')->name('role.delete');
  Route::get('role/permission/{id}', 'PermissionController@index')->name('role.permission');
  Route::post('rolepermission/save', "PermissionController@save");
  Route::get('role/export', 'RoleController@export');

  // stock 
  Route::get('item', 'ItemController@index')->name('item.index');

  // company
  Route::get('company', 'CompanyController@index');
  Route::get('company/edit/{id}', 'CompanyController@edit');
  Route::post('company/save', 'CompanyController@save');


  // protocol
  Route::get('protocol', 'ProtocolController@index')->name('protocol.index');
  Route::get('protocol-category', 'ProtocolCategoryController@index')->name('protocol_category.index');
  Route::get('get/protocol/{id}', 'TechnicalController@get_protocol');
  // protocol
  Route::get('fil', 'FilController@index')->name('fil.index');
  // medicine library
  Route::get('medicine-library', 'MedicineLibraryController@index')->name('medicine_library.index');
  // department



  // Route::get('hr-department', 'DepartmentController@index')->name('hr-department.index');
  // Route::get('department/detail/{id}', 'DepartmentController@detail')->name('department.detail');
  // Route::get('section/delete/{id}', 'DepartmentController@delete')->name('section.delete');


  //diagnosis-template
  Route::get('diagnosis-template', 'DiagnosisTemplateController@index')->name('diagnosis_template.index');
  Route::get('diagnosis-template/create', 'DiagnosisTemplateController@create')->name('diagnosis_template.create');
  Route::post('diagnosis-template/save', 'DiagnosisTemplateController@save');
  Route::get('diagnosis-template/edit/{id}', 'DiagnosisTemplateController@edit')->name('diagnosis_template.edit');
  Route::post('diagnosis-template/update/', 'DiagnosisTemplateController@update');
  Route::get('diagnosis-template/detail/{id}', 'DiagnosisTemplateController@detail')->name('diagnosis_template.detail');
  Route::get('diagnosis-template/delete', 'DiagnosisTemplateController@delete')->name('diagnosis_template.delete');

  //template
  Route::get('template', 'TemplateController@index')->name('template.index');
  Route::get('template/create', 'TemplateController@create')->name('template.create');
  Route::post('template/save', 'TemplateController@save');
  Route::get('template/edit/{id}', 'TemplateController@edit')->name('template.edit');
  Route::post('template/update/', 'TemplateController@update');
  Route::get('template/detail/{id}', 'TemplateController@detail')->name('template.detail');
  Route::get('template/delete', 'TemplateController@delete')->name('template.delete');
  // invoice
  Route::get('invoice', 'InvoiceController@index')->name('invoice.index');
  Route::get('invoice/get-request/{id}', 'InvoiceController@get_request');
  Route::get('invoice/delete/{id}', 'InvoiceController@delete');
  Route::get('invoice/detail/{id}', 'InvoiceController@detail')->name('invoice.detail');
  Route::resource('invoice', 'InvoiceController')->except(['show', 'destroy']);
  Route::post('payment/save', 'InvoiceController@save_payment');
  Route::post('invoice/medicine/save', 'InvoiceController@save_medicine');
  Route::post('invoice/request/save', 'InvoiceController@request_save');
  Route::post('invoice/request-update/', 'InvoiceController@invoice_update');
  Route::get('payment/delete/{id}', 'InvoiceController@delete_payment');
  Route::get('invoice/print/{id}', 'InvoiceController@print');
  Route::get('invoice/delete-request/{id}', 'InvoiceController@delete_request');
  Route::get('invoice/delete-medicine/{id}', 'InvoiceController@delete_medicine');
  Route::get('invoice/get-medicine/{id}', 'InvoiceController@get_medicine');
  // sections
  Route::resource('section', 'SectionController')->except(['show', 'destroy']);
  Route::get('section/get-section/{id}', 'SectionController@get_section');
  //diseases
  Route::get('disease', 'DiseaseController@index')->name('disease.index');


  //front officef
  Route::get('front-office', 'FrontOfficeController@index')->name('front_office.index');
  Route::get('front-office/detail/{id}', 'FrontOfficeController@detail');
  Route::get('front-office/request-delete/{id}', 'FrontOfficeController@request_delete');
  Route::get('front-office/edit/{id}', 'FrontOfficeController@edit');
  Route::post('front-office/update/', 'FrontOfficeController@update')->name('front_office.update');
  Route::get('front-office/send-technical/{id}', 'FrontOfficeController@send_technical');
  Route::get('front-office/send-doctor/{id}', 'FrontOfficeController@send_doctor');
  Route::get('front-office/confirm/{id}', 'FrontOfficeController@confirm')->name('front_office.confirm');
  Route::get('front-office/arrived/{id}', 'FrontOfficeController@arrived')->name('front_office.arrived');
  Route::get('front-office/canceled/{id}', 'FrontOfficeController@canceled')->name('front_office.canceled');
  Route::get('front-office/today/', 'FrontOfficeController@today')->name('front_office.today');
  Route::get('front-office/yesterday/', 'FrontOfficeController@yesterday')->name('front_office.yesterday');
  Route::get('front-office/week/', 'FrontOfficeController@week')->name('front_office.week');
  // item
  Route::resource('item', 'ItemController')->except(['show', 'destroy']);
  Route::get('item', 'ItemController@index')->name('item.index');
  Route::get('item/delete/{id}', 'ItemController@delete');
  Route::get('item/get-item/{id}', 'ItemController@get_item');
  // paraclinical
  Route::get('paraclinical', 'ParaclinicalController@index')->name('paraclinical.index');
  Route::get('paraclinical/delete/{id}', 'ParaclinicalController@delete');
  Route::get('paraclinical/result/{id}', 'ParaclinicalController@result')->name('paraclinical.result');
  Route::resource('paraclinical', 'ParaclinicalController')->except(['show', 'destroy']);
  Route::post('paraclinical/update', 'ParaclinicalController@update')->name('paraclinical.update');
  //request
  Route::resource('request', 'RequestcheckController')->except(['show', 'destroy']);
  Route::get('request', 'RequestcheckController@index')->name('request.index');
  Route::post('request/detail/save', 'RequestcheckController@save_detail');
  Route::post('request/update/', 'RequestcheckController@update')->name('request.update');
  Route::get('request/detail/{id}', 'RequestcheckController@detail')->name('request.detail');
  Route::post('request/detail/update', 'RequestcheckController@detail_update');
  Route::get('request/detail/get/{id}', 'RequestcheckController@get_request_detail');
  Route::get('request/delete/{id}', 'RequestcheckController@delete');
  Route::get('request/request-detail/delete/{id}', 'RequestcheckController@delete_detail');
  Route::get('request/today/', 'RequestcheckController@today')->name('request.today');
  Route::get('request/yesterday/', 'RequestcheckController@yesterday')->name('request.yesterday');
  Route::get('request/week/', 'RequestcheckController@week')->name('request.week');
  Route::get('request/send-technical/{id}', 'RequestcheckController@send_technical');
  Route::get('request/send-doctor/{id}', 'RequestcheckController@send_doctor');

  //technical check on request detail
  Route::get('technical', 'TechnicalController@index')->name('technical.index');
  Route::get('technical/confirm/{id}', 'TechnicalController@confirm')->name('technical.confirm');
  Route::get('technical/canceled/{id}', 'TechnicalController@canceled')->name('technical.canceled');
  Route::get('technical/today/', 'TechnicalController@today')->name('technical.today');
  Route::get('technical/yesterday/', 'TechnicalController@yesterday')->name('technical.yesterday');
  Route::get('technical/week/', 'TechnicalController@week')->name('technical.week');
  Route::get('technical/done/{id}', 'TechnicalController@done')->name('technical.done');
  Route::get('technical/confirm-finished/{id}', 'TechnicalController@confirm_finished')->name('technical.confirm_finished');
  Route::post('technical/save/{id}', 'TechnicalController@save');
  Route::get('technical/delete/{id}', 'TechnicalController@delete');
  Route::get('technical/request-delete/{id}', 'TechnicalController@delete_request');
  Route::get('technical/detail/{id}', 'TechnicalController@detail')->name('technical.detail');
  Route::get('technical/print/{id}', 'TechnicalController@print');

  // doctor check 
  Route::get('doctor-check/', 'DoctorCheckController@index')->name('doctor_check.index');
  Route::post('doctor-check/save/{id}', 'DoctorCheckController@save');
  Route::get('doctor-check/create/{id}', 'DoctorCheckController@create');
  Route::get('doctor-check/print/{id}', 'DoctorCheckController@print');
  Route::get('doctor-check/get-template/{id}', 'DoctorCheckController@get_template');
  Route::get('doctor-check/update-status/{id}', 'DoctorCheckController@update_status');
  Route::get('doctor-check/detail/edit/{id}', 'DoctorCheckController@edit_detail')->name('doctor_check.edit');
  Route::get('doctor-check/detail/{id}', 'DoctorCheckController@detail')->name('doctor_check.detail');
  Route::get('doctor-check/reviewing/{id}', 'DoctorCheckController@reviewing')->name('doctor_check.reviewing');
  Route::get('doctor-check/validated/{id}', 'DoctorCheckController@validated')->name('doctor_check.validated');
  Route::get('doctor-check/today/', 'DoctorCheckController@today')->name('doctor_check.today');
  Route::get('doctor-check/yesterday/', 'DoctorCheckController@yesterday')->name('doctor_check.yesterday');
  Route::get('doctor-check/week/', 'DoctorCheckController@week')->name('doctor_check.week');
  // expense
  // Route::get('expense', 'ExpenseController@index')->name('expense.index');

  //exchange rate
  Route::resource('exchange', 'ExchangeController')->except(['destory', 'show']);

  // appointment
  Route::get('appointment', 'AppointmentController@index')->name('appointment.index');
  Route::get('appointment/schedule', 'AppointmentController@schedule');

  // hosiptal
  Route::get('hospital', 'HospitalController@index')->name('hospital.index');
  Route::post('hospital/save', 'HospitalController@save')->name('hospital.store');
  Route::post('hospital/update', 'HospitalController@update')->name('hospital.update');
  // patient
  Route::resource('patient', 'PatientController')->except(['show', 'destroy']);

  Route::get('patient/detail/{id}', 'PatientController@detail')->name('patient.detail');
  Route::get('patient/summary/{id}', 'PatientController@summary')->name('patient.summary');
  Route::get('patient/appointment/delete/{id}', 'PatientController@delete_appointment');
  Route::get('patient/treatment/delete/{id}', 'PatientController@delete_treatment');
  Route::get('patient/invoice/delete/{id}', 'PatientController@delete_invoice');
  Route::get('patient/request/delete/{id}', 'PatientController@delete_request');
  Route::get('patient/get-request/{id}', 'PatientController@get_request');
  Route::get('patient/invoice-unpaid/{id}', 'PatientController@get_invoice_unpaid');
  Route::get('patient/result/print/{id}', 'PatientController@result_print');
  Route::post('patient/paraclinical/save', 'PatientController@paraclinical_save')->name('paraclinical.save');
  Route::get('customer/get-disease/{id}', 'PatientController@get_disease');
  Route::get('patient/get-para/{id}', 'PatientController@get_para');
  Route::post('disease/update', 'PatientController@update_disease')->name('disease.update');
  Route::post('patient/para/update', 'PatientController@update_para')->name('para.update');
  Route::get('customer/get-pregnancy/{id}', 'PatientController@get_pregnancy');
  Route::post('pregnancy/update', 'PatientController@update_pregnancy')->name('pregnancy.update');
  Route::get('patient/paraclinical/delete/{id}', 'PatientController@delete_paraclinical');
  Route::post('patient/appointment/save', 'PatientController@save_appointment');
  Route::get('patient/delete/{id}', 'PatientController@delete')->name('patient.delete');
  Route::get('patient/search/', 'PatientController@search')->name('patient.search');
  Route::post('pregnancy/save', 'PatientController@save_pregnancy')->name('pregnancy.save');
  Route::get('pregnancy/delete/{id}', 'PatientController@delete_pregnancy')->name('pregnancy.delete');
  Route::post('disease/save', 'PatientController@save_disease')->name('disease.save');
  Route::get('disease/delete/{id}', 'PatientController@delete_disease')->name('disease.delete');
  Route::get('pdisease/delete/{id}', 'PatientController@delete_pdisease')->name('pdisease.delete');
  // patient
  Route::resource('treatment', 'TreatmentController')->except(['show', 'destroy']);
  Route::get('treatment/get-template/{id}', 'TreatmentController@get_template');
  Route::get('treatment/search', 'TreatmentController@search');
  Route::post('treatment/update', 'TreatmentController@update');
  Route::post('treatment/medicine/save', 'TreatmentController@save_medicine');
  Route::post('treatment/medicine/update', 'TreatmentController@update_medicine');
  Route::get('treatment/detail/{id}', 'TreatmentController@detail')->name('treatment.detail');
  Route::get('treatment/delete/{id}', 'TreatmentController@delete')->name('treatment.delete');
  Route::get('treatment/print/{id}', 'TreatmentController@print');
  Route::get('treatment/print-no-letterhead/{id}', 'TreatmentController@print2');
  Route::get('treatment/print/{id}', 'TreatmentController@print3');
  Route::get('treatment/get-request/{id}', 'TreatmentController@get_request');
  Route::get('treatment/get-medicine-library/{id}', 'TreatmentController@get_medicine_library');
  Route::get('treatment/eget-medicine-library/{id}', 'TreatmentController@eget_medicine_library');
  Route::get('treatment-detail/delete/{id}', 'TreatmentController@delete_td');

  // bulk operation 
  Route::get('bulk/delete/{id}', 'BulkController@delete');
  Route::get('bulk/get/{id}', 'BulkController@get');
  Route::post('bulk/save', 'BulkController@save');
  Route::post('bulk/update', 'BulkController@update');
  Route::post('bulk/remove', 'BulkController@remove');
  // change language
  Route::get('lang/{id}', 'UserController@change_lang');
  Route::fallback('NotFoundController@index');

  // report income and expense
  Route::get('report/income', 'ReportController@income')->name('income.index');
  Route::get('report/income/print', 'ReportController@income_print');
  Route::get('report/due', 'ReportController@due')->name('due.index');
  Route::get('report/due/print', 'ReportController@due_print');
  Route::get('report/expense', 'ReportController@expense');
  Route::get('report/expense/search', 'ReportController@search_expense');
  Route::get('report/expense/print', 'ReportController@print_expense');
  Route::get('report/profit', 'ReportController@profit')->name('profit.index');
  Route::get('report/commission', 'ReportController@commission');
  Route::get('report/commission/search', 'ReportController@search_commission');
  Route::get('report/commission/print', 'ReportController@print_commission');

  // stock in
  Route::get('stockin', 'StockInController@index')->name('stockin.index');

  // stock out
  Route::get('stockout', 'StockOutController@index')->name('stockout.index');
  //unit
  Route::get('unit', 'UnitController@index')->name('unit.index');
  Route::post('unit', 'UnitController@store')->name('unit.store');
  Route::get('/unit/delete/{id}', [CategController::class, 'delete'])->name('unit.delete');
  //stock adjust
  Route::get('adjust', 'AdjustController@index')->name('adjust.index');
  Route::post('adjust', 'AdjustController@store')->name('adjust.store');
  //stock balance
  Route::get('stock_balance', 'StockBalanceController@index')->name('stock_balance.index');
  Route::POST('stock_balance', 'StockBalanceController@store')->name('stock_balance.store');
  // type customer
  Route::get('type-customer', 'TypeCustomerController@index')->name('type.index');
  Route::POST('type-customer', 'TypeCustomerController@store')->name('type.store');
  //customer
  Route::get('customer', 'CustomerController@index')->name('customer.index');
  Route::POST('customer', 'CustomerController@store')->name('cus.store');
  //category
  Route::get('category', [CategoryController::class, 'index'])->name('category.index');
  //supplier_ type
  Route::get('supplier-type', 'SupplierTypeController@index')->name('supplier-type.index');
  Route::POST('supplier-type', 'SupplierTypeController@store')->name('sup-type.store');
  //supplier
  Route::get('supplier', 'SupplierController@index')->name('supplier.index');
  Route::POST('supplier', 'SupplierController@store')->name('supplier.store');

  Route::post('stockin', 'StockInController@store')->name('stockin.store');
  Route::post('stockout', 'StockOutController@store')->name('stockout.store');

  Route::get('/product', [ProductController::class, 'index'])->name('product.index');
  Route::post('/product', [ProductController::class, 'store'])->name('product.store');
  Route::get('/cat', [CategController::class, 'index'])->name('cat.index');
  Route::post('/cat', [CategController::class, 'store'])->name('cat.store');
  Route::get('/cat/delete/{id}', [CategController::class, 'delete'])->name('cat.delete');

  //income
  Route::GET('/income', [IncomeController::class, 'index'])->name('income.index');
  Route::POST('/income', [IncomeController::class, 'store'])->name('income.store');
  Route::GET('/expense', [ExpensesController::class, 'index'])->name('expense.index');
  Route::POST('/expense', [ExpensesController::class, 'store'])->name('expense.store');
  Route::GET('/expense-type', [TypeExpense::class, 'index'])->name('exp_type.index');
  Route::POST('/expense-type', [TypeExpense::class, 'store'])->name('exp_type.store');
  Route::GET('/income-type', [TypeIncome::class, 'index'])->name('income_type.index');
  Route::POST('/income-type', [TypeIncome::class, 'store'])->name('income_type.store');

  Route::GET('/asset', [AssetController::class, 'index'])->name('asset.index');
  Route::POST('/asset', [AssetController::class, 'store'])->name('asset.store');

  // position
  Route::GET('/position', 'PositionController@index')->name('position.index');
  Route::POST('/position', 'PositionController@store')->name('position.store');

  // employee
  Route::GET('/employee', 'EmployeeController@index')->name('emp.index');
  Route::POST('/employee', 'EmployeeController@store')->name('emp.store');
  //
  Route::GET('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
  Route::POST('/payroll', [PayrollController::class, 'store'])->name('payroll.store');
  //sex
  Route::GET('/sex', [SexController::class, 'index'])->name('sex.index');
  Route::POST('/sex', [SexController::class, 'store'])->name('sex.store');
  //department
  Route::GET('/department', 'DepartmentController@index')->name('department.index');
  Route::POST('/department', 'DepartmentController@store')->name('department.store');
  //absent type
  Route::GET('/absent-type', [AbsentTypeController::class, 'index'])->name('absent-type.index');
  Route::POST('/absent-type', [AbsentTypeController::class, 'store'])->name('absent-type.store');
  //absent type
  Route::GET('/absent', [AbsentController::class, 'index'])->name('absent.index');
  Route::POST('/absent', [AbsentController::class, 'store'])->name('absent.store');

  //result type
  Route::GET('/result-type', [ResultTypeController::class, 'index'])->name('result_type.index');
  Route::POST('/result-type', [ResultTypeController::class, 'store'])->name('result_type.store');
  //pay type
  Route::GET('/pay-type', [PayTypeController::class, 'index'])->name('pay_type.index');
  Route::POST('/pay-type', [PayTypeController::class, 'store'])->name('pay_type.store');

  //status type
  Route::GET('/emp-status', [EmpStatusController::class, 'index'])->name('emp_status.index');
  Route::POST('/emp-status', [EmpStatusController::class, 'store'])->name('emp_status.store');

  //taininging course
  Route::GET('/training-course', [TrainingCourseController::class, 'index'])->name('training_course.index');
  Route::POST('/training-course', [TrainingCourseController::class, 'store'])->name('training_course.store');

  //taininging course
  Route::GET('/training', [TrainingController::class, 'index'])->name('training.index');
  Route::POST('/training', [TrainingController::class, 'store'])->name('training.store');

  
  //attach type
  Route::GET('/type-attach', [TypeAttachController::class, 'index'])->name('attach_type.index');
  Route::POST('/type-attach', [TypeAttachController::class, 'store'])->name('attach_type.store');
    
  //attach file
  Route::GET('/attach-file', [AttachFileController::class, 'index'])->name('attach_file.index');
  Route::POST('/attach-file', [AttachFileController::class, 'store'])->name('attach_file.store');
});

 
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
