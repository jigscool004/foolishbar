
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo site_url('assest/admin-lte/css/bootstrap.min.css')?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo site_url('assest/admin-lte/css/font-awesome.min.css')?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo site_url('assest/admin-lte/css/ionicons.min.css')?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo site_url('assest/admin-lte/css/AdminLTE.min.css')?>">
    <link rel="stylesheet" href="<?php echo site_url('assest/admin-lte/css/blue.css')?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>Mobile </b>Store
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php //echo validation_errors();  ?>
        <?php echo  form_open('admin/user/login');
        ?>
        
            <div class="form-group has-feedback">
                <?php
                    echo form_input('username',set_value('username'),[
                        'class' => 'form-control',
                        'placeholder' => 'Username',
                        //'value' => ,
                    ]);
                ?>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <?php echo  form_error('username','<span class="error required">','</span>'); ?>
            </div>
            <div class="form-group has-feedback">

                <?php
                    echo form_password('password','',[
                        'class' => 'form-control',
                        'placeholder' => 'Password'
                    ]);
                ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <?php echo  form_error('password','<span class="error required">','</span>'); ?>
            </div>
            <div class="row">
                <div class="col-xs-8" style="padding-left: 35px;;">
<!--                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>-->
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <?php
                        echo form_submit('mysubmit', 'Sign In',[
                            'class' => 'btn btn-primary btn-block btn-flat'
                        ]);
                    ?>
                </div>
                <!-- /.col -->
            </div>
        <?php echo form_close();?>

        <!-- /.social-auth-links -->

<!--        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>-->

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo site_url('assest/admin-lte/js/jquery-2.2.3.min.js')?>"></script>
<script src="<?php echo site_url('assest/admin-lte/js/bootstrap.min.js')?>"></script>
<script src="<?php echo site_url('assest/admin-lte/js/icheck.min.js')?>"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
