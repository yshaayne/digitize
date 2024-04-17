<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\User;
use App\Models\EmploymentDetailsMod;
// use App\Models\SystemLogsMod;

class LoginCon extends BaseController
{
    //FORM
    public function __construct(){
        helper(['url','form']);
    }
    public function index(): string
    {
        $data['pageTitle']='Login';
        return view('login/loginpage',$data);
    }
    //LOGIN
    public function loginAccount(){
        //$SystemLogsMod = new SystemLogsMod();
        //$ipaddress = $_SERVER['REMOTE_ADDR'];
        $validated = $this->validate([
            'user'=>[
                'rules'=>'required',
                'errors'=>[
                    'valid_email'=>'Your user is not valid'
                ]
            ],
            'pass'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Your password is required',
                ]
            ]
        ]); 
        if(!$validated){
            return view('login/loginpage',['validation' => $this->validator]);
        }
        else{
            //checking user details in database
            $user=$this->request->getPost('user');//from form
            $pass=$this->request->getPost('pass');//from form
            $userModel = new User();
            $employeeModel = new EmploymentDetailsMod();
            $userInfo= $userModel->where('user',$user)->first();
            if(! empty($userInfo)){
                $dbUpass=$userInfo['pass'];
                $checkPassword = Hash::checkEncypt($pass,$dbUpass);
                if(!$checkPassword ){
                    // $Data_system_logs=[
                    //     'emp_id'=>$userInfo['emp_id'],
                    //     'logs'=>'attemp to login : invalid password '.$ipaddress,
                    //     ];
                    // $SystemLogsMod->save($Data_system_logs);
                    session()->setFlashdata('fail','Incorect Password');
                    return redirect()->to('login');
                }
                else{
                    if($userInfo['status']==1){
                        $employeeInfo= $employeeModel->where('emp_id',$userInfo['emp_id'])->first();
                        $userId=$userInfo['id'];
                        $employeeInfo= $employeeModel->where('emp_id',$userInfo['emp_id'])->first();
                        if($employeeInfo){
                            session()->set('loggedInUser',$userId);
                            session()->set('loggedInEmp_id',$userInfo['emp_id']);
                            session()->set('loggedInAccessLevel',$userInfo['accesslevel']);
                            session()->set('loggedInEmp_Status',$employeeInfo['status']);
                            $Data_system_logs=[
                                'emp_id'=>$userInfo['emp_id'],
                                'logs'=>'login '.$ipaddress,
                            ];
                            $SystemLogsMod->save($Data_system_logs);
                            return redirect()->to('/');
                        }
                        else{
                            session()->setFlashdata('unactivated','Invalid Account');
                            return redirect()->to('login');
                        }
                    }
                    else{
                        session()->setFlashdata('unactivated','Your account is not yet activated');
                        return redirect()->to('login');
                    }
                }
            }
            else{
                // $Data_system_logs=[
                //     'emp_id'=>$user,
                //     'logs'=>'attempt to login : invalid account '.$ipaddress,
                // ];
                // $SystemLogsMod->save($Data_system_logs);
                session()->setFlashdata('noaccount','Invalid User Account');
                return redirect()->to('login');
            }
        }
    }
    public function logout(){
        $session = \Config\Services::session($config);
        //$ipaddress = $_SERVER['REMOTE_ADDR'];
        //$loggedInEmp_id = session()->get('loggedInEmp_id');
        // $SystemLogsMod = new SystemLogsMod();
        // $Data_system_logs=[
        //     'emp_id'=>$loggedInEmp_id,
        //     'logs'=>'logout '.$ipaddress,
        // ];
        // $SystemLogsMod->save($Data_system_logs);
        $session->remove('loggedInUser');
        // if(session()->has('loggedInUser')){
        //     $session->remove('loggedInUser');
        // }
        // if(session()->has('loggedInEmp_id')){
        //     session()->remove('loggedInEmp_id');
        // }
        // session()->setFlashdata('Logout','You are logged out');
        return redirect()->to('login');
    }
}