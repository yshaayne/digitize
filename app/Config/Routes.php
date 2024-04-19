<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Create a new instance of our RouteCollection class.

$routes->get('/', 'DashboardCon::index');

//logged in user routes
$routes->group('',['filter'=> 'AutoCheck'],function($routes){
    $routes->get('logout','LoginCon::logout');
    #########################################################################################################
    # Document ## Document ## Document ## Document ## Document ## Document ## Document ## Document #
    #########################################################################################################
    $routes->post('document-setup', 'DocumentCon::index');
    $routes->get('document-load', 'DocumentCon::load');
    $routes->post('document-load2', 'DocumentCon::load2');
    $routes->post('document-add', 'DocumentCon::insert');
    $routes->post('document-details', 'DocumentCon::view');
    $routes->post('document-edit', 'DocumentCon::edit');
    $routes->post('document-update', 'DocumentCon::update');
    $routes->post('document-delete', 'DocumentCon::delete');
    #########################################################################################################
    # Document ## Document ## Document ## Document ## Document ## Document ## Document ## Document #
    #########################################################################################################
    $routes->get('folder-setup', 'FolderCon::index');
    $routes->get('folder-load', 'FolderCon::load');
    $routes->get('folder-load2', 'FolderCon::load2');
    $routes->post('folder-add', 'FolderCon::insert');
    $routes->post('folder-details', 'FolderCon::view');
    $routes->post('folder-edit', 'FolderCon::edit');
    $routes->post('folder-update', 'FolderCon::update');
    $routes->post('folder-delete', 'FolderCon::delete');
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    $routes->get('home', 'DashboardCon::index2');
    $routes->get('my-profile', 'Dashboard::profile');
    $routes->get('change-password', 'Dashboard::changepass');
    #########################################################################################################
    #DEPARTMENT SETUP  DEPARTMENT SETUP DEPARTMENT SETUP DEPARTMENT SETUP DEPARTMENT SETUP DEPARTMENT SETUP 
    #########################################################################################################
    $routes->get('department-setup', 'DepartmentCon::index');
    $routes->get('department-load', 'DepartmentCon::load');
    $routes->get('department-load2', 'DepartmentCon::load2');
    $routes->post('department-add', 'DepartmentCon::insert');
    $routes->post('department-details', 'DepartmentCon::view');
    $routes->post('department-edit', 'DepartmentCon::edit');
    $routes->post('department-update', 'DepartmentCon::update');
    $routes->post('department-delete', 'DepartmentCon::delete');
    #########################################################################################################
    #JOB REQUEST #JOB REQUEST #JOB REQUEST #JOB REQUEST #JOB REQUEST #JOB REQUEST #JOB REQUEST #JOB REQUEST 
    #########################################################################################################
    $routes->get('job', 'JobCon::index');
    $routes->post('job-employee', 'JobCon::job_employee');
    $routes->post('job-approval', 'JobCon::job_approval');
    $routes->post('job-approval2', 'JobCon::job_approval2');
    $routes->post('job-add', 'JobCon::insert');
    $routes->post('job-request', 'JobCon::job_request');
    $routes->get('job-records', 'JobCon::job_records');
    $routes->get('job-sent', 'JobCon::job_sent');
    $routes->get('job-load2', 'JobCon::load2');
    $routes->get('job-load3', 'JobCon::load3');
    $routes->post('chat-add', 'JobCon::chat_post_add');
    $routes->post('chat-fetch', 'JobCon::chat_fetch');
    $routes->post('chat-remove-attachment', 'JobCon::remove_attachment');
    $routes->post('job-update', 'JobCon::update');
    $routes->post('job-user-approve', 'JobCon::user_approve');
    $routes->post('job-user-disapprove', 'JobCon::user_disapprove');
    $routes->post('job-sup-approve', 'JobCon::sup_approve');
    $routes->post('job-sup-disapprove', 'JobCon::sup_disapprove');
    $routes->post('job-eo-approve', 'JobCon::eo_approve');
    $routes->post('job-eo-disapprove', 'JobCon::eo_disapprove');
    $routes->post('job-print', 'JobCon::print');
    $routes->post('job-accept', 'JobCon::accept');
    #########################################################################################################
    #ASSETS#ASSETS#ASSETS#ASSETS#ASSETS#ASSETS#ASSETS#ASSETS#ASSETS#ASSETS#ASSETS#ASSETS#ASSETS#ASSETS
    #########################################################################################################
    $routes->get('asset-setup', 'AssetCon::index');
    $routes->get('asset-load', 'AssetCon::load');
    $routes->get('asset-load2', 'AssetCon::load2');
    $routes->post('asset-add', 'AssetCon::insert');
    $routes->post('asset-details', 'AssetCon::view');
    $routes->post('asset-edit', 'AssetCon::edit');
    $routes->post('asset-update', 'AssetCon::update');
    $routes->post('asset-delete', 'AssetCon::delete');
    $routes->post('asset-history', 'AssetCon::history');
    $routes->post('asset-get-asset', 'AssetCon::get_asset');
    $routes->post('asset-peripherals', 'AssetCon::peripherals');
    
    #########################################################################################################
    #SUPPLIER#SUPPLIER#SUPPLIER#SUPPLIER#SUPPLIER#SUPPLIER#SUPPLIER#SUPPLIER#SUPPLIER#SUPPLIER#SUPPLIER
    #########################################################################################################
    $routes->get('category-setup', 'CategoryCon::index');
    $routes->get('category-load', 'CategoryCon::load');
    $routes->get('category-load2', 'CategoryCon::load2');
    $routes->post('category-add', 'CategoryCon::insert');
    $routes->post('category-details', 'CategoryCon::view');
    $routes->post('category-edit', 'CategoryCon::edit');
    $routes->post('category-update', 'CategoryCon::update');
    $routes->post('category-delete', 'CategoryCon::delete');


    #########################################################################################################
    #VIEW LOGS VIEW LOGS VIEW LOGS VIEW LOGS VIEW LOGS VIEW LOGS VIEW LOGS VIEW LOGS VIEW LOGS VIEW LOGS 
    #########################################################################################################
    
    $routes->get('logs-open', 'ManageAccountCon::index_logs');
    $routes->get('logs-load', 'ManageAccountCon::load_logs');

    #NOTIFIACATION
    $routes->post('Notification-fetch', 'NotificationCon::fetch');
    $routes->post('Notification-seen', 'NotificationCon::update_seen');
    $routes->post('Notification-mark', 'NotificationCon::mark_all_as_read');
  
    #########################################################################################################
    #REPORTS REPORTS REPORTS REPORTS REPORTS REPORTS REPORTS REPORTS REPORTS REPORTS REPORTS REPORTS REPORTS 
    #########################################################################################################
    $routes->get('report-menu', 'Report::index');
    $routes->post('report-process', 'Report::process');
    $routes->post('report-generate', 'Report::dompdfprint');
    $routes->post('excel-checklist', 'ExcelCon::profileCheckList1');
    $routes->post('excel-checklist2', 'ExcelCon::profileCheckList2');
    $routes->get('excel-leave-credits/(:num)', 'ExcelCon::leaveCreditsProfile/$1');//LEAVE CREDITS REPORT
    $routes->get('excel-service-credits/(:num)', 'ExcelCon::serviceCreditsProfile/$1');//SERVICE CREDITS REPORT
    $routes->get('excel-coc/(:num)', 'ExcelCon::cocProfile/$1');//SERVICE CREDITS REPORT
    $routes->post('excel-payroll-checklist', 'ExcelCon::excel_payroll_checklist2');//PAYROLL REPORT
    #############################################################################################################
    #DASHBOARD DETAILS DASHBOARD DETAILS DASHBOARD DETAILS DASHBOARD DETAILS DASHBOARD DETAILS DASHBOARD DETAILS 
    #############################################################################################################
    $routes->post('dashboard-details', 'Dashboard::tiles');
    $routes->post('email-notification-enabling', 'Dashboard::email_notification_enabling');
    $routes->get('/dashboard','Dashboard::index');
    $routes->get('/collegeCon', 'CollegeCon::index');
    $routes->get('/', 'Dashboard::index');
    //$routes->get('/Mysqlquery','Mysqlquery::index');
    //$routes->get('credit-add-auto', 'LeaveCreditsCon::insertCredits_auto');//AUTO CREDIT EARNED
    //$routes->post('credit-add-auto', 'LeaveCreditsCon::insertCredits_auto');
    
    //$routes->get('locator-personal-setup', 'EventsCon::locator_personal_setup');
    $routes->get('teachers-leave-setup', 'LeaveApplicationCon::teachers_leave_setup');
    $routes->post('insert-teacher-leave', 'LeaveApplicationCon::insert_teacher_leave');

    $routes->get('smtp-setup', 'LeaveApplicationCon::smtp_setup');
    $routes->post('smtp-save', 'LeaveApplicationCon::smtp_save');
    $routes->post('smtp-send', 'LeaveApplicationCon::smtp_send');

});

$routes->group('',['filter'=> 'AlreadyLoggedIn'],function($routes){
    $routes->get('login','LoginCon::index');
    $routes->post('logincheck','LoginCon::loginAccount');
   
});
