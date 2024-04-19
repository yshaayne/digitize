<?php
if(session()->get('loggedInUser')){}else{redirect('login');}
date_default_timezone_set('Asia/Hong_Kong');
// echo strtotime("2024-04-17 07:59:00");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISUC FMS</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=base_url('assets');?>/style.css">

    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('assets');?>/img/isu.ico">
    <link rel="stylesheet" href="<?=base_url('assets');?>/datatables/5/dataTables.bootstrap5.css">
    <!-- <link rel="stylesheet" href="<?//=base_url('assets');?>/datatables/dataTables.bootstrap4.min.css"> -->
    <script src="<?=base_url('assets');?>/jquery/jquery.min.js"></script>
    <script src="<?=base_url('assets');?>/select/select2.min.js"></script>
    <link href="<?=base_url('assets');?>/select/select2.min.css" rel="stylesheet" />
    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script> 
    <!-- CKEditor 4 -->
    <!-- <script src="https://cdn.ckeditor.com/4.24.0-lts/standard/ckeditor.js"></script> -->
    
    <style>
        .modal-dialog-bottom {
            position: fixed !important;
            bottom: 0 !important;
            left: 0% !important;
            right: 0% !important;
            margin-bottom: 0 !important;   
        } 
        #loading{
            display:none;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">ISUC FMS</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="<?=site_url("/");?>" class="sidebar-link">
                        <i class="lni lni-home"></i>
                        <span >FILE MANAGER</span>
                    </a>
                </li>
               
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-cog"></i>
                        <span>Setup</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Department</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">link 1</a>
                        </li>
                    </ul>
                </li>

                <!-- <li class="sidebar-item">
                    <a href="" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>File Manager</span>
                    </a>
                </li> -->

                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Auth</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Login</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Register</a>
                        </li>
                    </ul>
                </li> -->
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-layout"></i>
                        <span>Multi Level</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                Two Links
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 1</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> -->
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Notification</span>
                    </a>
                </li> -->
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li> -->
            </ul>
            <div class="sidebar-footer">
                <a href="#" data-bs-toggle="modal" data-bs-target="#logoutMod" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>

           
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3">
                <form action="#" class="d-none d-sm-inline-block">

                </form>
                <h1 class="fw-bold fs-4 mb-3">ISUC FILE MANAGEMENT SYSTEM</h1>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="<?=base_url('assets');?>/account.png" class="avatar img-fluid" alt="">
                            </a>
                            <!-- <div class="dropdown-menu dropdown-menu-end rounded">
                                
                            </div> -->
                            <ul class="dropdown-menu dropdown-menu-end rounded" >
                               
                                <li><a class="dropdown-item" href="/">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Password</a></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutMod" href="#">Logout</a></li>
                              </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div id="loading">
                        <div class="row">
                            <img id="loading-image" src="assets/img/giphy.gif" alt="Loading" />
                        </div>
                    </div>  
                    <div class="mb-3">
                    <?= $this->renderSection('content'); ?>
                      
                    </div>
                </div>
            </main>
            <footer class="mt-auto footer">
                <div class="container-fluid">
                    <div class="row text-body-secondary">
                        <div class="col-6 text-start ">
                            <a class="text-body-secondary" href=" #">
                                <strong>ISUC FMS</strong>
                            </a>
                        </div>
                        <div class="col-6 text-end text-body-secondary d-none d-md-block">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a class="text-body-secondary" href="#">Contact</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-body-secondary" href="#">About Us</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-body-secondary" href="#">Terms & Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="logoutMod" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form class="user"  action="logout" method="get">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color:#0E2238;"><?//=site_url('logout');?>
                <h5 class="modal-title" id="logoutModLabel">ISUC FMS</h5>
                <button type="button" class="btn-close" style="color:#FFFFFF;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to log out?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes</button>
            </div>
        </div>
        </form>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="<?=base_url('assets');?>/datatables/5/dataTables.js"></script>
    <script src="<?=base_url('assets');?>/datatables/5/dataTables.bootstrap5.js"></script>

    <script src="<?=base_url('assets');?>/script.js"></script>
    <?=$this->renderSection('index-script'); ?>
    <?=$this->renderSection('document-script'); ?>

    <script>
            //CKEditor 5
            ClassicEditor
                    .create( document.querySelector( '#editor1' ) )
                    .then( editor => {
                            console.log( editor );
                    } )
                    .catch( error => {
                            // console.error( error );
                    } );
            //CKEditor 4   
            //CKEDITOR.replace( 'editor1' );
    </script>
    <style>
        /* #uploadForm label {
            margin: 2px;
            font-size: 1em;
        } */

        #progress-bar {
            background-color: #12CC1A;
            color: #FFFFFF;
            width: 0%;
            -webkit-transition: width .3s;
            -moz-transition: width .3s;
            transition: width .3s;
            border-radius: 5px;
        }

        #targetLayer {
            width: 100%;
            text-align: center;
        }
    </style>
</body>

</html>