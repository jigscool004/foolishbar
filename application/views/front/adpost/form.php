<script src="<?php echo site_url('assest/front/js/jquery.validate.min.js')?>"></script>
<style>
	.row {margin-bottom: 10px;}
</style>

<div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding  gray ">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
                     <!-- end post-padding -->
                     <div class="post-ad-form postdetails">
                        <div class="heading-panel">
                           <h3 class="main-title text-left">
                              Post Your Ad
                           </h3>
                        </div>
                        <?php echo  form_open_multipart($formAction, 'class="adpost" id="adpostFrom"'); ?>
                        <form  class="submit-form">
                           <!-- Title  -->
                           <div class="row">
                              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                              	 <?php  
                              	 	echo form_label('Title <div class="required">*</div>','adtitle',['class' => 'control-label']);
                              	 	echo form_input([
                              	 			'name' => 'adtitle',
                              	 			'class' => 'form-control',
                              	 			'id' => 'adtitle',
                                          'value' => set_value('adtitle',$adpost_data->adtitle),
                              	 			'placeholder' => 'Enter title for your mobile'
                              	 		]);

                                    echo form_error('adtitle','<div class="requiredMsg">','</div>');
                              	 ?>
                              </div>
                           </div>
                           <div class="row">
                              <!-- Category  -->
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              	<?php 
                              		echo form_label('Category <div class="required">*</div>','category',['class' => 'control-label']);
                              	 	echo form_dropdown('category',$mobileCategoryArr,set_value('category',$adpost_data->category),[
                              	 			'class' => 'form-control',			
                              	 		]);
                                    echo form_error('category','<div class="requiredMsg">','</div>');
                              	 ?>
                              </div>
                              <!-- Price  -->
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                              	<?php 
                              		$modelArr = ['' => '-Select','Other'];
                              		echo form_label('Model','model',['class' => 'control-label']);
                              	 	echo form_dropdown('model',$modelArr,set_value('model',$adpost_data->model),[
                              	 			'class' => 'form-control',			
                              	 		]);
                                    echo form_error('model','<div class="requiredMsg">','</div>');
                              	 ?>
                                 
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                              	 <?php  
                              	 	echo form_label('Price <div class="required">*</div>','price',['class' => 'control-label']);
                              	 	echo form_input([
                              	 			'name' => 'price',
                              	 			'class' => 'form-control',
                              	 			'id' => 'price',
                              	 			'placeholder' => 'Enter your mobile price',
                                          'value' => set_value('price',$adpost_data->price),
                              	 		]);

                                    echo form_error('price','<div class="requiredMsg">','</div>');
                              	 ?>
                              </div>
                           </div>
                           <!-- end row -->
                           <!-- Image Upload  -->
                           <!-- <div class="row">
                              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                              	<?php /*echo form_label('Upload Photos <div class="required">*</div>','photos',['class' => 'control-label']);

                              		echo form_upload([
                              				'name' => 'photos',
                              				'multiple' => 'multiple',
                              				'class' => 'form-control',
                              				'id' => 'photos'
                              			]);*/
                              	?>

                                 <label class="control-label"><small>Photos for your ad Please add images of your ad. (350x450)</small></label>
                                 <div id="dropzone" class="dropzone"></div>
                              </div>
                           </div> -->
                           <!-- end row -->
                           <!-- Ad Description  -->
                           <div class="row">
                              <div class="col-md-12 col-lg-12 col-xs-12  col-sm-12">
                              	 <?php  
                              	 	echo form_label('Ad Description <div class="required">*</div>','ad_desc',['class' => 'control-label']);
                              	 	echo form_textarea([
                              	 			'name' => 'ad_desc',
                              	 			'class' => 'form-control',
                              	 			'id' => 'ad_desc',
                              	 			'placeholder' => 'Enter your mobile short description',
                                          'value' => set_value('ad_desc',$adpost_data->ad_desc),
                              	 		]);
                                    echo form_error('ad_desc','<div class="requiredMsg">','</div>');
                              	 ?>
                              </div>
                           </div>
                           <!-- end row -->
                           <!-- Ad Tags  -->
                           <div class="row">
                              <div class="col-md-12 col-lg-12 col-xs-12  col-sm-12">
                               <?php  
                              	 	echo form_label('Ad Tags <div class="required">*</div>','ad_tag',['class' => 'control-label']);
                              	 	echo form_input([
                              	 			'name' => 'ad_tag',
                              	 			'class' => 'form-control',
                              	 			'id' => 'ad_tag',
                                          'value' => set_value('ad_tag',$adpost_data->ad_tag),
                              	 			'placeholder' => 'Enter your mobile related tags here to it is search first'
                              	 		]);
                                    echo form_error('ad_tag','<div class="requiredMsg">','</div>');
                              	 ?> 
                              </div>
                           </div>
                           
                           <div class="row">
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                               	<?php  
                              	 	echo form_label('Your Name <div class="required">*</div>','adpost_username',['class' => 'control-label']);
                              	 	echo form_input([
                              	 			'name' => 'adpost_username',
                              	 			'class' => 'form-control',
                              	 			'id' => 'adpost_username',
                              	 			'placeholder' => 'Enter your name',
                                          'value' => set_value('adpost_username',$adpost_data->adpost_username)
                              	 		]);
                                    echo form_error('adpost_username','<div class="requiredMsg">','</div>');
                              	 ?> 
                              </div>
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                               	<?php  
                              	 	
                              	 	echo form_label('Your Mobile no <div class="required">*</div>','adpost_user_mobile',['class' => 'control-label']);
                              	 	echo form_input([
                              	 			'name' => 'adpost_user_mobile',
                              	 			'class' => 'form-control',
                              	 			'id' => 'adpost_user_mobile',
                              	 			'placeholder' => 'Enter your name',
                                          'value' => set_value('adpost_user_mobile',$adpost_data->adpost_user_mobile)
                              	 		]);
                              	 	
                                    echo form_error('adpost_user_mobile','<div class="requiredMsg">','</div>');
                              	 ?> 
                              </div>
                           </div>
						   <div class="row">
                              <div class="col-md-12 col-lg-12 col-xs-12  col-sm-12">
                               <?php  
                              	 	echo form_label('City <div class="required">*</div>','city',['class' => 'control-label']);
                              	 	echo form_dropdown('city',$cityArr,set_value('city',$adpost_data->city),[
                              	 			'class' => 'form-control city',
                              	 		]);                              	 
                                    echo form_error('city','<div class="requiredMsg">','</div>');
                              	 ?> 
                              </div>
                           </div>
                            <div class="row">
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                               	<?php  
                               		$locationArr = ['' => '-Select-'];
                              	 	echo form_label('Location <div class="required">*</div>','location',['class' => 'control-label']);
                              	 		echo form_dropdown('location',$locationArr,set_value('location'),[
                              	 			'class' => 'form-control',
                              	 		]);
                                       echo form_error('location','<div class="requiredMsg">','</div>');
                              	 ?> 
                              </div>
                              <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                               	<?php  
                              	 	
                              	 	echo form_label('Zipcode <div class="required">*</div>','zipcode',['class' => 'control-label']);
                              	 	echo form_input([
                              	 			'name' => 'zipcode',
                              	 			'class' => 'form-control',
                              	 			'id' => 'zipcode',
                              	 			'placeholder' => 'Enter zipcode',
                                          'value' => set_value('zipcode',$adpost_data->zipcode)
                              	 		]);	
                                    echo form_error('zipcode','<div class="requiredMsg">','</div>');
                              	 ?> 
                              </div>
                           </div>	 
                           <!-- Select Package  -->
                        
                           <!-- Featured Ad  -->
                           
                           <!-- end row -->
                           <button class="btn btn-theme" name="postAd">Post My Ad</button>
                        </form>
                     </div>
                     <!-- end post-ad-form-->
                  </div>
                  <!-- end col -->
                  <!-- Right Sidebar -->
                  <div class="col-md-4 col-xs-12 col-sm-12">
                     <!-- Sidebar Widgets -->
                     <div class="blog-sidebar">
                        <!-- Categories --> 
                        <div class="widget">
                           <div class="widget-heading">
                              <h4 class="panel-title"><a>Saftey Tips </a></h4>
                           </div>
                           <div class="widget-content">
                              <p class="lead">Posting an ad on <a href="#">AdForest.com</a> is free! However, all ads must follow our rules:</p>
                              <ol>
                                 <li>Make sure you post in the correct category.</li>
                                 <li>Do not post the same ad more than once or repost an ad within 48 hours.</li>
                                 <li>Do not upload pictures with watermarks.</li>
                                 <li>Do not post ads containing multiple items unless it's a package deal.</li>
                                 <li>Do not put your email or phone numbers in the title or description.</li>
                                 <li>Make sure you post in the correct category.</li>
                                 <li>Do not post the same ad more than once or repost an ad within 48 hours.</li>
                                 <li>Do not upload pictures with watermarks.</li>
                                 <li>Do not post ads containing multiple items unless it's a package deal.</li>
                              </ol>
                           </div>
                        </div>
                        <!-- Latest News --> 
                     </div>
                     <!-- Sidebar Widgets End -->
                  </div>
                  <!-- Middle Content Area  End --><!-- end col -->
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
         <!-- =-=-=-=-=-=-= FOOTER =-=-=-=-=-=-= -->
         
         <!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
      </div>


      <script>
      	jQuery(document).ready(function($) {

            $('#adpostFrom').validate({
            /*    errorPlacement: function(error, element) {
                   //console.log(element.attr('name'));
                   if (element.attr('name') === 'category') {
                        error.insertAfter('span#select2-category-mo-container');
                   } else {
                        error.insertAfter(element);
                   }
                },*/
                rules:{
                    adtitle:{
                        required:true,
                   /*     minlength:20*/
                    },
                    category:{
                        required:true
                    },
                    model:{
                        required:true
                    },
                    price:{
                        required:true,
                        number:true
                    },
                    ad_desc:{
                        required:true,
                        minlength:100
                    },
                    adpost_username:{
                        required:true
                    },
                    adpost_user_mobile:{
                        required:true,
                        number:true
                    },
                    city:{required:true},
                    location:{required:true},
                    zipcode:{required:true}
                },
                messages:{
                  adtitle:{
                     required:'Ad title field is required',
                     minlength:'Please enter minimum 20 character in Ad title.'
                  },
                  category:{
                     required:'Category field is required'
                  },
                  model:{
                     required:'Mobile model field is required',
                  },
                  price:{
                     required:'Mobile price field  is required',
                     number:'Mobile price is allowed only in numeric'
                  },
                  ad_desc:{
                     required:'Ad description is required',
                     minlength:'Please enter minimum 50 character in Ad description.'
                  },
                  adpost_username:{
                     required:'Name is required'
                  },
                  adpost_user_mobile:{
                     required:'Mobile number is required',
                     number:'Mobile number is allowed in only numeric'
                  },
                  city:{required:'City is required'},
                  location:{required:'Location is required'},
                  zipcode:{required:'Zipcode is required'},
                }
            });
      		$('select[name="city"]').on('change',function(e,data){
      			
               if (data != undefined) {
                  var dataString = data;
               } else {
                  var dataString = {
                     'city_id' :  $(this).val()
                  }
               }

               $.ajax({
      				url:'<?php echo site_url('adpost/getLocation');?>',
      				data:dataString,
      				cache:false,
      				success:function(data) {
      					if (data != "") {
      						$('select[name="location"]').html(data);	
      					}
      				}
      			});
      		});



            if ('<?php echo set_value('city',$adpost_data->city);?>') {
                var dataString = {
                    location_id : '<?php echo set_value("location",$adpost_data->location)?>',
                    city_id : '<?php echo set_value("city",$adpost_data->city)?>',
                };
                $('select[name="city"]').trigger('change',dataString);
            }

      		$('select[name="location"]').on('change',function(){
      			var id = $(this).val();
      			$.ajax({
      				url:'<?php echo site_url('adpost/getZipcode');?>',
      				data:'location_id='+ id,
      				cache:false,
      				success:function(data) {
      					if (data != "") {
      						$('#zipcode').val(data);	
      					}
      				}
      			});
      		});
      	});

      </script>