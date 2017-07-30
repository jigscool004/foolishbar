<div id="myModal" class="modal fade in" role="dialog" style="display: block; padding-left: 15px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close closeCityPopup"  data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create new city </h4>
            </div>
            
                <?php  
                 $data['url'] = site_url('admin/city/create');   
                 $data['button'] = 'Create';
                 $city_data = (object)['name' => '','status' => ''];
                 $data['city_data'] = $city_data;
                $this->load->view('admin/city/_form',$data);?>

        </div>
    </div>
</div>