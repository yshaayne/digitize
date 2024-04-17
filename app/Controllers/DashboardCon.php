<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\User;
use App\Models\EmploymentDetailsMod;
// use App\Models\SystemLogsMod;

class DashboardCon extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }
    public function index(){
        if(session()->has('loggedInUser')){
            $userModel = new User();
            $employeeModel = new EmploymentDetailsMod();
            $loggedIdUser = session()->get('loggedInUser');
            $loggedInEmp_id = session()->get('loggedInEmp_id');
            $row = $userModel->find($loggedIdUser);
            $row2 = $employeeModel->where('emp_id',$loggedInEmp_id)->first();
            $data = [
                'title' => 'dashboard',
                'userInfo' => $row,
                'employeeInfo' => $row2,
            ];
            return view('application/index',$data);
        }
        else{
            return redirect()->to('login')->with('fail','Please login to access the application');
        } 
    }
    
}