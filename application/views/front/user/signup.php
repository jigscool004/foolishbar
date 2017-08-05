<script src="<?php echo site_url('assest/front/js/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo site_url('assest/front/js/additional-methods.min.js'); ?>"></script>
<div class="clearfix"></div>
<div class="page-header-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="header-page">
                    <h1>Create Your Account</h1>
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
            <div class="col-md-5 col-md-push-7 col-sm-12 col-xs-12">
                <!--  Form -->
                <div class="form-grid">
                    <?php echo form_open(site_url('site/signup'),['id' => 'signup']);?>
                        <div class="form-group">
                            <?php 
                                echo form_label('Name ','name');
                                echo form_input([
                                        'name' => 'name',
                                        'id' => 'name',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Your Name',
                                        'value' => set_value('name')
                                     ]);
                                echo form_error('name','<div class="required">','</div>');
                            ?>
                        </div>
                        <div class="form-group">
                             <?php 
                                echo form_label('Contact Number ','mobile_no');
                                echo form_input([
                                        'name' => 'mobile_no',
                                        'id' => 'mobile_no',
                                        'class' => 'form-control',
                                        'maxlength' => 10,
                                        'placeholder' => 'Enter Your Contact Number',
                                        'value' => set_value('mobile_no')
                                     ]);
                                echo form_error('mobile_no','<div class="required">','</div>');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php 
                                echo form_label('Email ','email');
                                echo form_input([
                                        'name' => 'email',
                                        'id' => 'email',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Your Email',
                                        'value' => set_value('email')
                                     ]);
                                echo form_error('email','<div class="required">','</div>');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php 
                                echo form_label('Username ','username');
                                echo form_input([
                                        'name' => 'username',
                                        'id' => 'username',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Your Username',
                                        'value' => set_value('username')
                                     ]);
                                echo form_error('username','<div class="required">','</div>');
                            ?>
                        </div>
                        <div class="form-group">
                            <?php 
                                echo form_label('Password ','password');
                                echo form_password([
                                        'name' => 'password',
                                        'id' => 'password',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Password'
                                     ]);
                                echo form_error('password','<div class="required">','</div>');
                            ?>
                        </div>
                        <!-- <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm-7">
                                </div>
                                <div class="col-xs-12 col-sm-5 text-right">
                                    <p class="help-block"><a data-toggle="modal" data-target="#myModal">Forgot password?</a>
                                    </p>
                                </div>
                            </div>
                        </div> -->
                        <?php 
                           echo form_submit('Signup','Signup',['class' => 'btn btn-theme btn-lg btn-block'])    
                        ?>
                    </form>
                </div>
                <!-- Form -->
            </div>

            <div class="col-md-7  col-md-pull-5  col-sm-12 col-xs-12">
                <div class="heading-panel">
                    <h3 class="main-title text-left">
                        Create Your Account  
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
                    <div class="features">
                        <div class="features-icons">
                            <img alt="img" src="<?php echo site_url('assest/front/images/icons/history.png') ?>">
                        </div>
                        <div class="features-text">
                            <h3>Track History</h3>
                            <p>
                                Track the status of your ads history.
                            </p>
                        </div>
                    </div>
                    <div class="features">
                        <div class="features-icons">
                            <img alt="img" src="<?php echo site_url('assest/front/images/icons/featured-listing.png') ?>">
                        </div>
                        <div class="features-text">
                            <h3>features Listing</h3>
                            <p>
                                Get more value fro your ad.
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
<script src="<?php echo site_url('assest/front/js/jquery.validate.min.js')?>"></script>
<script>
    jQuery(document).ready(function($) {
        $('#signup').validate({
            rules:{
                name:{required:true},
                mobile_no:{
                    required:true,
                    number:true,
                    remote:'<?php echo site_url('site/checkdata')?>'
                    /*{
                        url:,
                        type:'post',
                        success:function($data){
                            console.log($data);
                        }
                    }*/
                },
                email:{
                    required:true,
                    email:true,
                    remote:'<?php echo site_url('site/checkdata')?>'
                },
                username:{
                    required:true,
                    minlength:5,
                    remote:'<?php echo site_url('site/checkdata')?>'
                },
                password:{
                    required:true,
                    minlength:6
                }
            },
            messages:{
                name:'Name is required',
                mobile_no:{
                    required:'Contact Number is required',
                    number:'Contact Number must be in numeric'
                },
                emali:{
                    required:'Email is required',
                    email:'Email id is invalid'
                },
                username:{
                    required:'Username is required',
                    minlength:'Please enter username in minimum 5 character'
                },
                password:{
                    required:'Password is required',
                    minlength:'Please enter password in minimum 6 character'
                }
            }
        });
    });
</script>