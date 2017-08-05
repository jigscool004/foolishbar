

<?php
if ($error == 1) {
    echo '<div>';
} else {

    echo "<div class='cityformWrapper'>";
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo form_open($url, 'class=cityForm');
?>
<div class="modal-body">
    <div class="form-group margin-top-10px">
        <?php
        echo form_label('City <span class="required">*</span>', 'name', ['class' => 'col-sm-2 control-label']);
        ?>
        <div class="col-sm-10">
            <?php
                   echo form_dropdown('city_id',$city_dataArr,$location_data->city_id,['class' => 'form-control']);
            //echo form_error('name');

            echo form_error('city_id', '<span class="required">', '</span>');
            ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group margin-top-10px">
        <?php
        echo form_label('Name <span class="required">*</span>', 'name', ['class' => 'col-sm-2 control-label']);
        ?>
        <div class="col-sm-10">
            <?php
               echo form_input([
                'name' => 'area',
                'class' => 'form-control',
                'placeholder' => 'Enter area name',
                'id' => 'name',
                'value' => set_value('area',$location_data->area),
            ]);

            //echo form_error('name');

            echo form_error('area', '<span class="required">', '</span>');
            ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group margin-top-10px">
        <?php
        echo form_label('Zipcode <span class="required">*</span>', 'name', ['class' => 'col-sm-2 control-label']);
        ?>
        <div class="col-sm-10">
            <?php
               echo form_input([
                'name' => 'zipcode',
                'class' => 'form-control',
                'placeholder' => 'Enter city name',
                'id' => 'name',
                'value' => set_value('zipcode',$location_data->zipcode),
            ]);

            //echo form_error('name');

            echo form_error('zipcode', '<span class="required">', '</span>');
            ?>
        </div>
    </div>
    <div class="clearfix"></div>
        
    <div class="form-group margin-top-10px margin-bottom-10px">
        <?php
        echo form_label('Status <span class="required">*</span>', 'status', ['class' => 'col-sm-2 control-label']);
        ?>
        <div class="col-sm-10">
            <?php
            foreach([ 1 => 'Active', 0 => 'Inactive'] as $key => $status) {
                $isChecked = [];
                if ($location_data->status != "" && $key == $location_data->status) {
                    $isChecked['checked'] = 'checked';
                }
                

                echo form_radio(array_merge(['name' => 'status', 'value' => $key, 'id' => $status],$isChecked));
                echo form_label($status, $status, ['class' => 'margin-right-5px']);
            }
            
            

            echo "<div class='clearfix'></div>";
            echo form_error('status', '<span class="required">', '</span>');
            ?>
        </div>
    </div>
    <div class="clearfix"></div>

</div>
<div class="modal-footer">
    <?php echo form_submit('submit', $button, ['class' => 'btn btn-primary']); ?>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
   
    $(document).ready(function () {

        $('.cityForm').on('submit', function (e) {
            e.preventDefault();
            var actionUrl = $(this).attr('action'),
                    $this = $(this);
             
            var actionName = actionUrl.search("edit") ? 'Saved' : 'Created';
            $.ajax({
                url: actionUrl,
                method: 'post',
                data: $this.serialize(),
                success: function ($data) {
                    
                    if ($data == 1) {
                        $('.closeCityPopup').trigger('click');
                        table.ajax.reload();
                        $.toaster({ priority : 'success',  message : 'Location record has been ' + actionName}); 
                        //
                    } else if ($data == 0) {
                        $.toaster({ priority : 'danger',  message : 'Something wrong happend. Please try again.'}); 
                    } else {
                        $('.cityformWrapper').html($data);
                    }

                }
            });
        });
    });
</script>
