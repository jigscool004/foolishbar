<?php if ($isAdmin) :?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            404
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">404 Error</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <h3>404 Page not found.</h3>
            </div>
        </div>
    </section>
    <!-- /.content -->
    </div>
<?php else :?>

<div class="small-breadcrumb">
    <div class="container">
        <div class=" breadcrumb-link">
            <ul>
                <li><a href="<?php echo site_url();?>">Home</a></li>
                <li><a href="#" class="active">404</a></li>
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
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="error-container">
                    <div class="error-text">404</div>
                    <div class="error-info">The Page Could Not Be Found!</div>
                </div>
            </div>

            <!-- Middle Content Area  End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Main Container End -->
</section>
<?php endif;?>