<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\User;
use App\Models\DocumentMod;
use App\Models\SystemLogsMod;
use App\Models\FolderMod;
use App\Models\DepartmentMod;
class DocumentCon extends BaseController
{
    public function index()
    {
        $userModel = new User();
        $loggedIdUser = session()->get('loggedInUser');
        $row = $userModel->find($loggedIdUser);
        $folder_id=$this->request->getPost('folder_id');
        $folder_name=$this->request->getPost('folder_name');
        $department_id=$this->request->getPost('department_id_x');
        $data = [
            'title' => 'document',
            'folder_id' => $folder_id,
            'folder_name' => $folder_name,
            'department_id' => $department_id,
            'userInfo' => $row  
        ];
        //if(session()->get('loggedInAccessLevel')==1 || session()->get('loggedInAccessLevel')==2 ){
            return view('application/document', $data);
        // }
        // else{
        //     echo 'Access Denied!';
        // }
    }
    //auto Display
    public function load(){
        $docMod = new DocumentMod();
        $data['document']=$docMod->orderBy('code','ASC')->findAll();
        return $this->response->setJSON($data);
    }
    //auto Display
    public function load2(){
        $folder_id =$this->request->getPost('folder_id');
        if($this->request->isAJAX()){
            $docMod = new DocumentMod();
            $folderMod = new FolderMod();
            $dataDoc=[
                'document'=>$docMod->where('doc_folder',$folder_id)->where('doc_isdelete',0)->orderBy('doc_name','ASC')->findAll(),
                'folder'=>$folderMod->find($folder_id)
            ];
            $msg=['dataDoc'=>view('application/documentList', $dataDoc)];
            echo json_encode($msg); 
        }
        else{exit('error');} 
    }
    public function insert()
    {
        $docMod = new DocumentMod();
        $SystemLogsMod = new SystemLogsMod();
        $folderMod = new FolderMod();
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        $loggedInEmp_id = session()->get('loggedInEmp_id');
        $loggedInDept = session()->get('loggedInDept');
        $maxFileSize = 100 * 1024 * 1024;
        $documentName = $_POST['name'];
        $folder_id = $_POST['folder'];
        $folder_row = $folderMod->find($folder_id);
        $foldername  = $folder_row['folder_name'];
        $documentDesc = $_POST['desc'];
        $department = $_POST['department'];
        $isexist_query=$docMod->where('doc_folder',$folder_id)->where('doc_name',$documentName)->where('doc_isdelete',0)->findAll();
        $isexist=0;
        foreach($isexist_query as $isexist_row){$isexist=1; }
        if($isexist==0){
            $filename = str_replace(" ", "_", $_FILES['file']['name']);
            $extension = pathinfo($filename,PATHINFO_EXTENSION);
            $extension = strtolower($extension);
            $newfilename =str_replace(".".$extension,"",$filename) ."_". round(microtime(true));
            $location = "folder_root/".$department."/".$foldername."/".$newfilename.".".$extension;
            $chatlocation = $newfilename.".".$extension;     
            if ($_FILES['file']['size'] <= $maxFileSize) {// Check if the file size is within the allowed limit
                $fileSize = $_FILES['file']['size']; // Get the file size
                if (move_uploaded_file(str_replace(" ", "_", $_FILES['file']['tmp_name']), $location)) {
                    $dataFiles=[
                        'doc_user'=>$loggedInEmp_id,
                        'doc_name'=>$documentName,
                        'doc_folder'=>$folder_id,
                        'doc_desc'=>$documentDesc,
                        'doc_path'=>$chatlocation,
                        'doc_size'=>$fileSize,
                        'doc_type'=>$extension,
                        'doc_office'=>$department,
                    ];
                    $issave=$docMod->save($dataFiles);
                    if($issave){
                        $Data_system_logs=[
                            'emp_id'=>$loggedInEmp_id,
                            'logs'=>'Uploaded Document '.$chatlocation.': '.$ipaddress,
                        ];
                        $SystemLogsMod->save($Data_system_logs);
                    }
                    $data = [ 'status'=>'New document has been inserted successfully!' ]; 
                }
                else {$data = ['status'=>'error3']; } 
            } 
            else {$data = ['status'=>'error2']; }  
        }
        else{
            $data = ['status'=>'exist'];
        }
        return $this->response->setJSON($data);
    }
    
    //VIEW DETAILS
    public function view(){
        $docMod = new DocumentMod();
        $doc_id =$this->request->getPost('doc_id');
        // $data = $userModel->where('username', 'myname')->first();
        $data2['document2']=$docMod->find($doc_id);
        return $this->response->setJSON($data2);
    }

    //editDisplay
    public function edit(){
        $docMod = new DocumentMod();
        $doc_id =$this->request->getPost('doc_id');
        $data2['document2']=$docMod->find($doc_id);
        return $this->response->setJSON($data2);
    }

    //UPDATE
    public function update()
    {
        $docMod = new DocumentMod();
        $SystemLogsMod = new SystemLogsMod();
        $folderMod = new FolderMod();
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        $loggedInEmp_id = session()->get('loggedInEmp_id');
        $loggedInDept = session()->get('loggedInDept');
        $maxFileSize = 100 * 1024 * 1024; // 100MB // Maximum file size in bytes (2MB)
        $folder_id = $_POST['folder'];
        $folder_row = $folderMod->find($folder_id);
        $foldername  = $folder_row['folder_name'];
        $documentName = $_POST['name'];
        $documentDesc = $_POST['desc'];
        $documentID = $_POST['edit_doc_id'];
        $department = $_POST['department'];
        $isexist_query=$docMod->where('doc_folder',$folder_id)->where('doc_name',$documentName)->where('doc_isdelete',0)->where('doc_id !=',$documentID)->findAll();
        $isexist=0;
        foreach($isexist_query as $isexist_row){$isexist=1; }
        if($isexist==0){
            if($_FILES['file']['name']){
                $filename = str_replace(" ", "_", $_FILES['file']['name']);
                $extension = pathinfo($filename,PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $newfilename =str_replace(".".$extension,"",$filename) ."_". round(microtime(true));
                $location = "folder_root/".$foldername."/".$newfilename.".".$extension;
                $chatlocation = $newfilename.".".$extension;     
                if ($_FILES['file']['size'] <= $maxFileSize) {
                    $fileSize = $_FILES['file']['size']; 
                    if (move_uploaded_file(str_replace(" ", "_", $_FILES['file']['tmp_name']), $location)) {
                        $dataFiles=[
                            'doc_user'=>$loggedInEmp_id,
                            'doc_name'=>$documentName,
                            'doc_folder'=>$folder_id,
                            'doc_desc'=>$documentDesc,
                            'doc_path'=>$chatlocation,
                            'doc_size'=>$fileSize,
                            'doc_type'=>$extension,
                            'doc_office'=>$department,
                        ];
                        $issave=$docMod->update($documentID,$dataFiles);
                        if($issave){
                            $Data_system_logs=[
                                'emp_id'=>$loggedInEmp_id,
                                'logs'=>'Updated and uploaded new document '.$chatlocation.': '.$ipaddress,
                            ];
                            $SystemLogsMod->save($Data_system_logs);
                        }
                        $data = [ 'status'=>'New document has been updated successfully!' ]; 
                    }
                    else {$data = ['status'=>'error3']; } 
                } 
                else {$data = ['status'=>'error2']; }   
            }
            else{
                $dataFiles=[
                    'doc_user'=>$loggedInEmp_id,
                    'doc_name'=>$documentName,
                    'doc_folder'=>$folder_id,
                    'doc_desc'=>$documentDesc,
                    'doc_office'=>$department,
                ];
                $issave=$docMod->update($documentID,$dataFiles);
                if($issave){
                    $Data_system_logs=[
                        'emp_id'=>$loggedInEmp_id,
                        'logs'=>'UpdateD The Document '.$chatlocation.': '.$ipaddress,
                    ];
                    $SystemLogsMod->save($Data_system_logs);
                }
                $data = [ 'status'=>'New document has been updated successfully!' ]; 
            }
        }
        else{
            $data = ['status'=>'exist'];
        }
        return $this->response->setJSON($data);
    }

    //DELETE
    public function delete()
    {
        $docMod = new DocumentMod();
        $SystemLogsMod = new SystemLogsMod();
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        $delete_id=$this->request->getPost('delete_id');
        $data=[
            'doc_isdelete'=>1
        ];
        $issave=$docMod->update($delete_id,$data);
        if($issave){
            $Data_system_logs=[
                'emp_id'=>$loggedInEmp_id,
                'logs'=>'Deleted Document '.$delete_id.': '.$ipaddress,
            ];
            $SystemLogsMod->save($Data_system_logs);
            $data6 = [
                'status'=>'Document Deleted Successfully'  
            ];
        }
        else{
            $data6 = [
                'status'=>'The document cannot be deleted!'  
            ];
        }
        return $this->response->setJSON($data6);
    }
}
