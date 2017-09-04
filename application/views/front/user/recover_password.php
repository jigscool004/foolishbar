<script src="<?php echo site_url('assest/front/js/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo site_url('assest/front/js/additional-methods.min.js'); ?>"></script>
<div class="clearfix"></div>
<div class="page-header-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="header-page">
                    <h1><?php echo $header?></h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="small-breadcrumb">
    <div class="container">

    </div>
</div>
<section class="section-padding error-page pattern-bg ">
    <!-- Main Container -->
    <div class="container">
        <!-- Row -->
        <div class="row">
            <!-- Middle Content Area -->
            <div class="col-md-12  col-sm-12 col-xs-12">
                <?php if ($type == 'pwd_recover') {?>
                <div class="form-grid">
                    <?php echo form_open(site_url('site/recover_password/' . $id),['id' => 'signup']);?>
                    <div class="form-group">
                        <div class="col-md-2"><?php echo form_label('New Password','password'); ?></div>
                        <div class="col-md-4">
                            <?php
                            echo form_password([
                                'name' => 'password',
                                'id' => 'name',
                                'class' => 'form-control',
                                'placeholder' => 'Enter new password',
                            ]);
                            echo form_error('password','<div class="required">','</div>');
                            ?>
                        </div>
                    </div>
                    <div class="clearfix " ></div>
                    <div class="form-group" style="margin-top:5px;">
                        <div class="col-md-2"><?php echo form_label('Confirm Password','confirm_password'); ?></div>
                        <div class="col-md-4">
                            <?php echo form_password([
                                'name' => 'confirm_password',
                                'id' => 'confirm_password',
                                'class' => 'form-control',
                                'maxlength' => 10,
                                'placeholder' => 'Confirm your password',
                            ]);
                            echo form_error('confirm_password','<div class="required">','</div>');
                            ?>
                        </div>
                    </div>
                    <div class="clearfix " ></div>
                    <div class="form-group" style="margin-top:5px;">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <?php echo form_submit('change_password','Change Password',['class' => 'btn btn-theme btn-lg btn-block col-md-2']) ?>
                        </div>
                    </div>
                    <div class="clearfix " ></div>
            </div>
            <?php } else if ($type == 'pwd_msg') {?>
                <p>Your account password has changed successfully. now you can login with new password.
                    <a href="<?php echo site_url('site/login');?>">click here to login</a></p>
           <?php } else if ($type == 'token_expire') {
                    echo '<p>Sorry, you password generate link is expired. please again request of forget password.';
                }?>

        </div>
    </div>
</section>
