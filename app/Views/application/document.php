<?php
    echo $this->extend('layout/layout');
    echo $this->section('content');
    $db = \Config\Database::connect();
    //====================================================================================
    ?>
    <!-- Page Heading -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <a href="<?=site_url("/");?>">
                            <img src="<?=base_url("assets/img/home.png");?>" alt="" style="width:25px;height:25px;">
                            <span class="text-gray-800">Home</span> 
                        </a>
                        <a href="#">
                            <img src="<?=base_url("assets/img/folder.png");?>" alt="" style="width:25px;height:25px;"> 
                            <span class="text-gray-800"><?php if($folder_name){echo $folder_name;}else{echo "unknown";}?></span>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <span id="DocumentStatus" class="text-info ms-3"></span>
                    </div>
                    <div class="col-sm-3 ">
                        <button type="button" class="btn btn-sm btn-outline-primary float-right" data-bs-toggle="modal" data-bs-target="#addModalCenter">
                             NEW DOCUMENT
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text viewDocumentList">
                </p> 
                <div class="list">

                </div>     
            </div>
        </div>
    </div>
        <!-- ############################################################################################################################# -->
        <!-- Add Modal --><!-- Add Modal --><!-- Add Modal --><!-- Add Modal --><!-- Add Modal --><!-- Add Modal --><!-- Add Modal -->
        <!-- ############################################################################################################################# -->
        <div class="modal fade " id="addModalCenter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  role="dialog" aria-labelledby="addModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog   modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#0E2238;padding: 2px 15px 2px 5px;">
                        <img src="<?=base_url('assets');?>/img/isu.png" class="mr-4" alt="" width="17" height="17">&nbsp;
                        <span class="modal-title text-white" id="addModalLongTitle">UPLOAD DOCUMENT</span>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                            <!-- <span aria-hidden="true">&times;</span> -->
                        </button>
                    </div>
                    <form class="form-add" id="form-add" action="#" method="POST" enctype="multipart/form-data"> 
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Progress bar -->
                                            <div class="col-sm-12 progress">
                                                <div class="progress-bar" ></div>
                                            </div>
                                            <!-- Display upload status -->
                                            <div id="uploadStatus "></div>
                                            <div class="form-group  mb-4 mt-4">
                                                        <small>Name :</small>
                                                        <input type="hidden"  name="folder" value="<?php if($folder_id){echo $folder_id;}else{echo "0";}?>" >
                                                        <input type="hidden"  name="department" value="<?php if($department_id){echo $department_id;}else{echo "0";}?>" >
                                                        <input type="text" name="name" class="form-control" id="name"  required>                                                   
                                                    </div>
                                            <div class="form-group mb-4">
                                                <small>Description (Optional) :</small>
                                                <textarea id="desc" name="desc"  class="form-control" style="height: 120px; overflow-y: scroll;">
                                                    
                                                </textarea>
                                            </div>
                                            <div class="form-group">
                                                <small>File :</small>
                                                <input type="file" name="file" class="form-control" id="file" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="padding: 2px 20px 2px 20px;">
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><span class="fa fa-times"></span> CLOSE</button>
                            <button type="submit" class="btn btn-sm btn-outline-primary document-save"><span class="fa fa-save"></span> SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- #############################################################################################################################
        ############################################################################################################################# -->
        <!-- EDIT Modal -->
        <div class="modal fade" id="editModalCenter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#0E2238;padding: 2px 15px 2px 5px;">
                        <img src="<?=base_url('assets');?>/img/isu.png" class="mr-4" alt="" width="17" height="17">&nbsp;
                        <span class="modal-title text-white" id="addModalLongTitle"> DOCUMENT</span>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

                        
                    </div>
                    <form class="form-update" id="form-update" action="#" method="POST" enctype="multipart/form-data"> 
                        <div class="modal-body">
                            <input type="hidden" class="form-control edit_doc_id" name="edit_doc_id" id="edit_doc_id">
                            <div class="row">
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Progress bar -->
                                            <div class="col-sm-12 progress2">
                                                <div class="progress-bar2" ></div>
                                            </div>
                                            <!-- Display upload status -->
                                            <div id="uploadStatus2 "></div>
                                            <div class="form-group  mb-4 mt-4">
                                                        <small>Name :</small>
                                                        <input type="hidden"  name="folder" value="<?php if($folder_id){echo $folder_id;}else{echo "0";}?>" >
                                                        <input type="hidden"  name="department" value="<?php if($department_id){echo $department_id;}else{echo "0";}?>" >
                                                        <input type="text" name="name"  class="form-control name_edit"   required>                                                   
                                                    </div>
                                            <div class="form-group mb-4">
                                                <small>Description (Optional) :</small>
                                                <textarea id="editor2" name="desc"  class="form-control desc_edit" style="height: 120px; overflow-y: scroll;">
                                                   
                                                </textarea>
                                               
                                            </div>
                                            <div class="form-group">
                                                <small>Change file :</small>
                                                <input type="file" name="file" class="form-control file_edit" id="fileInput_edit" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <div class="modal-footer" style="padding: 2px 20px 2px 20px;">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><span class="fa fa-times"></span> Close</button>
                        <button type="submit" class="btn btn-sm btn-primary document-update"><span class="fa fa-save"></span> UPDATE</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- #############################################################################################################################
        ############################################################################################################################# -->
        <!-- DELETE Modal -->
        <div class="modal fade" id="deleteModalCenter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm " role="document" >
                <div class="modal-content">
                    <div class="modal-header " style="background-color:#0E2238;padding: 2px 15px 2px 5px;">
                        <img src="<?=base_url('assets');?>/img/isu.png"  class="mr-4" alt="" width="17" height="17">
                        <span class="modal-title text-white" id="deleteModalLongTitle">&nbsp;Deletion</span>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                        <!-- <span aria-hidden="true">&times;</span> -->
                        </button>
                    </div>
                <div class="modal-body">
                    <input type="hidden" name="delete_id" class="delete_id" id="delete_id">
                    <small>Are you  sure,you want to delete this file?</small>
                </div>
                <div class="modal-footer" style="padding: 2px 20px 2px 20px;">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><span class="fa fa-times"></span> Close</button>
                    <button type="button" class="btn btn-sm btn-danger delete-confirm"><span class="fa fa-trash"></span> Yes</button>
                </div>
                </div>
            </div>
        </div>
    <?php
    //====================================================================================
    echo $this->endSection();
    echo $this->section('document-script');
    ?>
    <script>
        //LOAD DATA
        function displayDocument(){
            $.ajax({
                url: "document-load2",
                type: "POST",
                data:  {'folder_id':<?php if($folder_id){echo $folder_id;}else{echo "0";}?>},   
                dataType:"json",
                beforeSend:function(){
                    $("#loading").show();
                },
                complete:function(){
                    $("#loading").hide();
                },
                success: function (response) {
                    $('.list').html(response.dataDoc);
                }
            });
        }
        $(document).ready(function () {
            displayDocument();
            // File type validation
            $("#fileInput").change(function(){
                var allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'text/csv',
                                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 
                                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel',
                                    'application/vnd.ms-excel.sheet.macroEnabled.12',
                                    'application/vnd.openxmlformats-officedocument.presentationml.presentation' ,
                                    'image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                var file = this.files[0];
                var fileType = file.type;
                if(!allowedTypes.includes(fileType)){
                    alert('Please select a valid file (PDF/DOC/DOCX/XLSX/SLX/PPT/JPEG/JPG/PNG/GIF).');
                    $("#fileInput").val('');
                    return false;
                }
            });
            //INSERT
            $("#form-add").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                var percentComplete2 = ((evt.loaded / $('.progress').parent().width()) * 100);
                                $(".progress-bar").width(percentComplete2 + '%');
                                $(".progress-bar").html(percentComplete+'%');
                            }
                        }, false);
                        return xhr;
                    },
                    url: "document-add",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                            cache: false,
                    processData:false,
                    beforeSend: function(){
                        $(".progress-bar").width('0%');
                        // $('#uploadStatus').html('<h5>loading</h5>');//<img src="images/loading.gif"/>
                    },
                    error:function(){
                        $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                    },
                    success: function (response) {
                        if(response.status=="exist"){
                            $(".progress-bar").width('0%');
                            alert('Name is already exist! Please input unique name.');
                            $('.name').focus();
                        }
                        else if(response.status=="error2"){
                            $(".progress-bar").width('0%');
                            alert('you have reach the file size limit');
                        }
                        else if(response.status=="error3"){
                            $(".progress-bar").width('0%');
                            alert('A new record could not be saved due to a DB error.');
                        }
                        else{
                            $('.list').html('');
                            $('#name').val(null);
                            $('#desc').val(null);
                            $('#file').val(null);
                            displayDocument();
                            alert(response.status);
                            $(".progress-bar").width('0%');
                            $('#addModalCenter').modal('hide');
                        }  
                    }
                });
            }));
            //DELETE
            $(document).on('click','.delete_btn', function () { 
                var doc_id=$(this).closest("tr").find(".doc_id").val();
                $('#delete_id').val(doc_id);
                $('#deleteModalCenter').modal('show');
            });
            //DELETE CONFIRM
            $(document).on('click','.delete-confirm', function () { 
                var delete_id=$('#delete_id').val();
                $.ajax({
                    type: "POST",
                    url: "document-delete",
                    data: {
                            'delete_id':delete_id 
                    },
                    success: function (response) {
                        $('#deleteModalCenter').modal('hide');
                        $('#deleteModalCenter').find('input').val('');
                        $('.list').html('');
                        displayDocument();
                        alert(response.status);
                    } 
                });
            });
            //EDIT
            $(document).on('click','.edit_btn', function () { 
                var doc_id=$(this).closest("tr").find(".doc_id").val();
                $.ajax({
                    type: "POST",
                    url: "document-edit",
                    data: {'doc_id':doc_id },
                    success: function (response) {
                        $.each(response, function (key, value) { 
                            $('.edit_doc_id').val(value['doc_id']);
                            $('.name_edit').val(value['doc_name']);
                            $('.desc_edit').val(value['doc_desc']);
                            //CKEDITOR.instances['#editor2'].setData('blub');
                            //$('.edit_email').val(value['email']);
                           //CKEDITOR.instances.editor2.insertHtml(value['doc_desc']);
                        });
                        $('#editModalCenter').modal('show');
                    } 
                });   
            });
            //UPDATE
            $("#form-update").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress2", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                var percentComplete2 = ((evt.loaded / $('.progress2').parent().width()) * 100);
                                $(".progress-bar2").width(percentComplete2 + '%');
                                $(".progress-bar2").html(percentComplete+'%');
                            }
                        }, false);
                        return xhr;
                    },
                    url: "document-update",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                            cache: false,
                    processData:false,
                    beforeSend: function(){
                        $(".progress-bar2").width('0%');
                        // $('#uploadStatus2').html('<h5>loading</h5>');//<img src="images/loading.gif"/>
                    },
                    error:function(){
                        $('#uploadStatus2').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                    },
                    success: function (response) {
                        if(response.status=="exist"){
                            $(".progress-bar").width('0%');
                            alert('Name is already exist! Please input a unique name.');
                            $('.name_edit').focus();
                        }
                        else if(response.status=="error2"){
                            $(".progress-bar").width('0%');
                            alert('you have reach the file size limit');
                        }
                        else if(response.status=="error3"){
                            $(".progress-bar").width('0%');
                            alert('A new record could not be saved due to a DB error.');
                        }
                        else{
                            $('.list').html('');
                            $('.name_edit').val(null);
                            $('.desc_edit').val(null);
                            $('.file_edit').val(null);
                            displayDocument();
                            alert(response.status);
                            $(".progress-bar2").width('0%');
                            $('#editModalCenter').modal('hide');
                        }  
                    }
                });
            }));
        });

    </script>
    <?php
    echo $this->endSection();

?>