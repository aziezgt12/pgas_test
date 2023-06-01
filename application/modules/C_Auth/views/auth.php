<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>SIM-KUPM</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">


</head>

<body>

    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="home-btn d-none d-sm-block">
        <!-- <a href="index.html" class="text-white"><i class="fas fa-home h2"></i></a> -->
    </div>
    <div class="wrapper-page">
        <div class="card card-pages shadow-none">

            <div class="card-body">
                <div class="text-center m-t-0 m-b-15">
                    <!-- <a href="index.html" class="logo logo-admin"><img src="assets/images/logo-dark.png" alt="" height="24"></a> -->
                </div>
                <h5 class="font-18 text-center">Selamat Datang</h5>

                <form class="form-horizontal m-t-30" action="index.html" method="post" id="formLogin">

                    <div class="form-group">
                        <div class="col-12">
                            <label>Username</label>
                            <input class="form-control user_id" type="text" required="" name="uname" placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label>Password</label>
                            <input class="form-control password" type="password" name="password" required="" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <div class="checkbox checkbox-primary">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1"> Remember me</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" id="login" type="button">Log In</button>
                        </div>
                    </div>

                    <div class="form-group row m-t-30 m-b-0">
                        <div class="col-sm-7">
                            <a href="pages-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                        </div>
                        <div class="col-sm-5 text-right">
                            <a href="pages-register.html" class="text-muted">Create an account</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/metismenu.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url() ?>assets/js/waves.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/sweet-alert2/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>assets/js/script.js"></script>



    <!-- App js -->
    <script src="<?= base_url() ?>assets/js/app.js"></script>
    <script>
        $(document).on("click", "#login", function() {
            $.ajax({
                url: "<?= base_url('C_Auth/Authorize') ?>",
                method: "POST",
                dataType: "JSON",
                data: $("#formLogin").serialize(),
                beforeSend: function() {
                    $('#login').html("<span>Loading...</span>")
                },
                success: function(response) {
                    setTimeout(function() {
                        if (response == true) {
                            sw_alert("Login Success", "", "success");
                            location.reload()
                        } else {
                            sw_alert("Login Failed", String(response.message), "error");
                            $('#login').html("<span>Login</span>")
                        }
                    }, 2000);

                }
            })

        });
    </script>

</body>

</html>