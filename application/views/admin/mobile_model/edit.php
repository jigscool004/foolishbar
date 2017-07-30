<div id="myModal" class="modal fade in" role="dialog" style="display: block; padding-left: 15px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close closeCityPopup"  data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Mobile model </h4>
            </div>
            
                <?php  
                 $data['url'] = site_url('admin/mobile_model/edit/' . $id);   
                 $data['button'] = 'Create';
                 $data['model_data'] = $category_data;
                 $data['categroyDataArr'] = $categroyDataArr;
                $this->load->view('admin/mobile_model/_form',$data);?>

        </div>
    </div>
</div>