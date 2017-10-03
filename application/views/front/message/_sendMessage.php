<?php  if ($error == 1) { ?>
  <div>
<?php } else { ?>
      <div class='sendMessageformWrapper'>
<?php } ?>
   <style>
       textarea { resize:vertical; }
       .form-control{padding:10px;margin-top: 10px;}
   </style>      
    
     <div class="form-group">
        <?php
      //  echo form_label('Subject <span class="required">*</span>', 'subject', ['class' => 'row control-label']);
        ?>
        <div class="">
            <?php
               echo form_input([
                'name' => 'subject',
                'class' => 'form-control',
                'placeholder' => 'Enter subject',
                'id' => 'subject',
                'value' => set_value('subject'),
            ]);

            //echo form_error('name');

            echo form_error('subject', '<span class="required">', '</span>');
            ?>
        </div>
    </div>
    <div class="form-group">
        <?php
       // echo form_label('Message <span class="required">*</span>', 'message_body', ['class' => 'row control-label']);
        ?>
        <div class="">
            <?php
               echo form_textarea([
                'name' => 'message_body',
                'class' => 'form-control',
                'placeholder' => 'Enter Your Message',
                'id' => 'message_body',
                'cols' => 10,
                'rows' => 4,
                'value' => set_value('message_body'),
            ]);
            echo form_error('message_body', '<span class="required">', '</span>');
            ?>
        </div>
    </div>
     <div class="clearfix"></div>   

</div>
<script type="text/javascript">
   
    $(document).ready(function () {

        $('.sendMessage').on('submit', function (e) {
            e.preventDefault();
            var actionUrl = $(this).attr('action'),
                    $this = $(this);
             
            var actionName = actionUrl.search("edit") ? 'Saved' : 'Created';
            $(".sent_message").attr('disabled',true).text('Processing...');
            $.ajax({
                url: actionUrl,
                method: 'post',
                data: $this.serialize(),
                success: function ($data) {
                    
                    if ($data == 1) {
                        $('.closeModelBox').trigger('click');
                        $.toaster({ priority : 'success',  message : 'You message has been sent.'}); 
                        //
                    } else if ($data == 0) {
                        $('.closeModelBox').trigger('click');
                        $.toaster({ priority : 'danger',  message : 'Something wrong happend. Please try again.'}); 
                    } else {
                        $(".sent_message").removeAttr('disabled').text('Send Message');
                        $('.sendMessageformWrapper').html($data);
                    }

                }
            });
        });
    });
</script>