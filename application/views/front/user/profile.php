<script src="<?php echo site_url('assest/admin-lte/js/jquery.toaster.js')?>"></script>
<div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding gray">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <!-- Middle Content Area -->
                  <?php
                   $this->load->view('front/usertemplate/leftbar');
                    ?>
                  <div class="col-md-8 col-sm-12 col-xs-12">
                     <!-- Row -->
                     <div class="profile-section margin-bottom-20">
                        <div class="profile-tabs">
                           <ul class="nav nav-justified nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
                              <li><a data-toggle="tab" href="#edit">Edit Profile</a></li>
                               <li><a data-toggle="tab" href="#changePassword">Change Password</a></li>
                           </ul>
                           <div class="tab-content">
                              <div id="profile" class="profile-edit tab-pane fade in active">
                                 <h2 class="heading-md">Manage your profile details</h2>
                                 <p>Below are the name and email addresses on file for your account.</p>
                                 <dl class="dl-horizontal">
                                    <dt><strong>Your name </strong></dt>
                                    <dd>
                                       <?php echo $user_dataArr->name ?>
                                    </dd>
                                    <dt><strong>Username </strong></dt>
                                    <dd>
                                       <?php echo $user_dataArr->username ?>
                                    </dd>
                                    <dt><strong>Email Address </strong></dt>
                                    <dd>
                                       <?php echo $user_dataArr->email ?>
                                    </dd>
                                    <dt><strong>Phone Number </strong></dt>
                                    <dd>
                                       <?php echo "+91-" . $user_dataArr->mobile_no ?>
                                       
                                    </dd>
                                 </dl>
                              </div>
                              <div id="edit" class="profile-edit tab-pane fade">
                                 <h2 class="heading-md">Manage your Security Settings</h2>
                                 <p>Manage Your Account</p>
                                 <div class="clearfix"></div>
                                 <?php echo form_open(); ?>
                                    <div class="row">
                                       <div class="col-md-6 col-sm-6 col-xs-12">
                                          <label>Usenrame <span class="required">*</span></label>
                                          <input type="text" name="username" value="<?php echo $user_dataArr->username; ?>" disabled="disabled" class="form-control margin-bottom-20">
                                       </div>
                                       <div class="col-md-6 col-sm-6 col-xs-12">
                                          <label>Your Name </label>
                                          <input type="text" name="full_name" value="<?php echo set_value('full_name',$user_dataArr->name); ?>" class="form-control margin-bottom-20">
                                          <?php echo form_error('full_name','<div class="required">','</div>') ?>
                                       </div>
                                       <div class="col-md-6 col-sm-6 col-xs-12">
                                          <label>Email Address <span class="required">*</span></label>
                                          <input type="text" name="email" class="form-control margin-bottom-20" value="<?php echo set_value('email',$user_dataArr->email); ?>">
                                          <?php echo form_error('email','<div class="required">','</div>') ?>
                                       </div>
                                       
                                       <div class="col-md-6 col-sm-6 col-xs-12">  
                                          <label>Contact Number <span class="required">*</span></label>
                                          <input type="text" name="mobile_no" class="form-control margin-bottom-20" value="<?php echo set_value('mobile_no',$user_dataArr->mobile_no); ?>">
                                          <?php echo form_error('mobile_no','<div class="required">','</div>') ?>
                                    </div>
                                   
                                    <div class="clearfix"></div>
                                    <div class="row">
                                       
                                       <div class="col-md-4 col-sm-4 col-xs-12 text-right">
                                          <button class="btn btn-theme btn-sm" name="saveProfile" type="submit">Update My Info</button>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                              
                             
                           </div>

                            <div class="clearfix"></div>
                           <div id="changePassword" class="profile-edit tab-pane fade">

                               <form action="" id="changePasswordForm" method="post">
                               <div class="row">
                                   <div class="col-md-12 col-sm-12 col-xs-12">
                                       <label>Current Password <span class="required">*</span></label>
                                       <input type="password" name="current_password" value=""  class="form-control margin-bottom-20">
                                       <?php echo form_error('current_password','<div class="required">','</div>') ?>
                                   </div>
                                   <div class="col-md-12 col-sm-12 col-xs-12">
                                       <label>New Password <span class="required">*</span></label>
                                       <input type="password" name="newpassword" class="form-control margin-bottom-20" id="newpassword">
                                       <?php echo form_error('newpassword','<div class="required">','</div>') ?>
                                   </div>
                                   <div class="col-md-12 col-sm-12 col-xs-12">
                                       <label>Confirm Password<span class="req  uired">*</span></label>
                                       <input type="password" name="confirm_password" class="form-control margin-bottom-20" value="">
                                       <?php echo form_error('confirm_password','<div class="required">','</div>') ?>
                                   </div>
                               </div>
                               <div class="clearfix"></div>
                               <div class="row">
                                   <div class="col-md-4 col-sm-4 col-xs-12 text-right">
                                       <input type="submit" class="btn btn-theme btn-sm" name="changePassword" value="Change Password">
                                       <!-- <button class="btn btn-theme btn-sm" name="changePassword" type="submit">Change Password</button> -->
                                   </div>
                               </div>
                               </form>
                           </div>
                        </div>
                     </div>
                     <!-- Row End -->
                  </div>
                  <!-- Middle Content Area  End -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
      </div>
    <?php 
      $msg = $this->session->flashdata('msg'); 
      $btn = $this->session->flashdata('btn'); 
    ?>
<script src="<?php echo site_url('assest/front/js/jquery.validate.min.js')?>"></script>
<script>
   jQuery(document).ready(function($) {
      if ('<?php echo $msg ?>' != "") {
         $.toaster({ priority : '<?php echo $btn ?>',  message : '<?php echo $msg ?>'}); 
      }

     $('#changePasswordForm').validate({
            rules:{
                current_password:{
                    required:true
                    //,remote:'<?php echo site_url('user/checkpassword')?>'
                },
                newpassword:{required:true},
                confirm_password:{
                  required:true,
                  equalTo:'#newpassword'
               }
            },
            messages:{
                'current_password':{
                    required:'Current password is required',
                },
                'newpassword':'New Password is required',
                'confirm_password':{
                    required:'Confirm Password is required',
                    equalTo:'Enter Confirm Password Same as Password'
                }
            }
        });
   });
</script>