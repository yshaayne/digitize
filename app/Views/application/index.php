<?php
    echo $this->extend('layout/layout');
    echo $this->section('content');
    date_default_timezone_set('Asia/Hong_Kong');
    // $db = \Config\Database::connect();
    // $db_ticket = \Config\Database::connect("ticket");
    //====================================================================================
    ?>
        <h3 class="fw-bold fs-4 mb-3">INFORMATION</h3>
        <div class="row">
            <div class="col-12 col-md-4 ">
                <div class="card border-0">
                    <div class="card-body py-4">
                        <h5 class="mb-2 fw-bold">
                            UPLOADS
                        </h5>
                        <p class="mb-2 fw-bold">
                            MIST
                        </p>
                        <div class="mb-0">
                            <span class="badge text-success me-2">
                                Last Update : 04-04-24
                                <?php echo strtotime("2024-04-03 17:00:00");?><br>
                            </span>
                            <span class=" fw-bold">
                                100 total files
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 ">
                <div class="card  border-0">
                    <div class="card-body py-4">
                        <h5 class="mb-2 fw-bold">
                           DOWNLOADS
                        </h5>
                        <p class="mb-2 fw-bold">
                            HR
                        </p>
                        <div class="mb-0">
                            <span class="badge text-success me-2">
                                Last Update : 04-04-24
                            </span>
                            <span class=" fw-bold">
                                100 total files
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 ">
                <div class="card border-0">
                    <div class="card-body py-4">
                        <h5 class="mb-2 fw-bold">
                            DL/UL
                        </h5>
                        <p class="mb-2 fw-bold">
                            ALL
                        </p>
                        <div class="mb-0">
                            <span class="badge text-success me-2">
                                Last Update : 04-04-24
                            </span>
                            <span class=" fw-bold">
                                400 total files
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="fw-bold fs-4 my-3">Folder Directory
        </h3>
        <div class="row">
            <div class="col-sm-12">
                <button type="button" class="btn btn-sm btn-outline-primary float-end" data-bs-toggle="modal" data-bs-target="#addModalCenter">
                    NEW FOLDER
                </button>
            </div>
        </div>
        <div class="row list">
           
        </div>


        <h3 class="fw-bold fs-4 my-3 mt-5">Shared Folder
        </h3>
      
        <div class="row list2">
           
        </div>
        <!-- ############################################################################################################################# -->
        <!-- Add Modal --><!-- Add Modal --><!-- Add Modal --><!-- Add Modal --><!-- Add Modal --><!-- Add Modal --><!-- Add Modal -->
        <!-- ############################################################################################################################# -->
        <div class="modal fade " id="addModalCenter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  role="dialog" aria-labelledby="addModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog   modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#0E2238;padding: 2px 15px 2px 5px;">
                        <img src="<?=base_url('assets');?>/img/isu.png" class="mr-4" alt="" width="17" height="17">&nbsp;
                        <span class="modal-title text-white" id="addModalLongTitle">CREATE FOLDER</span>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                            <!-- <span aria-hidden="true">&times;</span> -->
                        </button>
                    </div>
                    <form class="form-add" id="form-add" action="#" method="POST" enctype="multipart/form-data"> 
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <small>Name :</small>
                                        <input type="text" name="name" class="form-control" id="exampleInputUsername1" placeholder="Folder Name" required>                                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="padding: 2px 20px 2px 20px;">
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal"><span class="fa fa-times"></span> CLOSE</button>
                            <button type="submit" class="btn btn-sm btn-outline-primary folder-save"><span class="fa fa-save"></span> SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php
    //====================================================================================
    
    echo $this->endSection();
    echo $this->section('index-script');
    ?>
    <script>
        //LOAD DATA
        function displayFolder(){
            $.ajax({
                url: "folder-load2",
                dataType:"json",
                success: function (response) {
                    $('.list').html(response.dataFolder);
                }
            });
        }
        $(document).ready(function () {

            displayFolder();
            //INSERT
            $("#form-add").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "folder-add",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                            cache: false,
                    processData:false,
                    success: function (response) {
                        if(response.status=="exist"){
                            alert('Name is already exist! Please input unique name.');
                            $('.name').focus();
                        }
                        else if(response.status=="error"){
                            alert('A new record could not be saved due to a DB error.');
                        }
                        else{
                            $('#addModalCenter').find('input').val('');
                            $('.list').html('');
                            $('#form-add')[0].reset();
                            displayFolder();
                            //alert(response.status);
                            $('#addModalCenter').modal('hide');
                        }  
                    }
                });
            }));
            
            //DELETE
            $(document).on('click','.delete_btn', function () { 
                var sup_id=$(this).closest("tr").find(".sup_id").val();
                $('#delete_id').val(sup_id);
                $('#deleteModalCenter').modal('show');
            });

            //DELETE CONFIRM
            $(document).on('click','.delete-confirm', function () { 
                var delete_id=$('#delete_id').val();
                $.ajax({
                    type: "POST",
                    url: "folder-delete",
                    data: {
                            'delete_id':delete_id 
                    },
                    success: function (response) {
                        $('#deleteModalCenter').modal('hide');
                        $('#deleteModalCenter').find('input').val('');
                        $('.list').html('');
                        displayFolder();
                        $('#FolderStatus').text(response.status);
                    } 
                });
            });

            //EDIT
            $(document).on('click','.edit_btn', function () { 
                var sup_id=$(this).closest("tr").find(".sup_id").val();
                $.ajax({
                    type: "POST",
                    url: "folder-edit",
                    data: {'sup_id':sup_id },
                    success: function (response) {
                        $.each(response, function (key, value) { 
                            $('.edit_sup_id').val(value['isu']);
                            $('.edit_name').val(value['Folder']);
                            $('.edit_desc').val(value['description']);
                            $('.edit_address').val(value['address']);
                            $('.edit_tel').val(value['tel']);
                            $('.edit_mobile').val(value['mobile']);
                            $('.edit_email').val(value['email']);
                        });
                        $('#editModalCenter').modal('show');
                    } 
                });   
            });


            //UPDATE
            $('.folder-update').click(function (e) { 
                e.preventDefault();
                if($('.edit_name').val().length==0){alert('Folder name is required');$('.edit_name').focus();return false;}
                if($('.edit_desc').val().length==0){alert('Folder description is required');$('.edit_desc').focus();return false;}   
                if($('.edit_address').val().length==0){alert('Folder address is required');$('.edit_address').focus();return false;}
                $.ajax({
                    type: "POST",
                    url: "folder-update",
                    data:{
                    'edit_sup_id': $('.edit_sup_id').val(),
                    'Folder': $('.edit_name').val(),
                    'desc': $('.edit_desc').val(),
                    'address': $('.edit_address').val(),
                    'tel': $('.edit_tel').val(),
                    'mobile': $('.edit_mobile').val(),
                    'email': $('.edit_email').val(),
                    },
                    success: function (response) {
                        if(response.status=="error_validated"){
                            alert('Name is already exist! Please input unique name.');
                            $('.name').focus();
                        }
                        else if(response.status=="error"){
                            alert('The record could not be saved due to a DB error.');
                        }
                        else{
                            $('#editModalCenter').modal('hide');
                            $('#editModalCenter').find('input').val('');
                            $('.list').html('');
                            displayFolder();
                            $('#FolderStatus').text(response.status);
                        }  
                    }
                });
            });
        });

    </script>
    <?php
    echo $this->endSection();
?>