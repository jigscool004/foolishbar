<script src="<?php echo site_url('assest/admin-lte/js/jquery.toaster.js') ?>"></script>
<link href="<?php echo site_url('assest/admin-lte/datatables/dataTables.bootstrap.css'); ?>">
<script src="<?php echo site_url('assest/admin-lte/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo site_url('assest/admin-lte/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<style>
    .category-grid-box-1 .image img{height: 350px;}
</style>
<div class="small-breadcrumb">
    <div class="container">
        <div class=" breadcrumb-link">
            <ul>
                <li><a href="<?php echo site_url(''); ?>">Home</a></li>
                <li><a href="#" class="active">Ads Messages</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="main-content-area clearfix">
    <section class="section-padding gray">
        <div class="container">
            <div class="row">
                <?php
                $this->load->view('front/usertemplate/leftbar');
                ?>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="posts-masonry" style="position: relative; height: 1572.9px;">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="position: absolute; left: 0px; top: 0px;">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#tab1success" data-toggle="tab">Inbox</a></li>
                                                <li><a href="#tab2success" data-toggle="tab">Sent</a></li>
                                            </ul>
                                        </div>
                                        <div class="panel-body">
                                            <div class="tab-content">
                                                <div class="tab-pane fade in active" id="tab1success">
                                                    <table id="inboxTable">
                                                        <thead>
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" name="selectAll" id="selectAll">
                                                            </td>
                                                            <td>User</td>
                                                            <td>Ad</td>
                                                            <td>Date</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($results as $key => $result) :
                                                        var_dump($results);
                                                        ?>
                                                        <tr>
                                                            <td><input type="checkbox" name="selectAll" id="<?php echo $result->adpost_id?>"></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <?php
                                                        endforeach;
                                                        //var_dump($results);
                                                    ?>
                                                </div>
                                                <div class="tab-pane fade" id="tab2success">Success 2</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
$msg = $this->session->flashdata('msg');
$btn = $this->session->flashdata('btn');
?>
<script>
    jQuery(document).ready(function ($) {
        if ('<?php echo $msg ?>' != "") {
            $.toaster({priority: '<?php echo $btn ?>', message: '<?php echo $msg ?>'});
        }
        $('#inboxTable').DataTable();
    });
</script>