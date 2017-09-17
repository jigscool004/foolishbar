<script src="<?php echo site_url('assest/front/js/jquery.validate.min.js') ?>"></script>
<script src="<?php echo site_url('assest/admin-lte/js/jquery.toaster.js') ?>"></script>
<script src="<?php echo site_url('assest/admin-lte/js/bootbox.min.js'); ?>"></script>
<style>
    .row {margin-bottom: 10px;}
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
    .deleteImage {
        cursor: pointer;
        margin-top: 4px;
        padding: 5px;
        position: absolute;
        right: 15px;
        top: 11px;
    }
    .imageWrapper{padding:10px;}
    .uploadedPhotosContainer{min-height: 150px;}
</style>
<div class="main-content-area clearfix">
    <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
    <section class="section-padding  gray ">
        <!-- Main Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                    <!-- end post-padding -->
                    <div class="post-ad-form postdetails">
                        <div class="heading-panel">
                            <h3 class="main-title text-left">
                                Upload Ad Photos
                            </h3>
                        </div>
                        <?php echo form_open_multipart(site_url('adpost/do_upload/' . $adpost_id), 'class="adpost" id="adpostFrom"'); ?>
                        <form  class="submit-form">
                            <!-- Title  -->
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">                              	
                                    <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                                        <input type="file" name="photos[]" > 
                                        <?php echo form_error('photos') ?>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 uploadedPhotosContainer">      	
                                    <?php
                                    $uploadedImageCount = 0;
                                    if (isset($adImagesArr) && count($adImagesArr) > 0) {

                                        foreach ($adImagesArr as $key => $adImage) {
                                            $uploadedImageCount++;
                                            ?>
                                            <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12 imageWrapper" id='imageWrapper-<?php echo $adImage->id ?>'>
                                                <div class="image">
                                                    <button type="button" class="deleteImage pull-right btn btn-xs btn-danger" id="<?php echo $adImage->id ?>">X</button>
                                                    <img class="img-responsive img-thumbnail" src="<?php echo site_url('assest/upload/adpost_photos/' . $folderName . '/' . $adImage->save_name); ?>" alt="Tour Package">
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>	
                                </div>
                            </div> 
                            <!-- <button class="btn btn-theme pull-right" name="yt2" style="margin-left:10px">Upload & View</button> -->

                            <?php
                            $btnDisabled = $uploadedImageCount >= 5 ? 'disabled = "disabled"' : '';
                            $isDisplay = $uploadedImageCount < 2 ? 'style= "display:none;margin-left:10px;"' : 'style= "margin-left:10px;"';
                            ?>
                            <a href="<?php echo site_url('adpost/view/' . $adpost_id) ?>" class='btn btn-theme pull-right completeStep' <?php echo $isDisplay; ?>>Complete</a>
                            <input type="submit" <?php echo $btnDisabled; ?> class="btn btn-theme pull-right submitBtn" name="yt1" value="Upload">

                        </form>
                    </div>
                    <!-- end post-ad-form-->
                </div>
                <!-- end col -->
            </div>
            <!-- Main Container End -->
    </section>
    <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->
    <!-- =-=-=-=-=-=-= FOOTER =-=-=-=-=-=-= -->

    <!-- =-=-=-=-=-=-= FOOTER END =-=-=-=-=-=-= -->
</div>


<script>
    jQuery(document).ready(function ($) {
        var data = '<?php echo $this->session->flashdata('message') ?>';
        if (data) {
            $.toaster({priority: '<?php echo $this->session->flashdata('type') ?>', message: '<?php echo $this->session->flashdata('message') ?>'});
        }

        var folderName = '<?php echo $folderName; ?>';



        $('#adpostFrom').validate({
            rules: {
                "photos[]": {
                    required: true,
                }
            },
            messages: {
                "photos[]": "File must be JPG, GIF or PNG, less than 1MB"
            },
            submitHandler: function (form) {
                var $fileUpload = $("input[type='file']");
                if (parseInt($fileUpload.get(0).files.length) > 5) {
                    bootbox.alert({
                        message: "You can only upload a maximum of 5 photos",
                    });
                    return false;
                }
                $(".submitBtn").val('processing...').attr('disabled', 'disabled');
                postData = new FormData(form);
                console.log(postData);
                $.ajax({
                    url: form.action,
                    type: 'POST',
                    data: postData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                        $("input[type='file']").val('');
                        $(".submitBtn").val('Upload').removeAttr('disabled');
                        if (data.success != undefined) {
                            imageString = '';
                            var path = '<?php echo base_url(); ?>';
                            $.each(data.success, function (key, imageInfo) {
                                imageString += '<div class="imageWrapper col-md-3 col-lg-3 col-xs-12 col-sm-12" id="imageWrapper-' + imageInfo.id + '"><div class="image">';
                                imageString += '<button type="button" class="deleteImage pull-right btn btn-xs btn-danger" id="' + imageInfo.id + '">X</button>';
                                imageString += '<img class="img-responsive img-thumbnail" src="' + path + 'assest/upload/adpost_photos/' + folderName + '/' + imageInfo.file_name + '" alt="Tour Package">';
                                imageString += '</div></div>';
                            });

                            if ($.trim($(".uploadedPhotosContainer").html()) == "") {
                                $(".uploadedPhotosContainer").html(imageString);
                            } else {
                                $(".uploadedPhotosContainer").append(imageString);
                            }

                            uploadedImageCount = $('.imageWrapper').length;
                            if (uploadedImageCount > 5) {
                                $(".submitBtn").attr('disabled', 'disabled');
                            }

                            if (uploadedImageCount >= 2) {
                                $('.completeStep').show();
                            } else {
                                $('.completeStep').hide();
                            }

                        }

                        if (data.error != undefined) {
                            var errorMsgString = '';
                            for (var i = 0, len = data.error.length; i < len; i++) {
                                if (data.error[i] != "") {
                                    errorMsgString += data.error[i] + "<br>";
                                }
                            }
                            $.toaster({priority: 'danger', message: errorMsgString});
                        }
                        //<div class="image"> <img class="img-responsive" src="images/posting/car-4.jpg" alt="Tour Package"> </div>
                    }
                });
            }

        });

        $('#adpostFrom').on('click','.deleteImage', function () {
           console.log("click");
            var id = $(this).attr('id');
            bootbox.confirm({
                message: "Are you sure?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if (result == true) {
                        $.ajax({
                            'type': 'POST',
                            'url': '<?php echo site_url('adpost/delete_image'); ?>/' + id,
                            'data': {
                                ajax: 1,
                                folderName: folderName
                            },
                            'success': function (data) {
                                if (data == 1) {
                                    $.toaster({priority: 'success', message: 'Image has been deleted.'});
                                    $("#imageWrapper-" + id).hide('slow', function () {
                                        $(this).remove();
                                    });
                                    uploadedImageCnt = $('.imageWrapper').length - 1;
                                    if (uploadedImageCnt < 5) {
                                        $(".submitBtn").removeAttr('disabled');
                                    }

                                    console.log(uploadedImageCnt);
                                    if (uploadedImageCnt >= 2) {
                                        $('.completeStep').show();
                                    } else {
                                        $('.completeStep').hide();
                                    }
                                } else {
                                    $.toaster({priority: 'danger', message: 'Something wrong happend. Please try again.'});
                                }
                            }
                        })
                    }
                }
            });
        });
    });

</script>