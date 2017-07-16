<link href="<?php echo site_url('assest/admin-lte/datatables/dataTables.bootstrap.css'); ?>">
<script src="<?php echo site_url('assest/admin-lte/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo site_url('assest/admin-lte/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo site_url('assest/admin-lte/js/bootbox.min.js'); ?>"></script>

<script>
    var table;
</script>
<section class="content-header">
    <h1>
        Mobile Model
        <small>Manage mobile model list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Manage mobile model detail</h3>
                    <div class="pull-right">
                        <!--                        <button type="button" class="btn btn-info btn-xs" data-toggle="ajaxModal" data-target="#myModal">Add New</button>-->
                        <?php
                        echo anchor(site_url('admin/mobile_model/create'), 'Create', [
                            'class' => 'btn btn-info btn-xs',
                            'data-toggle' => 'ajaxModal',
                            'data-target' => '#myModel',
                            'onClick' => 'openModelPopup(this);return false;'
                        ]);
                        ?>
                    </div>
                </div>
                <div class="box-body">
                    <table id="areaTable" class='table-bordered table'>
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Model</td>
                                <td>Category</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Trigger the modal with a button -->

<script type="text/javascript">

    $(document).ready(function () {
        table = $('#areaTable').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/mobile_model/getData') ?>",
                "type": "POST"
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": false,
                    'width': '70px'
                },
                {
                    "targets": [2],
                    'width': '180px'
                },
                {
                    "targets": [4],
                    "orderable": false,
                    'width': '150px'
                },
            ],

        });

        //table.ajax.reload();



    });

    function openModelPopup(currentObject) {
        $('#ajaxModal').remove();
        var $remote = currentObject.href,
                $modal = $('<div class="modal" id="ajaxModal"><div class="modal-body">hellosef</div></div>');
        $('body').append($modal);
        $modal.modal({backdrop: 'static', keyboard: false});
        $modal.load($remote);
    }
    
   


    function deleteRercord(currentObject) {
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
                        'type' : 'get',
                        'url'  : currentObject.href,
                        'success' : function(data) {
                            table.ajax.reload();
                            if (data == 1) {
                                $.toaster({ priority : 'success',  message : 'Location record has been deleted.'}); 
                            } else {
                                $.toaster({ priority : 'danger',  message : 'Something wrong happend. Please try again.'}); 
                            }
                        }
                    })
                }
            }
        });
    }
</script>