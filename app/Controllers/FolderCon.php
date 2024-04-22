<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\User;
use App\Models\FolderMod;
use App\Models\SystemLogsMod;
use App\Models\DepartmentMod;
use App\Models\EmploymentDetailsMod;
class FolderCon extends BaseController
{
    public function index()
    {
        $userModel = new User();
        $loggedIdUser = session()->get('loggedInUser');
        $row = $userModel->find($loggedIdUser);
        $data = [
            'title' => 'Folder',
            'userInfo' => $row  
        ];
        if(session()->get('loggedInAccessLevel')==1 || session()->get('loggedInAccessLevel')==2 ){
            return view('dashboard/folder', $data);
        }
        else{
            echo 'Access Denied!';
        }
    }

    //auto Display
    public function load(){
        $folderMod = new FolderMod();
        $data['folder']=$folderMod->orderBy('code','ASC')->findAll();
        return $this->response->setJSON($data);
    }
    //auto Display
    public function load2(){
        $employeeModel = new EmploymentDetailsMod();
        $departmentMod = new DepartmentMod();
        $loggedInEmp_id = session()->get('loggedInEmp_id');
        $employeeInfo= $employeeModel->where('emp_id',$loggedInEmp_id)->first();
        //$department_id = $this->request->getPost('department_id');
        $departmentInfo= $departmentMod->where('isu',$employeeInfo["department"])->first();
        if($this->request->isAJAX()){
            $folderMod = new FolderMod();
            $dataFolder=[
                'folder'=>$folderMod->where('folder_user',$loggedInEmp_id)->where('folder_office',$departmentInfo["isu"])->orderBy('folder_name','ASC')->findAll(),
                'department' =>  $departmentInfo
            ];
            $msg=[
                'dataFolder'=>view('application/folderList', $dataFolder),  
            ];
            echo json_encode($msg); 
        }
        else{
            exit('error');
        }
    }
    public function load3(){
        $loggedInEmp_id = session()->get('loggedInEmp_id');
        if($this->request->isAJAX()){
            $departmentMod = new DepartmentMod();
            $data=[
                'department'=>$departmentMod->orderBy('code','ASC')->findAll()
            ];
            $msg=[
                'dataFolder'=>view('application/folderList2', $data),  
            ];
            echo json_encode($msg); 
        }
        else{
            exit('error');
        }
    }
    public function load4(){
        $departmentMod = new DepartmentMod();
        $loggedInEmp_id = session()->get('loggedInEmp_id');
        $departmentInfo = $departmentMod->where('depthead',$loggedInEmp_id)->first();
        if($this->request->isAJAX()){
            $folderMod = new FolderMod();
            $dataFolder=[
                'folder'=>$folderMod->where('folder_office',$departmentInfo["isu"])->orderBy('folder_name','ASC')->findAll(),
                'department' =>  $departmentMod->where('depthead',$loggedInEmp_id)->first()
            ];
            $msg=[
                'dataFolder'=>view('application/folderList3', $dataFolder),  
            ];
            echo json_encode($msg); 
        }
        else{
            exit('error');
        }
    }
    public function insert()
    {
        $folderMod = new FolderMod();
        $SystemLogsMod = new SystemLogsMod();
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        $loggedInEmp_id = session()->get('loggedInEmp_id');
        $loggedInDept = session()->get('loggedInDept');
        $directory = "folder_root/"; // Replace with the actual path
        $folderName = $this->request->getPost('name');
        $department_id = $this->request->getPost('department_id');
        if (!file_exists($directory . $department_id)){
            mkdir($directory . $department_id, 0777, true);
        }
        // Check if the folder already exists
        if (!file_exists($directory . $department_id ."/". $folderName)) {
            // Create the new folder
            if (mkdir($directory . $department_id ."/". $folderName, 0777, true)) {
                $dataPOST=[
                    'folder_user'=>$loggedInEmp_id,
                    'folder_name'=>$folderName,
                    'folder_office'=>$department_id,
                    'folder_lock'=>0
                ];
                $issave=$folderMod->save($dataPOST);
                if($issave){
                    $Data_system_logs=[
                        'emp_id'=>$loggedInEmp_id,
                        'logs'=>'Created Folder '.$folderName.' : '.$ipaddress,
                    ];
                    $SystemLogsMod->save($Data_system_logs);

                    $data = [
                        'status'=>'Folder Inserted Successfully'  
                    ];
                }
                else{$data = ['status'=>'error' ];  }  
            }
            else{$data = ['status'=>'error' ];  }  
        }
        else{ $data = [ 'status'=>'exist'  ];}
       
        return $this->response->setJSON($data);
    }

    //VIEW DETAILS
    public function view(){
        $folderMod = new FolderMod();
        $folder_id =$this->request->getPost('folder_id');
        // $data = $userModel->where('username', 'myname')->first();
        $data2['folder2']=$folderMod->find($folder_id);
        return $this->response->setJSON($data2);
    }

    //editDisplay
    public function edit(){
        $folderMod = new FolderMod();
        $folder_id =$this->request->getPost('folder_id');
        // $data = $userModel->where('username', 'myname')->first();
        $data2['folder2']=$folderMod->find($folder_id);
        return $this->response->setJSON($data2);
    }

    //UPDATE
    public function update()
    {
        $validated = $this->validate([
            'code'=>[
                'rules'=>'is_unique[tblFolder.code,tblFolder.isu,{edit_folder_id}]',
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
            $folderMod = new FolderMod();
            $edit_folder_id=$this->request->getPost('edit_folder_id');
            $dataPOST5=[
                'code'=>$this->request->getPost('code'),
                'description'=>$this->request->getPost('desc'),
                'folderhead'=>$this->request->getPost('folderhead'),
                'edited_by'=>$edited_by
            ];
            $folderMod->update($edit_folder_id,$dataPOST5);
            $data5 = [
                'status'=>'Folder Updated Successfully'  
            ];
            return $this->response->setJSON($data5);
        } 
    }

    //DELETEs
    public function delete()
    {
        $folderMod = new FolderMod();
        $delete_id=$this->request->getPost('delete_id');
        $folderMod->delete($delete_id);
        $data6 = [
            'status'=>'Folder Deleted Successfully'  
        ];
        return $this->response->setJSON($data6);
    }
}
