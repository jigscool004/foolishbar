<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <![endif]-->
        <meta name="description" content="">
        <meta name="author" content="ScriptsBundle">
        <title>MobileStore | <?php echo $header; ?></title>
        <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/bootstrap.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/style.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/font-awesome.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/flaticon.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/et-line-fonts.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/forest-menu.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/animate.min.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/select2.min.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/nouislider.min.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/slider.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/owl.carousel.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/owl.theme.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/responsive-media.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/colors/defualt.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/owl.theme.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url('assest/front/css/owl.theme.css') ?>">

        <link href="<?php echo site_url('assest/front/skins/minimal/minimal.css'); ?>" rel="stylesheet">
        <script src="<?php echo site_url('assest/front/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo site_url('assest/front/js/bootstrap.min.js'); ?>"></script>
        <script src="js/modernizr.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- =-=-=-=-=-=-= Light Header =-=-=-=-=-=-= -->
        <div class="colored-header">
            <!-- Top Bar -->
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <!-- Header Top Left -->
                        <div class="header-top-left col-md-8 col-sm-6 col-xs-12 hidden-xs">
                         <ul class="listnone">
                            <li><a href="<?php echo site_url('site/about') ?>"><i aria-hidden="true" class="fa fa-heart-o"></i> About</a></li>
                            <li><a href="<?php echo site_url('site/faq') ?>"><i aria-hidden="true" class="fa fa-folder-open-o"></i> FAQS</a></li>
                         </ul>
                      </div>
                        <!-- Header Top Right Social -->
                        <div class="header-right col-md-4 col-sm-6 col-xs-12 ">
                            <div class="pull-right">
                                <ul class="listnone">
                                    <?php if ($this->session->userdata('isFrontLoggedIn')) { ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="icon-profile-male" aria-hidden="true"></i> <?php echo $this->session->userdata('username') ?> <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo site_url('user/dashboard') ?>">Dashboard</a></li>
                                            <li><a href="<?php echo site_url('user/profile') ?>">User Profile</a></li>
                                            <li><a href="<?php echo site_url('site/logout') ?>">Logout</a></li>
                                            <!-- <li><a href="active-ads.html">Active Ads</a></li>
                                            <li><a href="pending-ads.html">Pending Ads</a></li>
                                            <li><a href="favourite.html">Favourite Ads</a></li>
                                            <li><a href="messages.html">Message Panel</a></li>
                                            <li><a href="deactive.html">Account Deactivation</a></li> -->
                                        </ul>
                                    </li>
                                    <?php } else { ?>
                                        <li><a href="<?php echo site_url('site/login');?>"><i class="fa fa-sign-in"></i> Log in</a></li>
                                    <li><a href="<?php echo site_url('site/signup');?>"><i class="fa fa-unlock" aria-hidden="true"></i> Signup</a></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->
            <!-- Navigation Menu -->
            <div class="clearfix"></div>
            <!-- menu start -->
            <nav id="menu-1" class="mega-menu">
                <!-- menu list items container -->
                <section class="menu-list-items">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <ul class="menu-logo">
                                    <li>
                                        <a href="<?php echo site_url('') ?>">
                                            <img src="<?php echo site_url('assest/front/images/logo.png') ?>" alt="GujjuMobii">
                                        </a>
                                    </li>
                                </ul>
                                <!--<ul class="menu-links">
                                    <li>
                                        <a href="javascript:void(0)"> Home <i class="fa fa-angle-down fa-indicator"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Categories <i class="fa fa-angle-down fa-indicator"></i></a>
                                        <ul class="drop-down-multilevel">
                                            <li><a href="category-2.html">Modern Variation</a></li>
                                            <li><a href="category-3.html">Minimal Variation</a></li>
                                            <li><a href="category-4.html">Fancy Variation</a></li>

                                            <li><a href="category-6.html">Flat Variation</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="contact.html">Contact </a></li>
                                </ul>-->
                                <ul class="menu-search-bar">
                                    <li>
                                        <a href="<?php echo site_url('adpost/index') ?>" class="btn btn-light"><i class="fa fa-plus" aria-hidden="true"></i> Post Free Ad</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            </nav>
            <!-- menu end -->
        </div>
        <!-- Navigation Menu End -->
        
            <?php $this->load->view($mainContent);?>
            <footer>
            <!-- Footer Content -->
            <div class="footer-top">
               <!-- <div class="container">
                  <div class="row">
                     <div class="col-md-3  col-sm-6 col-xs-12">
                        Follow Us
                        <div class="widget socail-icons">
                           <h5>Follow Us</h5>
                           <ul>
                              <li><a href="#" class="fb"><i class="fa fa-facebook"></i></a><span>Facebook</span></li>
                              <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a><span>Twitter</span></li>
                              <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a><span>Linkedin</span></li>
                              <li><a href="#" class="googleplus"><i class="fa fa-google-plus"></i></a><span>Google+</span></li>
                           </ul>
                        </div>
                        Follow Us End
                     </div>
                     <div class="col-md-6  col-sm-6 col-xs-12">
                        Newslatter
                        <div class="widget widget-newsletter">
                           <h5>Singup for Weekly Newsletter</h5>
                           <div class="fieldset">
                              <p>We may send you information about related events, webinars, products and services which we believe.</p>
                              <form>
                                 <input type="text" value="Enter your email address" class="">
                                 <input type="submit" value="Submit" name="submit" class="submit-btn"> 
                              </form>
                           </div>
                        </div>
                        Newslatter
                     </div>
                  </div>
               </div>
                           </div> -->
            <!-- Copyrights -->
            <div class="copyrights">
               <div class="container">
                  <div class="copyright-content">
                     <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <p>&copy; Copyright <?php echo date('Y') ?> </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </footer> 
       

        <!-- Back To Top -->
        <a href="#0" class="cd-top">Top</a>
        <!-- Product Preview Popup -->

        <!-- / Product Preview Popup --> 
        <!-- =-=-=-=-=-=-= JQUERY =-=-=-=-=-=-= -->
        
        <script src="<?php echo site_url('assest/front/js/easing.js'); ?>"></script>
        <script src="<?php echo site_url('assest/front/js/forest-megamenu.js'); ?>"></script>
        <script src="<?php echo site_url('assest/front/js/jquery.appear.min.js'); ?>"></script>
        <script src="<?php echo site_url('assest/front/js/jquery.countTo.js'); ?>"></script>
        <script src="<?php echo site_url('assest/front/js/jquery.smoothscroll.js'); ?>"></script>
        <script src="<?php echo site_url('assest/front/js/select2.min.js'); ?>"></script>
        <script src="<?php echo site_url('assest/front/js/nouislider.all.min.js'); ?>"></script>
        <script src="<?php echo site_url('assest/front/js/imagesloaded.js'); ?>"></script>
        <script src="<?php echo site_url('assest/front/js/isotope.min.js'); ?>"></script>
        <script src="<?php echo site_url('assest/front/js/icheck.min.js'); ?>"></script>
        <script src="<?php echo site_url('assest/front/js/jquery-migrate.min.js'); ?>"></script>
        <script src="<?php echo site_url('assest/front/js/theia-sticky-sidebar.js'); ?>"></script>
        <script src="<?php echo site_url('assest/front/js/color-switcher.js'); ?>"></script>
        <script src="<?php echo site_url('assest/front/js/custom.js'); ?>"></script>
    </body>
</html>

