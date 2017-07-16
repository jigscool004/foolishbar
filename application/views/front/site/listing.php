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
                        <input type="text" name="search_text" class="form-control search_text">
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
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                            <div class="filter-brudcrums">
                                <span>Showing <span class="showed">1 - 20</span> of <span class="showed">42211</span> results</span>
                                <div class="filter-brudcrums-sort">
                                    <ul>
                                        <li><span>Sort by:</span></li>
                                        <li><a href="#">Updated date</a></li>
                                        <li><a href="#">Price</a></li>
                                        <li><a href="#">New</a></li>
                                        <li><a href="#">Used</a></li>
                                        <li><a href="#">Warranty</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="posts-masonry">
                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">

                                <?php
                                var_dump($searchResult);
                                if (count($searchResult) > 0) {
                                    echo '<ul class="list-unstyled">';
                                    foreach ($searchResult as $key => $result) {
                                        ?>
                                        <li>
                                            <div class="well ad-listing clearfix">
                                                <div class="col-md-3 col-sm-5 col-xs-12 grid-style no-padding">
                                                    <!-- Image Box -->
                                                    <div class="img-box">
                                                        <img alt="" class="img-responsive"
                                                             src="images/posting/list-1.jpg">
                                                        <div class="total-images"><strong>8</strong> photos</div>
                                                        <div class="quick-view"><a class="view-button"
                                                                                   data-toggle="modal"
                                                                                   href="#ad-preview"><i
                                                                        class="fa fa-search"></i></a></div>
                                                    </div>
                                                    <!-- User Preview -->
                                                    <!--<div class="user-preview">
                                                        <a href="#"> <img alt="" class="avatar avatar-small"
                                                                          src="images/users/2.jpg"> </a>
                                                    </div>-->
                                                </div>
                                                <div class="col-md-9 col-sm-7 col-xs-12">
                                                    <!-- Ad Content-->
                                                    <div class="row">
                                                        <div class="content-area">
                                                            <div class="col-md-9 col-sm-12 col-xs-12">

                                                                <h3>
                                                                    <a href="<?php echo site_url('adpost/view/' . $result->id);?>"><?php echo $result->adtitle ?></a>
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
                                                                    <li><i class="fa fa-map-marker"></i><a href="#">London</a>
                                                                    </li>
                                                                    <li><i class="fa fa-clock-o"></i>15 minutes ago</li>
                                                                </ul>
                                                                <!-- Ad Description-->
                                                                <div class="ad-details">
                                                                    <p>Lorem ipsum dolor sit amet consectetur adiscing
                                                                        das elited ultricies facilisis lacinia pell das
                                                                        elited ultricies facilisis ... </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-xs-12 col-sm-12">
                                                                <!-- Ad Stats -->
                                                                <div class="short-info">
                                                                    <div class="ad-stats hidden-xs">
                                                                        <span>Condition  : </span>Used
                                                                    </div>
                                                                    <div class="ad-stats hidden-xs">
                                                                        <span>Warranty : </span>7 Days
                                                                    </div>
                                                                    <div class="ad-stats hidden-xs">
                                                                        <span>Sub Category : </span>Mobiles
                                                                    </div>
                                                                </div>
                                                                <!-- Price -->
                                                                <div class="price"><span>$18,640</span></div>
                                                                <!-- Ad View Button -->
                                                                <button class="btn btn-block btn-success"><i
                                                                            aria-hidden="true" class="fa fa-eye"></i>
                                                                    View Ad.
                                                                </button>
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
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
