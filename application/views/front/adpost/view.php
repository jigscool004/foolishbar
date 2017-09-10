<link rel="stylesheet" href="<?php echo site_url('assest/front/css/owl.carousel.css') ?>">
<link rel="stylesheet" href="<?php echo site_url('assest/front/css/owl.theme.css') ?>">
<link rel="stylesheet" href="<?php echo site_url('assest/front/css/message.style.css') ?>">
<script src="<?php echo site_url('assest/front/js/jquery.validate.min.js') ?>"></script>
<script src="<?php echo site_url('assest/admin-lte/js/jquery.toaster.js') ?>"></script>
<script src="<?php echo site_url('assest/admin-lte/js/bootbox.min.js'); ?>"></script>
<script src="<?php echo site_url('assest/admin-lte/js/jquery-migrate.min.js'); ?>"></script>

<script src="<?php echo site_url('assest/front/js/slide.js'); ?>"></script>
<style>
    .row {
        margin-bottom: 10px;
    }

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

    .imageWrapper {
        padding: 10px;
    }

    .uploadedPhotosContainer {
        min-height: 150px;
    }
</style>
<div class="small-breadcrumb">
    <div class="container">
        <div class=" breadcrumb-link">
            <ul>
                <li><a href="<?php echo site_url(); ?>">Home</a></li>
                <li>
                    <a href="<?php echo site_url('site/listing/' . $adpost_dataArr->category); ?>"><?php echo $adpost_dataArr->category_name; ?></a>
                </li>
                <li><a href="#" class="active"><?php echo $adpost_dataArr->adtitle; ?></a></li>
            </ul>
        </div>
    </div>
</div>
<?php $publish_date = date('d M Y', strtotime($adpost_dataArr->created_on)) ?>
<div class="main-content-area clearfix">
    <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
    <section class="section-padding error-page pattern-bgs gray ">
        <!-- Main Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">
                <!-- Middle Content Area -->
                <div class="col-md-8 col-xs-12 col-sm-12">
                    <!-- Single Ad -->
                    <div class="single-ad">
                        <!-- Title -->
                        <div class="ad-box">
                            <h1><?php echo $adpost_dataArr->adtitle; ?></h1>
                            <div class="short-history">
                                <ul>
                                    <li>Published on: <b><?php echo $publish_date ?></b></li>
                                    <li>Category: <b><a href="#"><?php echo $adpost_dataArr->category_name; ?></a></b>
                                    </li>
                                    <li>Location: <b><?php echo $adpost_dataArr->area; ?></b></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Listing Slider  -->
                        <div class="flexslider single-page-slider">
                            <div class="flex-viewport">
                                <ul class="slides slide-main">
                                    <?php foreach ($photos_dataArr as $key => $photo) {
                                        $activeclass = $key == 0 ? 'flex-active-slide' : '';
                                        ?>
                                        <li class="<?php echo $activeclass ?>"><img alt=""
                                                                                    src="<?php echo site_url('assest/upload/adpost_photos/' . $adpost_dataArr->adpost_id . '/' . $photo->save_name); ?>"
                                                                                    title=""></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="flexslider" id="carousels">
                            <div class="flex-viewport">
                                <ul class="slides slide-thumbnail">
                                    <?php foreach ($photos_dataArr as $key => $photo) {
                                        $activeclass = $key == 0 ? 'flex-active-slide' : '';
                                        ?>
                                        <li class="<?php echo $activeclass; ?>">
                                            <img alt="" draggable="false"
                                                 src="<?php echo site_url('assest/upload/adpost_photos/' . $adpost_dataArr->adpost_id . '/' . $photo->save_name); ?>"
                                                 title="">
                                        </li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                        <!-- Share Ad  -->

                        <div class="clearfix"></div>
                        <!-- Short Description  -->
                        <div class="ad-box">
                            <div class="short-features">
                                <!-- Heading Area -->
                                <div class="heading-panel">
                                    <h3 class="main-title text-left">
                                        Description
                                    </h3>
                                </div>
                                <div class="col-sm-3 col-md-3 col-xs-12 no-padding">
                                    <span><strong>Brand</strong> :</span> <?php echo $adpost_dataArr->category_name; ?>
                                </div>
                                <div class="col-sm-3 col-md-3 col-xs-12 no-padding">
                                    <span><strong>Model</strong> :</span> Other
                                </div>
                                <div class="col-sm-3 col-md-3 col-xs-12 no-padding">
                                    <span><strong>Date</strong> :</span> <?php echo $publish_date ?>
                                </div>
                                <div class="col-sm-3 col-md-3 col-xs-12 no-padding">
                                    <span><strong>Price</strong> :</span> <?php echo $adpost_dataArr->price ?>
                                </div>
                            </div>
                            <!-- Short Features  -->

                            <!-- Related Image  -->
                            <div class="ad-related-img">
                                <img class="img-responsive center-block" alt="" src="images/car-img1.png">
                            </div>
                            <!-- Ad Specifications -->
                            <div class="specification">
                                <!-- Heading Area -->
                                <div class="heading-panel">
                                    <h3 class="main-title text-left">
                                        Specifications
                                    </h3>
                                </div>
                                <p>
                                    <?php echo $adpost_dataArr->ad_desc ?>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <!-- Right Sidebar -->
                <div class="col-md-4 col-xs-12 col-sm-12">
                    <!-- Sidebar Widgets -->
                    <div class="sidebar">
                        <!-- Contact info -->
                        <div class="contact white-bg">
                            <!-- Email Button trigger modal -->
                            <!--  <button data-target=".price-quote" data-toggle="modal" class="btn-block btn-contact contactEmail">Contact Seller Via Email</button> -->
                            <!-- Email Modal -->
                            <button data-last="111111X" class="btn-block btn-contact contactPhone number">
                                +91-<?php echo $adpost_dataArr->adpost_user_mobile; ?></button>
                        </div>
                        <!-- Price info block -->
                        <div class="ad-listing-price">
                            <p>Rs. <?php echo $adpost_dataArr->price; ?></p>
                        </div>
                        <!-- User Info -->
                        <div class="white-bg user-contact-info">
                            <div class="user-info-card">
                                <div class="user-photo col-md-4 col-sm-3  col-xs-4">
                                    <img alt="" src="images/users/3.jpg">
                                </div>
                                <div class="user-information no-padding col-md-8 col-sm-9 col-xs-8">
                                 <span class="user-name"><a href="profile.html" class="hover-color">
                                  <?php echo $adpost_dataArr->adpost_username ?></a></span>
                                    <div class="item-date">
                                        <span class="ad-pub">Published on: <?php echo $publish_date ?></span><br>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="ad-listing-meta">
                                <ul>
                                    <li>Ad Id: <span class="color"><?php echo $adpost_dataArr->adpost_id ?></span></li>
                                    <li>Categories: <span
                                                class="color"><?php echo $adpost_dataArr->category_name; ?></span></li>
                                    <li>Visits: <span class="color">9</span></li>
                                    <li>Location: <span
                                                class="color"><?php echo $adpost_dataArr->city_name . " " . $adpost_dataArr->area ?></span>
                                    </li>
                                    <li>
                                        <div class="pull-right">
                                            <input type="hidden" name="" readonly="readonly" id='wishlistId'
                                                   value="<?php echo isset($wishList['id']) ? $wishList['id'] : '' ?>">
                                            <?php
                                            if (isset($wishList) && count($wishList) > 0) {
                                                ?>
                                                <span class="shareTip wishlistAdded" title=""
                                                      data-id="<?php echo $adpost_dataArr->id ?>"
                                                      data-toggle="tooltip"
                                                      data-original-title="Remove Wishlist" id="wishList">
                                                  <i class="fa fa-heart"></i>
                                              </span>
                                            <?php } else { ?>
                                                <span class="shareTip" title=""
                                                      data-toggle="tooltip"
                                                      data-original-title="Add Wishlist" id="wishList">
                                                  <i class="fa fa-heart"></i>
                                              </span>
                                            <?php } ?>
                                            <span class="shareTip" id="addClass"  title=""
                                               data-toggle="tooltip"
                                               data-original-title="Send Message">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <?php if (checkedLoggedinFront() && $adpost_dataArr->adpost_user_id == $this->session->userdata('id')) : ?>
                                        <li>
                                            <a href="<?php echo site_url('adpost/upload_photos/' . $adpost_dataArr->id) ?>"
                                               data-toggle="tooltip" title="Upload photos"> <i aria-hidden="true"
                                                                                               class="glyphicon glyphicon-camera"></i>
                                            </a>
                                            <a href="<?php echo site_url('adpost/edit/' . $adpost_dataArr->id) ?>"
                                               data-toggle="tooltip" title="Edit">
                                                <i aria-hidden="true" class="glyphicon glyphicon-edit"></i></a>
                                            <?php
                                            if ($adpost_dataArr->status == 0) {
                                                $statusLabel = 'SOLD';
                                                $status = 1;
                                                $statusTooltip = 'Mark as Unsoled';
                                            } else {
                                                $statusLabel = 'UNSOLED';
                                                $status = 0;
                                                $statusTooltip = 'Mark as Sold';
                                            }

                                            if ($adpost_dataArr->is_archived == 0) {
                                                $archiveLabel = 'Un-Archived';
                                                $archive = 1;
                                                $archiveTooltip = 'Mark as Archived';
                                            } else {
                                                $archiveLabel = 'Archived';
                                                $archive = 0;
                                                $archiveTooltip = 'Mark as Unarchive';
                                            }
                                            ?>
                                            <a href="<?php echo site_url('adpost/updatestatus/' . $adpost_dataArr->id) ?>"
                                               data-toggle="tooltip" title="<?php echo $statusTooltip ?>"
                                               data-fld='<?php echo $status ?>' class='manageStatus' id="manageStatus">
                                                <?php echo $statusLabel; ?>
                                            </a> |
                                            <a href="<?php echo site_url('adpost/archiveAds/' . $adpost_dataArr->id) ?>"
                                               data-toggle="tooltip" title="<?php echo $archiveTooltip ?>"
                                               data-fld='<?php echo $archive ?>' class='manageStatus'
                                               id="manageArchived">
                                                <?php echo $archiveLabel; ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Widgets End -->
            </div>
            <!-- Middle Content Area  End -->
        </div>
        <!-- Row End -->
</div>
<!-- Main Container End -->
</section>
</div>


<div class="popup-box chat-popup" id="qnimate">
    <div class="popup-head">
        <div class="popup-head-left pull-left"><img src="" alt="iamgurdeeposahan"></div>
        <div class="popup-head-right pull-right">
            <button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button"><i
                        class="glyphicon glyphicon-off"></i></button>
        </div>
    </div>
    <div class="popup-messages">
        <div class="direct-chat-messages">


            <div class="chat-box-single-line">
                <abbr class="timestamp">October 8th, 2015</abbr>
            </div>


            <!-- Message. Default to the left -->
            <div class="direct-chat-msg doted-border">
                <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">Osahan</span>
                </div>
                <!-- /.direct-chat-info -->
                <img alt="message user image"
                     src="http://bootsnipp.com/img/avatars/bcf1c0d13e5500875fdd5a7e8ad9752ee16e7462.jpg"
                     class="direct-chat-img"><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    Hey bro, how’s everything going ?
                </div>
                <div class="direct-chat-info clearfix">
                    <span class="direct-chat-timestamp pull-right">3.36 PM</span>
                </div>
                <div class="direct-chat-info clearfix">
						<span class="direct-chat-img-reply-small pull-left">

						</span>
                    <span class="direct-chat-reply-name">Singh</span>
                </div>
                <!-- /.direct-chat-text -->
            </div>
            <!-- /.direct-chat-msg -->


            <div class="chat-box-single-line">
                <abbr class="timestamp">October 9th, 2015</abbr>
            </div>


            <!-- Message. Default to the left -->
            <div class="direct-chat-msg doted-border">
                <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">Osahan</span>
                </div>
                <!-- /.direct-chat-info -->
                <img alt="iamgurdeeposahan"
                     src="http://bootsnipp.com/img/avatars/bcf1c0d13e5500875fdd5a7e8ad9752ee16e7462.jpg"
                     class="direct-chat-img"><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    Hey bro, how’s everything going ?
                </div>
                <div class="direct-chat-info clearfix">
                    <span class="direct-chat-timestamp pull-right">3.36 PM</span>
                </div>
                <div class="direct-chat-info clearfix">
                    <img alt="iamgurdeeposahan"
                         src="http://bootsnipp.com/img/avatars/bcf1c0d13e5500875fdd5a7e8ad9752ee16e7462.jpg"
                         class="direct-chat-img big-round">
                    <span class="direct-chat-reply-name">Singh</span>
                </div>
                <!-- /.direct-chat-text -->
            </div>
            <!-- /.direct-chat-msg -->
        </div>
    </div>
    <div class="popup-messages-footer">
        <textarea id="status_message" placeholder="Type a message..." rows="10" cols="40" name="message"></textarea>
    </div>
</div>
<script>
    $(document).ready(function () {

        $("#addClass").click(function () {
            $('#qnimate').addClass('popup-box-on');
        });

        $("#removeClass").click(function () {
            $('#qnimate').removeClass('popup-box-on');
        });

        $('#carousels').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 110,
            itemMargin: 50,
            asNavFor: '.single-page-slider'
        });
        $('.single-page-slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: true,
            sync: "#carousel"
        });

        $(".flex-viewport").each(function () {
            if ($.trim($(this).html()).length == 0) {
                $(this).remove();
            }
        });


        $("#wishList").on('click', function () {
            var link = '', $this = $(this),
                adpost_id = $this.attr('data-id'),
                type = '';

            if ($this.hasClass('wishlistAdded') == true) {
                link = '<?php echo site_url('site/removeWishlist/' . $adpost_dataArr->id);?>';
                type = 'remove';
            } else {
                link = '<?php echo site_url('site/addWishlist/' . $adpost_dataArr->id);?>';
                type = 'add';
            }

            $.ajax({
                url: link,
                type: 'POST',
                data: {
                    "wishlist_id": $('#wishlistId').val()
                },
                cache: false,
                dataType: 'json',
                success: function (data) {

                    if (data.type == 'success') {
                        if (type == 'add') {
                            $this.attr('data-original-title', 'Remove Wishlist').addClass('wishlistAdded');
                            $('#wishlistId').val(data.id);
                        } else if (type == 'remove') {
                            $('#wishlistId').val(' ');
                            $this.attr('data-original-title', 'Add Wishlist').removeClass('wishlistAdded');
                        }

                        $.toaster({priority: 'success', message: data.msg});
                    } else if (data.type == 'error') {
                        $.toaster({priority: 'danger', message: data.msg});
                    }
                }
            });
        });

        $('[data-toggle="tooltip"]').tooltip();

        $('.manageStatus').on('click', function (e) {
            e.preventDefault();
            var $this = $(this),
                link = $(this).attr('href'),
                statusInt = $(this).attr('data-fld'),
                checkType = $(this).attr('id');
            var dataString = {
                status: statusInt,
                type: checkType
            };

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
                            url: link,
                            type: 'post',
                            data: dataString,
                            cache: false,
                            success: function (data) {

                                if (data == 'success') {
                                    var newStatus = 0, statusString, tooltip;
                                    if (checkType == 'manageStatus') {
                                        if (statusInt == 0) {
                                            newStatus = 1;
                                            statusString = 'SOLD';
                                            tooltip = 'Mark as Unsoled';
                                        } else {
                                            newStatus = 0;
                                            statusString = 'UNSOLED';
                                            tooltip = 'Mark as Soled';
                                        }
                                    } else if (checkType == 'manageArchived') {
                                        if (statusInt == 0) {
                                            newStatus = 1;
                                            statusString = 'Archived';
                                            tooltip = 'Mark as unarchived';
                                        } else if (statusInt == 1) {
                                            newStatus = 0;
                                            statusString = 'Unarchived';
                                            tooltip = 'Mark as archived';
                                        }
                                    }

                                    console.log(statusInt, newStatus, tooltip, checkType, $("#" + checkType));
                                    $("#" + checkType).attr({
                                        'data-fld': newStatus,
                                        'title': tooltip,
                                        'data-original-title': tooltip
                                    }).text(statusString);
                                    $.toaster({priority: 'success', message: 'Your ad status is ' + statusString});
                                } else {
                                    $.toaster({
                                        priority: 'danger',
                                        message: 'Something wrong happen please try again.'
                                    });
                                }
                            }
                        });
                    }
                }
            });
        });
    })
</script>