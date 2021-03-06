<div class="page-header-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="header-page">
                    <h1>User login</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="small-breadcrumb">
    <div class="container">
        <div class=" breadcrumb-link">
            <ul>
                <li><a href="index-2.html">Home</a></li>
                <li><a href="#" class="active">Sign Up</a></li>
            </ul>
        </div>
    </div>
</div>
<section class="section-padding error-page pattern-bg ">
    <!-- Main Container -->
    <div class="container">
        <!-- Row -->
        <div class="row">
            <!-- Middle Content Area -->
            <div class="col-md-5 col-md-push-7 col-sm-6 col-xs-12">
                <!--  Form -->
                <div class="form-grid">
                    <?php echo form_open(site_url('site/login'),'id=loginform') ?>

                        <div class="form-group">
                            <?php 
                                echo form_label('Username ','login_username');
                                echo form_input([
                                        'name' => 'login_username',
                                        'id' => 'login_username',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Username',
                                        'value' => set_value('login_username')
                                     ]);
                                echo form_error('login_username','<div class="required">','</div>');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php 
                                echo form_label('Password','login_password');
                                echo form_password([
                                        'name' => 'login_password',
                                        'id' => 'login_password',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Password',
                                     ]);
                                echo form_error('login_password','<div class="required">','</div>');
                            ?>
                        </div>
                        <div class="col-xs-12 col-sm-12 text-right">

                            <p class="help-block">
                                <a href="<?php echo site_url('site/signup') ?>">Sign up</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                <a data-target="#myModal" class="forget_pwd" data-toggle="modal">Forgot password?</a>
                            </p>
                        </div>
                        <?php 
                            echo form_submit('login','Login',['class' => 'btn btn-theme btn-lg btn-block']);    
                            echo form_hidden('login_error');
                            echo form_error('login_error','<div class="required">','</div>');
                     ?>
                    <?php echo form_close(); ?>
                </div>
                <!-- Form -->
            </div>

            <div class="col-md-7  col-md-pull-5  col-xs-12 col-sm-6">
                <div class="heading-panel">
                    <h3 class="main-title text-left">
                        Sign In to your account   
                    </h3>
                </div>
                <div class="content-info">
                    <div class="features">
                        <div class="features-icons">
                            <img alt="img" src="<?php echo site_url('assest/front/images/icons/chat.png') ?>">
                        </div>
                        <div class="features-text">
                            <h3>Chat &amp; Messaging</h3>
                            <p>
                                Access your chats and account info from any device.
                            </p>
                        </div>
                    </div>
                    <div class="features">
                        <div class="features-icons">
                            <img alt="img" src="<?php echo site_url('assest/front/images/icons/panel.png') ?>">
                        </div>
                        <div class="features-text">
                            <h3>User Dashboard</h3>
                            <p>
                                Maintain a wishlist by saving your favourite items.
                            </p>
                        </div>
                    </div>
                    <span class="arrowsign hidden-sm hidden-xs"><img alt="" src="images/arrow.png"></span>
                </div>
            </div>
            <!-- Middle Content Area  End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Main Container End -->
</section>
<div class="custom-modal">
    <div id="myModal" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header rte">
                    <h2 class="modal-title">Forgot Your Password ?</h2>
                </div>
                <form id="forgetPassword">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input placeholder="Enter Your Username" id="username" name="username" class="form-control" type="text">
                            <label id="username-error" class="error" for="username" style="display: none;"></label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-theme">Reset My Account</button>
                        <button type="button" class="btn btn-dark closeModelBox" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo site_url('assest/front/js/jquery.validate.min.js')?>"></script>
<script src="<?php echo site_url('assest/admin-lte/js/jquery.toaster.js')?>"></script>
<script>
    jQuery(document).ready(function($) {
        <?php if (isset($_GET['type']) && $_GET['type'] == 'forget_pwd') :?>
            //window.history.go(-1);
        window.history.back(-1);
            $(".forget_pwd").trigger('click');
        <?php endif;?>
        $('#loginform').validate({
            rules:{
                'login_username':{required:true},
                'login_password':{required:true}
            },
            messages:{
                'login_username':'Usenrame is required',
                'login_password':'Password is required',
            }
        });

        $("#forgetPassword").validate({
            rules:{
                'username':{
                    required:true,
                  //  remote:'<?php //echo site_url('site/checkdata?t=forgetPwd')?>'
                }
            },
            messages:{
                'username':'Usenrame is required',
            },
            submitHandler:function(form) {
                $.ajax({
                    url:"<?php echo site_url('site/forget_password'); ?>",
                    data:$("#forgetPassword").serialize(),
                    type:"POST",
                    dataType:"json",
                    cache:false,
                    success:function(data) {
                        if (data.type == "error") {
                            $("#username-error").show().html(data.message);
                        } else if (data.type == "success") {
                            $(".closeModelBox").trigger('click');
                            $("#username").val(' ');
                            $.toaster({ priority : data.type,  message : data.message});
                        } else {
                            $.toaster({ priority : data.type,  message : data.message});
                        }
                    }
                });
                //console.log($("#forgetPassword").serialize());
                return false;
            }
        });
    });
</script>