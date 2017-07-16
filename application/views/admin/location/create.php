<div id="myModal" class="modal fade in" role="dialog" style="display: block; padding-left: 15px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close closeCityPopup"  data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create new Location </h4>
            </div>
            
                <?php  
                 $data['url'] = site_url('admin/location/create');   
                 $data['button'] = 'Create';
                 $data['city_dataArr'] = $city_dataArr;
                 $this->load->view('admin/location/_form',$data);?>

        </div>
    </div>
</div>