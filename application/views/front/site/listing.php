<?php
/**
 * Created by PhpStorm.
 * User: Jigar Kumar
 * Date: 6/27/2017
 * Time: 6:49 AM
 */
?>
<div id="search-section">
    <div class="container">
        <form action="<?php echo site_url(); ?>" id="searchForm">
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-12">
                    <div class="col-md-3 col-xs-12 col-sm-4 no-padding">
                        <select name="cat" class="category form-control">
                            <?php if (count($mobileCategoryArr) > 0) :
                                foreach ($mobileCategoryArr as $id => $name) :
                                    $selected = $category_id == $id ? 'selected="selected"' : '';
                                    ?>
                                    <option value="<?php echo $id; ?>" <?php echo $selected; ?>><?php echo $name; ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-4 no-padding">
                        <input type="text" name="search_text"
                               value="<?php echo isset($_REQUEST['search_text']) ? $_REQUEST['search_text'] : '' ?>"
                               class="form-control search_text">
                    </div>
                    <div class="col-md-3 col-xs-12 col-sm-4 no-padding">
                        <button type="submit" name="submit" value="search" class="btn btn-block btn-light">Search
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="main-content-area clearfix">
    <section class="section-padding pattern_dots">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sx-12">
                    <?php  if (count($searchResult) > 0) {?>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                            <div class="filter-brudcrums">
                                <span class="pull-right">Showing 
                                    <span class="showed"><?php echo $x . ' - ' . $y; ?></span> of
                                    <span class="showed"><?php echo $totalCount; ?></span> results
                                </span>
                            </div>
                        </div>
                        <?php }?>
                        <div class="clearfix"></div>
                        <div class="posts-masonry">
                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">

                                <?php
                                if (count($searchResult) > 0) {
                                    echo '<ul class="list-unstyled">';
                                    foreach ($searchResult as $key => $result) {
                                        $imageUrl = site_url('assest/upload/adpost_photos/' . $result->adpost_id . '/' . $result->save_name);
                                        if ($result->save_name == NULL || $result->save_name == '') {
                                            $imageUrl = site_url('assest/upload/default.png');
                                        }
                                        ?>
                                        <li>
                                            <div class="well ad-listing clearfix">
                                                <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
                                                    <!-- Image Box -->
                                                    <div class="img-box">
                                                        <img alt="" class="img-responsive"
                                                             src="<?php echo $imageUrl ?>">
                                                        <div class="total-images">
                                                            <strong><?php echo $result->totalPhotos ?></strong> photos
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-sm-7 col-xs-12">
                                                    <!-- Ad Content-->
                                                    <div class="row">
                                                        <div class="content-area">
                                                            <div class="col-md-9 col-sm-12 col-xs-12">

                                                                <h3>
                                                                    <a href="<?php echo site_url('adpost/view/' . $result->id); ?>"><?php echo $result->adtitle ?></a>
                                                                </h3>
                                                                <!-- Info Icons -->
                                                                <ul class="additional-info pull-right">
                                                                    <li>
                                                                        <a class="fa fa-envelope" href="#" title=""
                                                                           data-toggle="tooltip"
                                                                           data-original-title="Send Message"></a>
                                                                    </li>
                                                                    <!--<li>
                                                                        <a class="fa fa-phone" href="#" title=""
                                                                           data-toggle="tooltip"
                                                                           data-original-title="+92-4567-123"></a>
                                                                    </li>-->
                                                                    <li>
                                                                        <a class="fa fa-heart" href="#" title=""
                                                                           data-toggle="tooltip"
                                                                           data-original-title="Add Wishlist"></a>
                                                                    </li>
                                                                </ul>
                                                                <!-- Ad Meta Info -->
                                                                <ul class="ad-meta-info">
                                                                    <li><i class="fa fa-map-marker"></i>
                                                                        <a href="#"><?php echo $result->city_name; ?></a>
                                                                    </li>
                                                                    <li>
                                                                        <i class="fa fa-clock-o"></i>
                                                                        <?php echo time_elapsed_string($result->created_on); ?>
                                                                    </li>
                                                                </ul>
                                                                <!-- Ad Description-->
                                                                <div class="ad-details">
                                                                    <p><?php echo $result->ad_desc ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-xs-12 col-sm-12">
                                                                <!-- Ad Stats -->
                                                                <div class="short-info">
                                                                    <div class="ad-stats hidden-xs">
                                                                        <span>Category : </span><?php echo $result->category_name ?>
                                                                    </div>
                                                                </div>
                                                                <div class="short-info">
                                                                    <div class="ad-stats hidden-xs">
                                                                        <span>Model : </span><?php echo $result->category_name ?>
                                                                    </div>
                                                                </div>
                                                                <!-- Price -->
                                                                <div class="price">
                                                                    <span>Rs.<?php echo $result->price; ?></span></div>
                                                                <!-- Ad View Button -->
                                                                <a href="<?php echo site_url('adpost/view/' . $result->id) ?>">
                                                                    <button class="btn btn-block btn-success"><i
                                                                                aria-hidden="true"
                                                                                class="fa fa-eye"></i>
                                                                        View Ad.
                                                                    </button>
                                                                </a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Ad Content End -->
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    echo '</ul>';
                                } else {
                                    echo 'no result found';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <?php echo $links; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
