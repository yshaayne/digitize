<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\User;
use App\Models\DepartmentMod;
class DepartmentCon extends BaseController
{
    public function index()
    {
        $userModel = new User();
        $loggedIdUser = session()->get('loggedInUser');
        $row = $userModel->find($loggedIdUser);
        $data = [
            'title' => 'Department',
            'userInfo' => $row  
        ];
        if(session()->get('loggedInAccessLevel')==1 || session()->get('loggedInAccessLevel')==2 ){
            return view('dashboard/department', $data);
        }
        else{
            echo 'Access Denied!';
        }
    }
    public function insert()
    {
        $validated = $this->validate([
            'code'=>[
                'rules'=>'is_unique[tblDepartment.code]',
                'errors'=>[
                    'is_unique'=>'Code Already Exist'
                ]
            ],
        ]); 
        if(!$validated){
            $data = [
                'status'=>'error_validated'  
            ];
            return $this->response->setJSON($data);
        }
        else{ 
            $userModel = new User();
            $loggedIdUser = session()->get('loggedInUser');
            $row = $userModel->find($loggedIdUser);
            $date = date('Y-m-d H:i:s');
            $created_by=$row['id']."-".$date = date('Y-m-d H:i:s');;
            $depMod = new DepartmentMod();
            $dataPOST=[
                'code'=>$this->request->getPost('code'),
                'description'=>$this->request->getPost('desc'),
                'depthead'=>$this->request->getPost('depthead'),
                'created_by'=>$created_by,
                'edited_by'=>$created_by
            ];
            $depMod->save($dataPOST);
            $data = [
                'status'=>'Department Inserted Successfully'  
            ];
            return $this->response->setJSON($data);
        }
    }
    //auto Display
    public function load(){
        $depMod = new DepartmentMod();
        $data['department']=$depMod->orderBy('code','ASC')->findAll();
        return $this->response->setJSON($data);
    }
    //auto Display
    public function load2(){
        if($this->request->isAJAX()){
            $depMod = new DepartmentMod();
            $dataDep=[
                'department'=>$depMod->orderBy('code','ASC')->findAll()
            ];
            $msg=[
                'dataDep'=>view('dashboard/departmentList', $dataDep),  
            ];
            echo json_encode($msg); 
        }
        else{
            exit('error');
        }
    }
    //VIEW DETAILS
    public function view(){
        $depMod = new DepartmentMod();
        $dep_id =$this->request->getPost('dep_id');
        // $data = $userModel->where('username', 'myname')->first();
        $data2['department2']=$depMod->find($dep_id);
        return $this->response->setJSON($data2);
    }
    //editDisplay
    public function edit(){
        $depMod = new DepartmentMod();
        $dep_id =$this->request->getPost('dep_id');
        // $data = $userModel->where('username', 'myname')->first();
        $data2['department2']=$depMod->find($dep_id);
        return $this->response->setJSON($data2);
    }
    //UPDATE
    public function update()
    {
        $validated = $this->validate([
            'code'=>[
                'rules'=>'is_unique[tblDepartment.code,tblDepartment.isu,{edit_dep_id}]',
                'errors'=>[
                    'is_unique'=>'Code Already Exist' 
                ]
            ],
        ]); 
        if(!$validated){
            $data = [
                'status'=>'error_validated'  
            ];
            return $this->response->setJSON($data);
        }
        else{   
            $userModel = new User();
            $loggedIdUser = session()->get('loggedInUser');
            $row = $userModel->find($loggedIdUser);
            $date = date('Y-m-d H:i:s');
            $edited_by=$row['id']."-".$date = date('Y-m-d H:i:s');
            $depMod = new DepartmentMod();
            $edit_dep_id=$this->request->getPost('edit_dep_id');
            $dataPOST5=[
                'code'=>$this->request->getPost('code'),
                'description'=>$this->request->getPost('desc'),
                'depthead'=>$this->request->getPost('depthead'),
                'edited_by'=>$edited_by
            ];
            $depMod->update($edit_dep_id,$dataPOST5);
            $data5 = [
                'status'=>'Department Updated Successfully'  
            ];
            return $this->response->setJSON($data5);
        } 
    }
    //DELETEs
    public function delete()
    {
        $depMod = new DepartmentMod();
        $delete_id=$this->request->getPost('delete_id');
        $depMod->delete($delete_id);
        $data6 = [
            'status'=>'Department Deleted Successfully'  
        ];
        return $this->response->setJSON($data6);
    }
}
