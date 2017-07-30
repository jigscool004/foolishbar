<div id="myModal" class="modal fade in" role="dialog" style="display: block; padding-left: 15px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close closeCityPopup"  data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create new city </h4>
            </div>
            
                <?php  
                 $data['url'] = site_url('admin/location/edit/' . $id);   
                 $data['button'] = 'Create';
                 $data['location_data'] = $location_data;
                 $data['city_dataArr'] = $city_dataArr;
                $this->load->view('admin/location/_form',$data);?>

        </div>
    </div>
</div>