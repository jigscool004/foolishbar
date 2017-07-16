<!-- Home Banner 1 -->
<style>
 .search-section input {
    color: #444;
    height: 55px;
    margin: 0;
    padding-left: 10px;
    width: 100%;
  }
</style>
<section class="main-search parallex ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-search-title">
                    <h1>Find Whatever Your Want?</h1>
                    <!-- <p>Search <strong>267,241</strong> new ads - 83 added today</p> -->
                </div>
                <form action="<?php echo site_url();?>" id="searchForm">
                <div class="search-section">
                    <div id="form-panel">
                       <div class="col-md-4">
                           <select name="cat" class="category form-control">
                                    <?php if(count($mobileCategoryArr) > 0) : 
                                        foreach ($mobileCategoryArr as $id => $name) :
                                    ?>
                                     <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                    <?php endforeach;
                                        endif; ?>
                                </select>
                       </div>
                       <div class="col-md-6">
                           <input type="text" name="search_text" class="search_text">
                       </div>
                       <div class="col-md-2">
                           <button type="submit" name="submit" value="search" style="height:55px;background-color: #2d343d;border-color: #2d343d" class="btn btn-danger btn-lg btn-block">Search</button>
                       </div>
                        <div class="clearfix"></div>
                       
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
   

    <!-- Home Banner 1 End -->
    <!-- Main Content Area -->
    <div class="main-content-area clearfix">
        <!-- =-=-=-=-=-=-= Popular Categories =-=-=-=-=-=-= -->
        <section class="custom-padding gray">
            <!-- Main Container -->
            <div class="container">
                <!-- Row -->
                <div class="row">
                    <?php foreach ($mobileCategoryObj as $key => $mobileCat) { ?>
                        <div class="col-md-3 col-xs-12 col-sm-6">
                            <div class="box">
                                <!-- <img alt="img" src="images/category/cars.png"> -->
                                <h4><a href="site/listing/<?php echo $mobileCat->id ?>"><?php echo $mobileCat->name; ?></a></h4>
                                <?php if (isset($adpostByCategory[$mobileCat->id])) {
                                        echo '<strong>'.$adpostByCategory[$mobileCat->id].' Ads</strong>';
                                    } 
                                ?>
                            </div>
                        </div>
                      
                    <?php } ?>
                    
                </div>
                <!-- Row End -->
            </div>
            <!-- Main Container End -->
        </section>
    </div>
</section>
<div class="clearfix"></div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#searchForm").on("click",function(e){

            var category = $('.category').val(),
                search_text = $(".search_text").val();
            console.log(category,search_text);
            if (category != "" || search_text != "") {
                return true;
            } else {
                e.preventDefault();
                return false;
            }

        });
    });
</script>