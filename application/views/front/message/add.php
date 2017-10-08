<?php if (checkedLoggedinFront()) { 
    $this->load->helper('form');
    echo form_open('adpost/addMessage/' . $id, 'class=sendMessage');
   
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3 class="modal-title">Send Message to <?php echo $adpost_dataArr->adpost_username?> for <?php echo $adpost_dataArr->adtitle?></h3>
        </div>
        <div class="modal-body">
            <?php $this->load->view('front/message/_sendMessage');?>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-theme sent_message" name="send_message">Send Message</button>
            <button type="button" class="btn btn-dark closeModelBox" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>
<?php  echo form_close();
 } else { ?>
<div class="modal-dialog">
    <div class="modal-content">
<!--        <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3 class="modal-title">Message</h3>
        </div>-->
        <div class="modal-body" style="padding: 20px 10px;">
            Login required to send message to buyer
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger closeModelBox" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>
<?php } ?>
