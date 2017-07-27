<script src="<?php echo site_url('assest/admin-lte/js/jquery.toaster.js')?>"></script>
<style>
   .category-grid-box-1 .image img{height: 350px;}
</style>
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
                    <div class="col-md-12 col-sm-12 col-xs-12">
                     <!-- Row -->
                     <div class="row">

                        <div class="posts-masonry" style="position: relative; height: 1572.9px;">
                         <?php 
                              if (isset($results) && count($results)) {
                                    foreach($results as $key => $data) {
                                        if ($isArchived == 1 && $data->is_archived == 0) {
                                            continue;
                                        } else if ($isArchived == 0 && $data->is_archived == 1) {
                                            continue;
                                        }
                                       $photo_url = site_url('assest/upload/adpost_photos/' . $data->adpost_id . '/' . $data->save_name);

                           ?>
                      <div class="col-md-6 col-sm-6 col-xs-12" style="position: absolute; left: 0px; top: 0px;">
                              <div class="category-grid-box-1">
                                 <div class="image">
                                    <img class="img-responsive" src="<?php echo $photo_url ?>" alt="<?php echo $data->adtitle; ?>">
                                    <div class="ribbon popular"></div>
                                    <div class="price-tag">
                                       <div class="price"><span><?php echo $data->price ?></span></div>
                                    </div>
                                 </div>
                                 <div class="short-description-1 clearfix">
                                    <div class="category-title"> <span><a href="#"><?php echo $data->category_name ?></a></span> </div>
                                    <h3><a href="<?php echo site_url('adpost/view/' . $data->id) ?>" title=""><?php echo $data->adtitle; ?></a></h3>
                                 </div>
                                 <div class="ad-info-1">
                                    <ul>
                                       <li> <i class="fa fa-map-marker"></i><a href="#"><?php echo $data->city_name ?></a> </li>
                                       <li> <i class="fa fa-clock-o"></i><?php echo date('d-m-Y',strtotime($data->created_on)) ?></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                      <?php         
                           }
                        }
         //var_dump($results);
          ?>
                        </div>
                        <!-- Ads Archive End -->  
                        <div class="clearfix"></div>
                     </div>
                     <!-- Row End -->
                  </div>
                   <div class="col-md-12 col-xs-12 col-sm-12">
                     <?php echo $links; ?>            
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
<script>
   jQuery(document).ready(function($) {
      if ('<?php echo $msg ?>' != "") {
         $.toaster({ priority : '<?php echo $btn ?>',  message : '<?php echo $msg ?>'}); 
      }
   });
</script>