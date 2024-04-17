<?php
date_default_timezone_set('Asia/Hong_Kong');
?>
<!doctype html>
<html lang="en">
    <head>
        <title><?= (isset($pageTitle)) ? $pageTitle:'Login'; ?> ticket</title>
        <!-- <link rel="shortcut icon" type="image/x-icon" href="<?//=base_url('assets');?>/img/isu.ico"> -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- <link href="<?//=base_url('assets');?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
        <link rel="stylesheet" href="<?= base_url('login');?>/css/style.css">
        <style>
            .password-container{
                width: 100%;
                position: relative;
            }
            .password-container input[type="password"],
            .password-container input[type="text"]{
                width: 100%;
                padding: 12px 36px 12px 12px;
                box-sizing: border-box;
            }
            .fa-eye{
                position: absolute;
                top: 28%;
                right: 4%;
                cursor: pointer;
                color: lightgray;
            }
        </style>
	</head>
	<body style="background-color:#E9ECEF;">
        <!-- background-image: url('<?//= base_url('images');?>/ISUCGATE50.jpg');background-size:100%;" -->
            <section class="ftco-section" >
                <div class="jumbotron" style="min-height: 100%;min-height: 100vh;display: flex;align-items: center;">
                    <div class="container" >
                        <div class="row justify-content-center">
                            <div class="col-md-7 col-lg-5">
                                <div class="login-wrap p-4 p-md-5">
                                
                                    <h3 class="text-center mb-4 text-info">JOB REQUEST SYSTEM</h3>
                                    <span class="text-danger text-sm">
                                        <?php
                                        if(!empty(session()->getFlashData('fail'))){
                                            echo session()->getFlashData('fail');
                                        }
                                        else if(!empty(session()->getFlashData('noaccount'))){
                                            echo session()->getFlashData('noaccount');
                                        }
                                        else if(!empty(session()->getFlashData('unactivated'))){
                                            echo session()->getFlashData('unactivated');
                                        }
                                        else{ } 
                                        ?>
                                    </span>
                                    <span class="text-success text-sm">
                                        <?php
                                        if(!empty(session()->getFlashData('regSent'))){
                                            echo session()->getFlashData('regSent');
                                        }
                                        else if(!empty(session()->getFlashData('success'))){
                                            echo session()->getFlashData('success');
                                        }
                                        else{ }   
                                        ?>
                                    </span>
                                    <form class="user"  action="<?= site_url('Login/loginAccount');?>" method="post">
                                        <div class="form-group">
                                            <input type="text" name="user" class="form-control rounded-left"   value="<?= set_value('user'); ?>" placeholder="Username" required> 
                                            <span class="text-danger text-sm">
                                                <?=isset($validation) ? display_form_errors($validation,'user') :''?>
                                            </span>
                                        </div>                        
                                        <div class="form-group">
                                            <div class="password-container">
                                                <input name="pass" required type="password" placeholder="Password..." id="password" class="form-control form-control-user">
                                                <i class="fa fa-eye" id="eye"></i>
                                            </div>

                                            <span class="text-danger text-sm">
                                                <?= isset($validation) ? display_form_errors($validation,'pass') :''?>     
                                            </span>
                                        </div>
                                        <div class="form-group mt-3">
                                            <input type="submit" value="Login" class=" btn btn-info rounded submit px-3" style="width:100%;">
                                            <!-- <button type="submit" class="form-control btn btn-info rounded submit px-3">Login</button> -->
                                        </div>
                                    </form>
                                    <span class="text-info text-sm text-center">
                                        <small>*Login credentials are the same as with your HRMIS account.</small>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- <script src="<?//= base_url('login');?>/js/jquery.min.js"></script>
            <script src="<?//= base_url('login');?>/js/popper.js"></script>
            <script src="<?//= base_url('login');?>/js/bootstrap.min.js"></script>
            <script src="<?//= base_url('login');?>/js/main.js"></script> -->
            <script>
                const passwordInput = document.querySelector("#password")
                const eye = document.querySelector("#eye")
                eye.addEventListener("click", function(){
                    this.classList.toggle("fa-eye-slash")
                    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password"
                    passwordInput.setAttribute("type", type)
                })
            </script>                                    
	</body>
</html>

