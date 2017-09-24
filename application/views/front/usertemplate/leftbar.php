<style>
   .btn-file {
    position: relative;
    overflow: hidden;
    padding: 5px !important;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
#profilepic{width: 360px;height: 350px;}
</style>
<?php 
   $data = getUserDetails();

   $userProfilePic = FCPATH. 'assest/upload/user_profile/' . $data->profile_pic;
   if (!file_exists($userProfilePic)) {
      $userProfilePic = site_url('assest/upload/user_profile/default.svg' );
   } else {
      $userProfilePic = site_url('assest/upload/user_profile/' . $data->profile_pic );
   }
 ?>
<div class="col-md-4 col-sm-12 col-xs-12 leftbar-stick blog-sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
<div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static;"><div class="user-profile">
                        <a href="<?php echo site_url('user/profile') ?>">
                        <img id='profilepic' alt="" src="<?php echo $userProfilePic ?>" class='img-thumbnail span-xs'></a>
                        <form id="change-profile" method='POST'>
                           <span class="btn btn-default btn-file btn-xs">
                           <i class="icon-box-icon flaticon-photo-camera" style="font-size:14px;"></i> &nbsp;&nbsp;Browse
                              <input type="file" name="upload" id="upload">
                           </span>
                              
                        </form>
                        <div class="profile-detail">
                           <h6><?php echo $data->name ?></h6>
                           <ul class="contact-details">
                              
                              <li>
                                 <i class="fa fa-envelope"></i><?php echo $data->email; ?>
                              </li>
                              <li>
                                 <i class="fa fa-phone"></i> +91-<?php echo $data->mobile_no; ?>
                              </li>
                           </ul>
                        </div>

                        <ul>
                           <?php
                                //
                              $sidebarArr = [
                                  'Dashboard' => 'user/dashboard',
                                  'Profile & Setting'  => 'user/profile',
                                  'My Ads <span class="badge">'.frontDashboardCounter() .'</span>' => 'user/myads',
                                  'Favourites Ads  <span class="badge">'.frontDashboardCounter('wishlist') .'</span>' => 'user/wishlist',
                                  'Archives Ads  <span class="badge">'.frontDashboardCounter('archived') .'</span>' => 'user/archived_ads',
                                  'Messages' => 'user/messages',
                                  'Logout' => 'site/logout',
                              ];


                              foreach ($sidebarArr as $name => $link) {

                                 echo '<li '. (uri_string() == $link ? "class='active'" : "").'>';
                                    echo anchor(site_url($link),$name);
                                 echo '</li>';
                              }

                            ?>
                        </ul>
                     </div>
                     </div>                     
                     
                     </div>
<script>
   jQuery(document).ready(function($) {
      $('#change-profile').on('submit',function(e) {
          e.preventDefault();
          
          $.ajax({
            url : '<?php echo site_url('user/changeProfile')?>',
            type : 'POST',
            data : new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            success : function(data) {
               if (data == 'success') {
                  fileName = $("#upload").val();
                  $('#profilepic').attr('src','<?php echo base_url() . 'assest/upload/user_profile/'?>' + fileName);
               }
            }
          });
      });

      $('#upload').on('change',function() {$('#change-profile').trigger('submit');});
   });

</script>