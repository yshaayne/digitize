<?php
if(session()->get('loggedInUser')){redirect('/');}else{}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISUC FMS</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .gradient-custom {
        /* fallback for old browsers */
        background: #6a11cb;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <section class="vh-100 " style="">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card  text-white" style="border-radius: 1rem; background-color:#0E2238;">
                        <div class="card-body p-5 text-center">
                            <div class=" mt-md-2 pb-2">
                                <form class="user"  action="logincheck" method="post">
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
                                        else if(!empty(session()->getFlashData('logout'))){
                                            echo session()->getFlashData('logout');
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
                                    <h2 class="fw-bold mb-2 text-uppercase">ISUC</h2>
                                    <p class="text-white-50 mb-5">*Login credentials are the same as with your HRMIS account.</p>
                                    <div data-mdb-input-init class="form-outline form-white mb-5">
                                        <input type="text" name="user" class="form-control form-control-lg rounded-left" placeholder="USERNAME : " required />
                                    </div>
                                    <div data-mdb-input-init class="form-outline form-white mb-5">
                                        <input name="pass" required type="password" placeholder="PASSWORD : " id="password" class="form-control form-control-lg form-control-user"/>
                                    </div>
                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>