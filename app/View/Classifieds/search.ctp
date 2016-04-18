<?php $lang = $this->Session->read('lang'); ?>
<?php $user = $this->Session->read('user'); ?>
    
    <div class="banner_inner search_banner_inner">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <div class="search_main_head">
                          <div class="seaerch_main">
                            <div class="input-inner adds_near">
                                <div class="field_icon"><i class="fa fa-search"></i></div>
                                <input type="text" class="form-control input_keyword" value="<?php echo (isset($data["keyword"]))? $data["keyword"] : ""; ?>" placeholder="<?php echo $lang["what are looking for"]; ?>..">
                                <div class="show_place search_showplace" style="display:none"></div>
                            </div>
                             <!-- dropdown start-->
                            <div class="input-inner dropdown droodown_box"> 
                              <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <?php if(isset($data["c_id"]) && !empty($data["c_id"])){ ?>
                                <?php echo $data["hid_cat"]; ?>
                                <?php }else if(isset($data["m_id"]) && !empty($data["m_id"])){ ?>
                                <?php echo $data["hid_main"]; ?>
                                <?php }else{ ?>
                                <span><img src="<?php echo $this->webroot; ?>images/square234.png"></span><?php echo " ".$lang["All"]." ".$lang["Category"]; ?>
                                <?php } ?>
                                <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu">
                                  <li>
                                    <a href="javascript:void(0)" class="main_category" main="" m_name="Allads"><span><img src="<?php echo $this->webroot; ?>images/square234.png"></span><?php echo $lang["All"]." ".$lang["Category"]; ?></a>
                                  </li>
                                  <?php foreach($maincat as $mainc){ ?>
                                  <li>
                                    <?php if(isset($data["m_id"]) && !empty($data["m_id"]) && $data["m_id"] == $mainc["maincat"]["classified_maincategories"]["mm_id"]){ ?>
                                    <a href="javascript:void(0)" class="main_category active_cat" main="<?php echo $mainc["maincat"]["classified_maincategories"]["mm_id"]; ?>" m_name="<?php echo $this->Link->changename($mainc["maincat"]["classified_maincategories"]["maincategory"]); ?>"><span><img src="<?php echo $this->webroot.$mainc["maincat"]["files"]["base_url"]; ?>"></span><?php echo $mainc["maincat"]["classified_maincategories"]["maincategory"]; ?></a>
                                    <?php }else{ ?>
                                    <a href="javascript:void(0)" class="main_category" main="<?php echo $mainc["maincat"]["classified_maincategories"]["mm_id"]; ?>" m_name="<?php echo $this->Link->changename($mainc["maincat"]["classified_maincategories"]["maincategory"]); ?>"><span><img src="<?php echo $this->webroot.$mainc["maincat"]["files"]["base_url"]; ?>"></span><?php echo $mainc["maincat"]["classified_maincategories"]["maincategory"]; ?></a>
                                    <?php } ?>
                                    <?php if(!empty($mainc["category"])){ ?>
                                    <div class="drop_icon"><i class="fa fa-chevron-right"></i></div>
                                    <div class=" sub-menu">
                                       <ul class="submenu_list">
                                          <?php foreach($mainc["category"] as $catm){ ?>
                                          <li>
                                            <?php if(isset($data["c_id"]) && !empty($data["c_id"]) && $data["c_id"] == $catm["cat"]["classified_category"]["c_id"]){ ?>
                                            <a href="javascript:void(0)" class="cat_category active_cat" m_id="<?php echo $mainc["maincat"]["classified_maincategories"]["mm_id"]; ?>" m_name="<?php echo $this->Link->changename($mainc["maincat"]["classified_maincategories"]["maincategory"]); ?>" main="<?php echo $catm["cat"]["classified_category"]["c_id"]; ?>" fap="<?php echo $catm["cat"]["filter_page"]["page_name"]; ?>" c_name="<?php echo $this->Link->changename($catm["cat"]["classified_category"]["category"]); ?>"><?php echo $catm["cat"]["classified_category"]["category"]; ?></a>
                                            <?php }else{ ?>
                                            <a href="javascript:void(0)" class="cat_category" m_id="<?php echo $mainc["maincat"]["classified_maincategories"]["mm_id"]; ?>" m_name="<?php echo $this->Link->changename($mainc["maincat"]["classified_maincategories"]["maincategory"]); ?>" main="<?php echo $catm["cat"]["classified_category"]["c_id"]; ?>" fap="<?php echo $catm["cat"]["filter_page"]["page_name"]; ?>" c_name="<?php echo $this->Link->changename($catm["cat"]["classified_category"]["category"]); ?>"><?php echo $catm["cat"]["classified_category"]["category"]; ?></a>
                                            <?php } ?>
                                          </li>
                                          <?php } ?>
                                       </ul>
                                    </div>
                                    <?php } ?>
                                  </li>
                                  <?php } ?>
                              </ul>
                            </div>
                            <!-- dropdown end-->
                            <div class="input-inner region">
                              <div class="field_icon"><i class="fa fa-map-marker"></i></div>
                              <input type="text" id="region_city" class="form-control region_city" placeholder="<?php echo $lang["Zip-City"]; ?>" value="<?php if(isset($data["loc"])) echo $data["loc"]; ?>">
                              <div class="loc_place index_place" style="display:none"></div>
                            </div>

                            <!-- Radius Dropdown start -->
                            <div class="city_radius dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle radius_search" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span class="radius_keyword"><?php echo (isset($data["radius"]) && !empty($data["radius"]))? "+ ".$data["radius"]." km" : "Radius"; ?></span><span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                  <li>
                                    <a href="javascript:void(0)" class="search_radius" main="">Radius</a>
                                  </li>
                                  <li>
                                    <a href="javascript:void(0)" class="search_radius" main="5">+ 5 km</a>
                                  </li>
                                  <li>
                                    <a href="javascript:void(0)" class="search_radius" main="10">+ 10 km</a>
                                  </li>
                                  <li>
                                    <a href="javascript:void(0)" class="search_radius" main="25">+ 25 km</a>
                                  </li>
                                  <li>
                                    <a href="javascript:void(0)" class="search_radius" main="50">+ 50 km</a>
                                  </li>
                                  <li>
                                    <a href="javascript:void(0)" class="search_radius" main="100">+ 100 km</a>
                                  </li>
                                  <li>
                                    <a href="javascript:void(0)" class="search_radius" main="250">+ 250 km</a>
                                  </li>
                                  <li>
                                    <a href="javascript:void(0)" class="search_radius" main="500">+ 500 km</a>
                                  </li>
                                  <li>
                                    <a href="javascript:void(0)" class="search_radius" main="1000">+ 1000 km</a>
                                  </li>
                                </ul>
                            </div>
                            <!-- Radius Dropdown end -->

                            <div class="input-inner search_btn">
                              <button class="search_add"><i class="fa fa-search"></i> <?php echo $lang["Search"]; ?></button>
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
    </div>
</section>

<!--conten sec start-->
<div class="conten">
  <div class="search_main">
       <div class="container">
          <ol class="breadcrumb">
              <li><a href="<?php echo $this->webroot; ?>">Home</a></li>
              <?php if(isset($data["hid_main"]) && !empty($data["hid_main"])){ ?>
              <li><a href="javascript:void(0)" class="left_maincategory" main="<?php echo $data["m_id"]; ?>" m_name="<?php echo $data["hid_main"]; ?>"><?php echo $data["hid_main"]; ?></a></li>
              <?php } if(isset($data["hid_cat"]) && !empty($data["hid_cat"])){ ?>
              <li><a href="javascript:void(0)" class="left_category" fap="<?php echo $data["fap"]; ?>" main="<?php echo $data["c_id"]; ?>" c_name="<?php echo $data["hid_cat"]; ?>" m_id="<?php echo $data["m_id"]; ?>" m_name="<?php echo $data["hid_main"]; ?>"><?php echo $data["hid_cat"]; ?></a></li>
              <?php } if(isset($data["hid_scat"]) && !empty($data["hid_scat"])){ ?>
              <li><a href="javascript:void(0)" class="left_subcategory" main="<?php echo $data["s_id"]; ?>" s_name="<?php echo $data["hid_scat"]; ?>"><?php echo $data["hid_scat"]; ?></a></li>
              <?php } ?>
          </ol>
          <div class="row">
             <div class="col-md-3 col-sm-3">
                 <div class="left_box">
                    <div class="accordian_box">
                       <div class="left_heading">
                          <h2><b><?php echo $lang["Refine Your Results"]; ?></b><span><?php echo $lang["Brands"]; ?></span></h2>
                       </div>
                       <!-- category List -->
                       <ul class="cat_list">
                           <?php foreach($maincat as $lmain){ ?>
                           <?php if(isset($data["m_id"]) && !empty($data["m_id"])){ ?> 
                           <li>
                               <?php if($data["m_id"] == $lmain["maincat"]["classified_maincategories"]["mm_id"]){ ?> 
                               <a href="javascript:void(0)" class="left_maincategory" main="<?php echo $lmain["maincat"]["classified_maincategories"]["mm_id"];  ?>" m_name="<?php echo $this->Link->changename($lmain["maincat"]["classified_maincategories"]["maincategory"]);  ?>"><?php echo $lmain["maincat"]["classified_maincategories"]["maincategory"];  ?></a>
                               <ul class="sub_cat_list">
                                 <?php foreach($lmain["category"] as $lcat){ ?>
                                 <?php if(isset($data["c_id"]) && !empty($data["c_id"])){ ?>
                                 <li>
                                     <?php if($data["c_id"] == $lcat["cat"]["classified_category"]["c_id"]){ ?>
                                     <a href="javascript:void(0)" class="left_category" main="<?php echo $lcat["cat"]["classified_category"]["c_id"]; ?>" c_name="<?php echo $this->Link->changename($lcat["cat"]["classified_category"]["category"]); ?>" m_id="<?php echo $lmain["maincat"]["classified_maincategories"]["mm_id"];  ?>" m_name="<?php echo $this->Link->changename($lmain["maincat"]["classified_maincategories"]["maincategory"]);  ?>" fap="<?php echo $lcat["cat"]["filter_page"]["page_name"]; ?>"><?php echo $lcat["cat"]["classified_category"]["category"]; ?></a>
                                     <ul class="sub_in_cat_list">
                                       <?php foreach($lcat["subcat"] as $lsub){ ?> 
                                       <?php if(isset($data["s_id"]) && !empty($data["s_id"])){ ?>
                                       <li>
                                        <?php if($data["s_id"] == $lsub["classified_subcategory"]["s_id"]){ ?>
                                        <a href="javascript:void(0)" class="left_subcategory" main="<?php echo $lsub["classified_subcategory"]["s_id"]; ?>" s_name="<?php echo $this->Link->changename($lsub["classified_subcategory"]["subcategory"]); ?>"><?php echo $lsub["classified_subcategory"]["subcategory"]; ?></a>
                                        <?php } ?>
                                       </li>
                                       <?php }else{ ?>
                                       <li><a href="javascript:void(0)" class="left_subcategory" main="<?php echo $lsub["classified_subcategory"]["s_id"]; ?>" s_name="<?php echo $this->Link->changename($lsub["classified_subcategory"]["subcategory"]); ?>"><?php echo $lsub["classified_subcategory"]["subcategory"]; ?></a></li>
                                       <?php } } ?>
                                     </ul>
                                     <?php } ?>
                                 </li>
                                 <?php }else{ ?>
                                 <li><a href="javascript:void(0)" class="left_category" main="<?php echo $lcat["cat"]["classified_category"]["c_id"]; ?>" c_name="<?php echo $this->Link->changename($lcat["cat"]["classified_category"]["category"]); ?>" m_id="<?php echo $lmain["maincat"]["classified_maincategories"]["mm_id"];  ?>" m_name="<?php echo $this->Link->changename($lmain["maincat"]["classified_maincategories"]["maincategory"]);  ?>" fap="<?php echo $lcat["cat"]["filter_page"]["page_name"]; ?>"><?php echo $lcat["cat"]["classified_category"]["category"]; ?></a></li>
                                 <?php } } ?>
                               </ul>
                               <?php } ?>
                           </li>
                           <?php }else{ ?>
                           <li><a href="javascript:void(0)" class="left_maincategory" main="<?php echo $lmain["maincat"]["classified_maincategories"]["mm_id"];  ?>" m_name="<?php echo $this->Link->changename($lmain["maincat"]["classified_maincategories"]["maincategory"]);  ?>"><?php echo $lmain["maincat"]["classified_maincategories"]["maincategory"];  ?></a></li>
                           <?php } } ?>
                       </ul>
                       <!--  category List -->
                    </div>
                    <div class="left_box_list">
                        <div class="left_heading">
                            <h2><?php echo $lang["Price"]; ?></h2>
                            <div class="panel_filter"> 
                              <div class="col-sm-6">        
                                  <select id="select_price1" class="form-control">
                                    <option value=""><?php echo $lang["From"]; ?></option>
                                    <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 5000)? "selected" : ""; ?> >5000</option>
                                    <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 10000)? "selected" : ""; ?>>10000</option>
                                    <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 50000)? "selected" : ""; ?>>50000</option>
                                    <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 100000)? "selected" : ""; ?>>100000</option>
                                    <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 500000)? "selected" : ""; ?>>500000</option>
                                    <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 1000000)? "selected" : ""; ?>>1000000</option>
                                    <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 5000000)? "selected" : ""; ?>>5000000</option>
                                    <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 10000000)? "selected" : ""; ?>>10000000</option>
                                  </select>
                              </div>
                              <div class="col-sm-6">
                                  <select id="select_price2" class="form-control">
                                    <option value=""><?php echo $lang["To"]; ?></option>
                                    <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 5000)? "selected" : ""; ?> >5000</option>
                                    <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 10000)? "selected" : ""; ?>>10000</option>
                                    <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 50000)? "selected" : ""; ?>>50000</option>
                                    <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 100000)? "selected" : ""; ?>>100000</option>
                                    <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 500000)? "selected" : ""; ?>>500000</option>
                                    <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 1000000)? "selected" : ""; ?>>1000000</option>
                                    <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 5000000)? "selected" : ""; ?>>5000000</option>
                                    <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 10000000)? "selected" : ""; ?>>10000000</option>
                                  </select>
                              </div>
                              <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div id="load_filter">
                    </div>
                    <div class="accordian_box">
                       <div class="left_heading">
                          <h2><span><?php echo $lang["Place"]; ?></span></h2>
                       </div>
                       <?php 
                            $states = array();
                            $states[2] = "Baden-Wurttemberg";
                            $states[4] = "Bayern";
                            $states[6] = "Berlin";
                            $states[7] = "Brandenburg";
                            $states[8] = "Bremen";
                            $states[11] = "Hamburg";
                            $states[14] = "Hessen";
                            $states[28] = "Mecklenburg-Vorpommern";
                            $states[32] = "Niedersachsen";
                            $states[34] = "Nordrhein-Westfalen";
                            $states[37] = "Rheinland-Pfalz";
                            $states[39] = "Saarland";
                            $states[40] = "Sachsen";
                            $states[41] = "Sachsen-Anhalt";
                            $states[43] = "Schleswig-Holstein";
                            $states[44] = "Thuringen";
                        ?>

                       <!-- Country / state / City -->
                       <ul class="cst_list">
                           <li>
                               <a href="javascript:void(0)" class="left_country" main="" >Germany</a>
                               <ul class="sub_cat_list">
                                 <?php foreach($states as $x => $y){ ?>
                                 <?php if(isset($data["place"]) && !empty($data["place"])){ ?>
                                 <li>
                                     <?php if($data["place"] == $x){ ?>
                                     <a href="javascript:void(0)" class="left_state state_active" main="<?php echo $x; ?>"><?php echo $y; ?></a>
                                     <ul class="sub_in_cat_list">
                                       <?php $scount = 0; foreach($city_list as $lcity){ ?> 
                                       <?php if(isset($data["city"]) && !empty($data["city"])){ ?>
                                       <li>
                                          <?php if($data["city"] == $lcity["city"]["name"]){ ?>
                                          <a href="javascript:void(0)" class="left_city" main="<?php echo $lcity["city"]["name"]; ?>" ><?php echo $lcity["city"]["name"]; ?></a>
                                          <?php } ?>
                                       </li>
                                       <?php }else{ ?>
                                       <li>
                                          <a href="javascript:void(0)" class="left_city" main="<?php echo $lcity["city"]["name"]; ?>" ><?php echo $lcity["city"]["name"]; ?></a>
                                       </li>
                                       <?php if($scount == 19)
                                             {
                                                echo '<li class="display_city"><a href="javascript:void(0)">View All</a></li>';
                                                break;
                                             }
                                        ?> 
                                       <?php $scount++; } } ?>
                                     </ul>
                                     <?php } ?>
                                 </li>
                                 <?php }else{ ?>
                                 <li><a href="javascript:void(0)" class="left_state" main="<?php echo $x; ?>"><?php echo $y; ?></a></li>
                                 <?php } } ?>
                               </ul>
                           </li>
                       </ul>
                       <!-- Country / state / City -->

                        <!-- Show all cities   -->
                       <div id="show_all_cities" class="hide">
                          <ul>
                             <?php if(isset($city_list) && !empty($city_list)){ ?>
                             <?php foreach($city_list as $rcity){ ?>
                             <li>
                                <a href="javascript:void(0)" class="left_city" main="<?php echo $rcity["city"]["name"]; ?>" ><?php echo $rcity["city"]["name"]; ?></a>
                             </li>
                             <?php } } ?>
                          </ul>
                       </div>
                       <!-- Show all cities   -->
                    </div>
                 </div>
             </div>
             <div class="col-md-9 col-sm-3">
                 <div class="right_box">
                   <div class="right_box_heading">
                      <?php if($data["ad"] == 1){ ?>
                       <a href="javascript:void(0)" class="right_box_btn search_by_ad" main="1"><?php echo $lang["Ads with Photos"]; ?>  (<?php echo $add_count; ?>) </a>
                      <?php }else{ ?>
                       <a href="javascript:void(0)" class="right_box_btn bg_white search_by_ad" main="1"><?php echo $lang["Ads with Photos"]; ?> (<?php echo $add_count1; ?>) </a>
                      <?php } if($data["ad"] == 2){ ?>
                       <a href="javascript:void(0)" class="right_box_btn search_by_ad" main="2"><?php echo $lang["All Ads"]; ?>  (<?php echo $add_count; ?>) </a>
                      <?php }else{ ?>
                        <a href="javascript:void(0)" class="right_box_btn bg_white search_by_ad" main="2"><?php echo $lang["All Ads"]; ?> (<?php echo $add_count1; ?>) </a>
                      <?php } ?>
                      <div class="right_tab pull-right">
                          <label><?php echo $lang["View"]; ?>:</label>
                          <a href="javascript:void(0)" class="view_style" main="list" title="List">
                            <span class="view_icon <?php echo (isset($data["view"]) && !empty($data["view"]) && $data["view"] == "list")? "active_view_style" : ""; ?>"><i class="fa fa-th-list"></i></span>
                          </a>
                          <a href="javascript:void(0)" class="view_style" main="gallery" title="Gallery">
                            <span class="view_icon <?php echo (isset($data["view"]) && !empty($data["view"]) && $data["view"] == "gallery")? "active_view_style" : ""; ?>"><i class="fa fa-th"></i></span>
                          </a>
                          <a href="javascript:void(0)" class="view_style" main="grid" title="Grid">
                            <span class="view_icon <?php echo (isset($data["view"]) && !empty($data["view"]) && $data["view"] == "grid")? "active_view_style" : ""; ?>"><i class="fa fa-desktop"></i></span>
                          </a>  
                          <label><?php echo $lang["Sort By"]; ?>:</label>
                          <div class="select_box1">
                               <div class="select_icon"><i class="fa fa-caret-down"></i></div>
                               <select class="form-control sort_view">
                                  <option value="0"><?php echo $lang["most recent"]; ?> </option>
                                  <option value="1" <?php echo (isset($data["order"]) && !empty($data["order"]) && $data["order"] == 1)?  "selected": ""; ?> ><?php echo $lang["price low to high"]; ?></option>
                                  <option value="2" <?php echo (isset($data["order"]) && !empty($data["order"]) && $data["order"] == 2)?  "selected": ""; ?> ><?php echo $lang["price high to low"]; ?></option>
                               </select>
                          </div>
                      </div>
                   </div>
                   <?php if(!empty($adddata)){ ?>
                   <?php if(isset($data["view"]) && !empty($data["view"]) && $data["view"] == "gallery"){ ?>
                   <div class="featured_main">
                      <div class="row">
                        <?php foreach($adddata as $ada){  ?>
                        <div class="col-md-4 col-sm-4">
                          <div class="favorite_box featured_box">
                              <div class="img_fav">
                                <a href="<?php echo $this->webroot; ?>ad/<?php echo $ada['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($ada["classifieds"]["title"]); ?>">
                                <img src="<?php echo $this->webroot.$ada["files"]["base_url"]; ?>">
                                </a>
                              </div>
                              <div class="text_fav">
                                 <h3><a href="<?php echo $this->webroot; ?>ad/<?php echo $ada['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($ada["classifieds"]["title"]); ?>"><?php echo substr($ada["classifieds"]["title"],0,20); ?></a></h3>
                                 <div class="price_box"><?php echo ($ada["classifieds"]["price"] > 0)? $ada["classifieds"]["price"]." €" : ""; ?> </div>
                                 <div class="breadcrumb_wrap">
                                    <ol class="breadcrumb">
                                      <li><a href="<?php echo $this->webroot; ?>ad/<?php echo $ada['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($ada["classifieds"]["title"]); ?>"><?php echo $ada['classified_maincategories']['maincategory']; ?></a></li>
                                      <li><a href="<?php echo $this->webroot; ?>ad/<?php echo $ada['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($ada["classifieds"]["title"]); ?>"><?php echo $ada['classified_category']['category']; ?> </a></li>
                                      <?php if(!empty($ada[0]['subcategory'])){ ?>
                                      <li class="active"><?php echo $ada[0]['subcategory']; ?></li>
                                      <?php } ?>
                                    </ol>
                                 </div>
                              </div>
                          </div>
                        </div>
                        <?php } ?>
                      </div>
                   </div>
                   <?php }else if(isset($data["view"]) && !empty($data["view"]) && $data["view"] == "grid"){ ?>
                   <div class="featured_main big_gallery">
                      <div class="row">
                          <?php foreach($adddata as $ada){  ?>
                          <div class="col-md-12 col-sm-12">
                             <div class="favorite_box featured_box">
                                <div class="img_fav">
                                  <a href="<?php echo $this->webroot; ?>ad/<?php echo $ada['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($ada["classifieds"]["title"]); ?>">
                                  <img src="<?php echo $this->webroot.$ada["files"]["base_url"]; ?>">
                                  </a>
                                </div>
                                <div class="text_fav">
                                   <h3><a href="<?php echo $this->webroot; ?>ad/<?php echo $ada['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($ada["classifieds"]["title"]); ?>"><?php echo substr($ada["classifieds"]["title"],0,20); ?></a></h3>
                                   <div class="price_box"><?php echo ($ada["classifieds"]["price"] > 0)? $ada["classifieds"]["price"]." €" : ""; ?> </div>
                                   <div class="breadcrumb_wrap">
                                      <ol class="breadcrumb">
                                        <li><a href="<?php echo $this->webroot; ?>ad/<?php echo $ada['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($ada["classifieds"]["title"]); ?>"><?php echo $ada['classified_maincategories']['maincategory']; ?></a></li>
                                        <li><a href="<?php echo $this->webroot; ?>ad/<?php echo $ada['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($ada["classifieds"]["title"]); ?>"><?php echo $ada['classified_category']['category']; ?> </a></li>
                                        <?php if(!empty($ada[0]['subcategory'])){ ?>
                                        <li class="active"><?php echo $ada[0]['subcategory']; ?></li>
                                        <?php } ?>
                                      </ol>
                                   </div>
                                </div>
                             </div>
                          </div>
                          <?php } ?>
                      </div>
                   </div>
                   <?php }else{ ?>
                   <?php foreach($adddata as $ada){  ?>
                   <div class="right_box_list">
                      <div class="rb_img_box">
                        <a href="<?php echo $this->webroot; ?>ad/<?php echo $ada['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($ada["classifieds"]["title"]); ?>">
                          <img src="<?php echo $this->webroot.$ada['files']['base_url']; ?>" class="img-responsive">
                        </a>
                     </div>
                      <div class="rb_txt_box">
                        <div class="rb_head"><h2><a href="<?php echo $this->webroot; ?>ad/<?php echo $ada['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($ada["classifieds"]["title"]); ?>"><?php echo substr($ada["classifieds"]["title"],0,50); ?></a></h2> <div class="clearfix"></div></div>
                        
                        <p><?php echo substr($ada["classifieds"]["description"],0,130); ?></p>
                        <ul class="list_tag">
                          <li><img src="<?php echo $this->webroot.$ada[0]['category_image']; ?>"></li>
                          <li><a href="<?php echo $this->webroot; ?>classified/<?php echo $this->Link->changename($ada["classified_maincategories"]["maincategory"]); ?>?m_id=<?php echo $ada["classifieds"]["m_id"]; ?>"><?php echo $ada['classified_maincategories']['maincategory']; ?>,</a></li>
                          <li><a href="<?php echo $this->webroot; ?>classified/<?php echo $this->Link->changename($ada["classified_maincategories"]["maincategory"]).'/'.$this->Link->changename($ada["classified_category"]["category"]); ?>?m_id=<?php echo $ada["classifieds"]["m_id"]; ?>&c_id=<?php echo $ada["classifieds"]["c_id"]; ?>&fap=<?php echo $ada["filter_page"]["page_name"]; ?>"><?php echo $ada['classified_category']['category']; ?>,</a></li>
                          <li><a href="<?php echo $this->webroot; ?>classified/<?php echo $this->Link->changename($ada["classified_maincategories"]["maincategory"]).'/'.$this->Link->changename($ada["classified_category"]["category"]).'/'.$this->Link->changename($ada[0]["subcategory"]); ?>?m_id=<?php echo $ada["classifieds"]["m_id"]; ?>&c_id=<?php echo $ada["classifieds"]["c_id"]; ?>&s_id=<?php echo $ada["classifieds"]["s_id"]; ?>&fap=<?php echo $ada["filter_page"]["page_name"]; ?>"><?php echo $ada[0]['subcategory']; ?></a></li>
                          <!-- <li><?php if($ada["classifieds"]["urgent_date"] > date("Y-m-d")){ echo "urgent"; } ?></li> -->
                          <div class="clearfix"></div>
                        </ul>
                        <div class="price_btn_box"><a href="<?php echo $this->webroot; ?>ad/<?php echo $ada['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($ada["classifieds"]["title"]); ?>" class="price_btn"><?php echo $lang["details"]; ?></a></div>
                     </div>
                     <div class="rb_txt_box_right">
                       <div class="price_tag">
                          <div class="price">
                            <?php if($ada["classifieds"]["price"] > 0){ ?>
                            <?php echo $ada["classifieds"]["price"]; ?> €
                            <?php } ?>
                          </div>
                          <div class="price_tag_txt"><?php echo $ada["classifieds"]["zipcode"]; ?> <span><?php echo $ada["classifieds"]["city"]; ?></span>
                       </div>
                       </div>
                        <div class="date_box"><div class="date"><?php echo date("d-m-Y", strtotime($ada["classifieds"]["create_date"])); ?></div>
                          <div class="wish_icon">
                           <?php if(!empty($user)){ ?>
                             <?php if(!empty($f_data) && in_array($ada["classifieds"]["id"], $f_data)){ ?>
                                <a href="javascript:void(0)" id="remember_<?php echo $ada["classifieds"]["id"]; ?>" class="fav_remove" main="<?php echo $ada["classifieds"]["id"]; ?>"><i class="fa fa-heart-o mark_favorite"></i></a>
                              <?php }else{ ?>
                                <a href="javascript:void(0)" id="remember_<?php echo $ada["classifieds"]["id"]; ?>" class="remember" main="<?php echo $ada["classifieds"]["id"]; ?>"><i class="fa fa-heart-o"></i></a>
                              <?php } ?>
                           <?php }else{ ?>
                                <a href="javascript:void(0)" id="remember_<?php echo $ada["classifieds"]["id"]; ?>" class="remember_log" main="<?php echo $ada["classifieds"]["id"]; ?>"><i class="fa fa-heart-o"></i></a>
                           <?php } ?>
                          
                          </div>
                          <div class="clearfix"></div>
                        </div>
                     </div>
                     
                     <div class="clearfix"></div>
                   </div>
                   <?php } } }else{ ?>
                   <div class="right_box_list">
                        <div class="well"><h2><?php echo $lang["No Result Found"]; ?> </h2></div>
                    </div>
                   <?php } ?>
                 </div>
             </div>
          </div>  
          <?php if(!empty($adddata)){ ?>
          <div class="pagination_box">
            <nav>
              <ul class="pagination">
              <?php
                  if(isset($add_count)){
                   $lim = Configure::read('limit');
                   $m_c = ceil($add_count/$lim);
                   $count = 0;
                   if($off <= 0){
                    }else{ ?> 
                    <li>
                        <a href="javascript:void(0)" class="paginate_mag" main="<?php echo $off-1; ?>" aria-label="Previous">
                          <span aria-hidden="true"><?php echo $lang["Previous"];?></span>
                        </a>
                    </li>
                <?php } ?>
                <?php for($i = 1; $i <= $m_c; $i++) { ?>
                  <?php if($off+1 == $i){?>
                      <li><a href="javascript:void(0)" class="paginate_mag active" main="<?php echo $count; ?>"><?php echo $i; ?></a></li>
                  <?php  }else{ ?>
                      <li><a href="javascript:void(0)" class="paginate_mag" main="<?php echo $count; ?>"><?php echo $i; ?></a></li>
                  <?php } $count++; } ?>
                  <?php if($off >= $m_c-1){
                    }else{ ?>
                      <li>
                        <a href="javascript:void(0)" class="paginate_mag" main="<?php echo $off+1; ?>" aria-label="Next">
                          <span aria-hidden="true"><?php echo $lang["Next"];?></span>
                        </a>
                      </li>
                  <?php } } ?>
              </ul>
            </nav>
          </div>
          <?php } ?>
          <div class="save_row">
             <label><?php echo $lang["Do you want to save the current search criteria?"]; ?> </label>
             <?php if(!empty($user)){ ?>
             <a href="javascript:void(0)" class="save_btn save_search">Save Search</a>
             <?php }else{ ?>
             <a href="javascript:void(0)" class="save_btn save_search_log">Save Search</a>
             <?php } ?>
          </div>
       </div>
    </div>
</div>

<input type="hidden" id="hid_maincategory" main="<?php echo (isset($data["hid_main"]) && !empty($data["hid_main"]))? $data["hid_main"] : ""; ?>" value="<?php echo (isset($data["m_id"]) && !empty($data["m_id"]))? $data["m_id"] : ""; ?>">
<input type="hidden" id="hid_category" main="<?php echo (isset($data["hid_cat"]) && !empty($data["hid_cat"]))? $data["hid_cat"] : ""; ?>" value="<?php echo (isset($data["c_id"]) && !empty($data["c_id"]))? $data["c_id"] : ""; ?>">
<input type="hidden" id="hid_subcategory" main="<?php echo (isset($data["hid_scat"]) && !empty($data["hid_scat"]))? $data["hid_scat"] : ""; ?>" value="<?php echo (isset($data["s_id"]) && !empty($data["s_id"]))? $data["s_id"] : ""; ?>">
<input type="hidden" id="hid_filter" value="<?php echo (isset($data["fap"]) && !empty($data["fap"]))? $data["fap"] : ""; ?>">
<input type="hidden" id="search_by_ad" value="<?php echo (isset($data["ad"]) && !empty($data["ad"]))? $data["ad"] : 1; ?>">
<input type="hidden" id="view_style" value="<?php echo (isset($data["view"]) && !empty($data["view"]))? $data["view"] : "list"; ?>">
<input type="hidden" id="sort_view" value="<?php echo (isset($data["order"]) && !empty($data["order"]))? $data["order"] : 0; ?>">
<input type="hidden" id="hid_place" main="<?php echo (isset($data["pm"]) && !empty($data["pm"]))? $data["pm"] : ""; ?>" value="<?php echo (isset($data["place"]) && !empty($data["place"]))? $data["place"] : ""; ?>">
<input type="hidden" id="hid_city" value="<?php echo (isset($data["city"]) && !empty($data["city"]))? $data["city"] : ""; ?>">
<input type="hidden" id="hid_radius" value="<?php echo (isset($data["radius"]) && !empty($data["radius"]))? $data["radius"] : ""; ?>">

<!--conten sec end-->

<script>
  $(document).ready(function(){
      var surl = "<?php echo $this->webroot; ?>classified";
      var data = <?php  echo json_encode($data); ?>;
      
      /* For load filters */
      if(typeof data.fap != "undefined")
      { 
          var s_id = "";
          if(typeof data.s_id != "undefined")
          {
            s_id = data.s_id;
          }

          $("#load_filter").load("<?php echo $this->webroot; ?>classifieds/"+data.fap+"?s_id="+s_id,function(){
              if(typeof data.jt != "undefined")
              {
                  if(data.jt == 1)
                  { 
                     $(".load_offer_Page").load("<?php echo $this->webroot; ?>classifieds/filter_jobtype_off");
                  }
              }
          });  
      }

      /* Set view of page */
      $("body").on("click",".search_by_ad", function(){
          var val = $(this).attr("main");
          $("#search_by_ad").val(val);
      });
      
       /* Search by left sub category */
      $("body").on("click",".left_subcategory", function(){
          var s_id = $(this).attr("main");
          var s_name = $(this).attr("s_name");
          $("#hid_subcategory").val(s_id).attr("main",s_name);
      });

      /* Set view style value */
      $("body").on("click", ".view_style", function(){
          var val = $(this).attr("main"); 
          $("#view_style").val(val);
      });

      /* Set order value */
      $("body").on("change",".sort_view", function(){
          var val = $(this).val();
          $("#sort_view").val(val);
      });

      /* Set Left State */
      $("body").on("click",".left_state", function(){
          var id = $(this).attr("main");
          var name = $(this).text().trim();
          $("#hid_place").val(id).attr("main",name);
          $("#hid_city").val("");
      });

      /* Set Left City */
      $("body").on("click",".left_city", function(){
          var name = $(this).attr("main").trim();
          $("#hid_city").val(name);
      });

      /* Set Left Country*/
      $("body").on("click",".left_country", function(){
          $("#hid_place").val("");
          $("#hid_city").val("");
      });

      /* Set Radius */
      $("body").on("click",".search_radius", function(){
          var val = $(this).attr("main");
          var name = $(this).text().trim();
          $(".radius_keyword").text(name);
          $("#hid_radius").val(val);
      });

      /* Search by Main category on click */
      $("body").on("click", ".main_category,.left_maincategory", function(){
          var url = [];
          var keyword =  $(".input_keyword").val();
          var m_id = $(this).attr("main");
          var m_name = $(this).attr("m_name").trim();
          var loc = $(".region_city").val();
          var ad = $("#search_by_ad").val();
          var view = $("#view_style").val();
          var order = $("#sort_view").val();
          var radius = $("#hid_radius").val();
          $("#hid_maincategory").val(m_id).attr("main",m_name);
          if(loc != "")
          {
            url.push("loc="+loc);
            surl += "/"+loc;
          }
          
          if(m_id != "")
          {
            url.push("m_id="+m_id);
            surl += "/"+m_name;
          }else
          {
            surl += "/allads";
          }
          if(keyword != "")
          {
            url.push("keyword="+keyword);
            surl += "/q-"+keyword;
          }
          if(radius != "")
          {
            url.push("radius="+radius);
          }
          
          url.push("ad="+ad);
          url.push("view="+view);
          url.push("order="+order);
          var strg = url.join("&");
          var newurl = surl+"?"+strg;
          window.location.href = newurl;
      });

      /* Search by category on click */
      $("body").on("click",".cat_category,.left_category", function(){
          var url = [];
          var keyword =  $(".input_keyword").val();
          var c_id = $(this).attr("main");
          var c_name = $(this).attr("c_name").trim();
          var m_id = $(this).attr("m_id");
          var m_name = $(this).attr("m_name").trim();
          var loc = $(".region_city").val();
          var ad = $("#search_by_ad").val();
          var fap = $(this).attr("fap").trim();
          var view = $("#view_style").val();
          var order = $("#sort_view").val();
          var radius = $("#hid_radius").val();
          $("#hid_maincategory").val(m_id).attr("main",m_name);
          $("#hid_category").val(c_id).attr("main",c_name);
          if(loc != "")
          {
            url.push("loc="+loc);
            surl += "/"+loc;
          }
          
          if(m_id != "")
          {
            url.push("m_id="+m_id);
            surl += "/"+m_name;
          }else
          {
            surl += "/allads";
          }

          if(c_id != "")
          {
            url.push("c_id="+c_id);
            surl += "/"+c_name;
          }
          if(keyword != "")
          {
            url.push("keyword="+keyword);
            surl += "/q-"+keyword;
          }
          if(fap != "")
          {
            url.push("fap="+fap);
          }
          if(radius != "")
          {
            url.push("radius="+radius);
          }
          url.push("ad="+ad);
          url.push("view="+view);
          url.push("order="+order);
          var strg = url.join("&");
          var newurl = surl+"?"+strg;
          window.location.href = newurl;
      });
  
      /* Search by Search Button */
      $("body").on("click", ".search_add", function(){
          var url = [];
          var keyword =  $(".input_keyword").val();
          var m_id = $("#hid_maincategory").val();
          var m_name = $("#hid_maincategory").attr("main").trim();
          var c_id = $("#hid_category").val();
          var c_name = $("#hid_category").attr("main").trim();
          var loc = $(".region_city").val();
          var fap = $("#hid_filter").val();
          var ad = $("#search_by_ad").val();
          var view = $("#view_style").val();
          var order = $("#sort_view").val();
          var radius = $("#hid_radius").val();
          if(loc != "")
          {
            url.push("loc="+loc);
            surl += "/"+loc;
          }
          
          if(m_id != "")
          {
            url.push("m_id="+m_id);
            surl += "/"+m_name;
          }

          if(c_id != "")
          {
            url.push("c_id="+c_id);
            url.push("fap="+fap);
            surl += "/"+c_name;
          }
          
          if(keyword != "")
          {
            url.push("keyword="+keyword);
            surl += "/q-"+keyword;
          }
          if(radius != "")
          {
            url.push("radius="+radius);
          }
          
          url.push("ad="+ad);
          url.push("view="+view);
          url.push("order="+order);
          var strg = url.join("&");
          var newurl = surl+"?"+strg;
          window.location.href = newurl;
      });
     
      /** Search By Filters **/
      $("body").on("change","#position_type,#salary_range1,#salary_range2,.salary_period,.post_type,#select_price2,.condition_type,.model,#select_year2,.fuel_type,#select_km2,.typeofadd,.furnished,.select_room,#sort_ms2,#job_type,.sort_view", function(){
          var url = [];
          var keyword =  $(".input_keyword").val();
          var m_id = $("#hid_maincategory").val();
          var m_name = $("#hid_maincategory").attr("main").trim();
          var loc = $(".region_city").val();
          var c_id = $("#hid_category").val();
          var c_name = $("#hid_category").attr("main");
          var s_id = $("#hid_subcategory").val();
          var s_name = $("#hid_subcategory").attr("main");
          var fap = $("#hid_filter").val();
          var adt = $('.post_type:checked').val();
          var price1 = $('#select_price1').val();
          var price2 = $('#select_price2').val();
          var cond_type = $(".condition_type:checked").val();
          var model = $(".model").val();
          var year1 = $('#select_year1').val();
          var year2 = $('#select_year2').val();
          var fuel = $('.fuel_type:checked').map(function()
                        {
                            return "'"+$(this).val()+"'";
                        }).get();

          var km1 = $('#select_km1').val();
          var km2 = $('#select_km2').val();
          var at = $(".typeofadd:checked").val();
          var fur = $(".furnished:checked").val();
          var room = $('.select_room:checked').map(function()
                        {
                            return $(this).val();
                        }).get();
          var ms1 = $('#sort_ms1').val();
          var ms2 = $('#sort_ms2').val();
          var jt = $("#job_type").val();
          var sp = $('.salary_period:checked').map(function()
                        {
                            return "'"+$(this).val()+"'";
                        }).get();

          var sr1 = $('#salary_range1').val();
          var sr2 = $('#salary_range2').val();
          var pt = $("#position_type").val();
          var ad = $("#search_by_ad").val();
          var view = $("#view_style").val();
          var order = $("#sort_view").val();
          var place = $("#hid_place").val();
          var place_name = $("#hid_place").attr("main");
          var city = $("#hid_city").val();
          var radius = $("#hid_radius").val();

          if(loc != "")
          {
            url.push("loc="+loc);
            surl += "/"+loc;
          }
          

          url.push("m_id="+m_id);
          surl += "/"+m_name;

          if(c_id != "")
          {
            url.push("c_id="+c_id);
            surl += "/"+c_name;
          }
          
          if(s_id != "")
          {
            url.push("s_id="+s_id);
            surl += "/"+s_name;
          }

          if(place != "")
          {
            url.push("place="+place);
            url.push("pm="+place_name);
          }

          if(city != "")
          {
            url.push("city="+city);
            surl += "/"+city; 
          }else if(place != "")
          {
            surl += "/"+place_name;
          }
          
          if(keyword != "")
          {
            url.push("keyword="+keyword);
            surl += "/"+keyword;
          }
          if(fap != "")
          {
            url.push("fap="+fap);
          }
          if(adt != "" &&  adt != undefined)
          {
            url.push("adt="+adt);
          }

          if((price1 != undefined && price2 != undefined) && (price1 != "" && price2 != ""))
          {
             url.push("price1="+price1);
             url.push("price2="+price2);
          }

          if(cond_type != "" &&  cond_type != undefined)
          {
            url.push("cond_type="+cond_type);
          }

          if(model != "" && model != undefined)
          {
            url.push("model="+model);
          }

          if((year1 != undefined && year2 != undefined) && (year1 != "" && year2 != ""))
          {
             url.push("year1="+year1);
             url.push("year2="+year2);
          }

          if(fuel != "")
          { 
            fuel = btoa(fuel);
            url.push("fuel="+fuel);
          }

          if((km1 != undefined && km2 != undefined) && (km1 != "" && km2 != ""))
          {
             url.push("km1="+km1);
             url.push("km2="+km2);
          }

          if(at != "" &&  at != undefined)
          {
            url.push("at="+at);
          }

          if(fur != "" &&  fur != undefined)
          {
            url.push("fur="+fur);
          }

          if(room != "")
          { 
            room = btoa(room);
            url.push("room="+room);
          }

          if((ms1 != undefined && ms2 != undefined) && (ms1 != "" && ms2 != ""))
          {
             url.push("ms1="+ms1);
             url.push("ms2="+ms2);
          }

          if(jt != undefined && jt != "")
          {
            url.push("jt="+jt);
          }

          if(sp != "")
          { 
            sp = btoa(sp);
            url.push("sp="+sp);
          }

          if(sr1 != "" &&  sr1 != undefined)
          {
            url.push("sr1="+sr1);
          }
          
          if(sr2 != "" &&  sr2 != undefined)
          {
            url.push("sr2="+sr2);
          }

          if(pt != "" &&  pt != undefined)
          {
            url.push("pt="+pt);
          }  
          if(radius != "")
          {
            url.push("radius="+radius);
          }
          url.push("ad="+ad);
          url.push("view="+view);
          url.push("order="+order);
          var strg = url.join("&");
          var newurl = surl+"?"+strg;
          window.location.href = newurl;
      });

      /** Search By Filters Ad with / without photo **/
      $("body").on("click",".search_by_ad,.left_subcategory,.view_style,.left_state,.left_city,.left_country", function(){
          var url = [];
          var keyword =  $(".input_keyword").val();
          var m_id = $("#hid_maincategory").val();
          var m_name = $("#hid_maincategory").attr("main").trim();
          var loc = $(".region_city").val();
          var c_id = $("#hid_category").val();
          var c_name = $("#hid_category").attr("main");
          var s_id = $("#hid_subcategory").val();
          var s_name = $("#hid_subcategory").attr("main");
          var fap = $("#hid_filter").val();
          var adt = $('.post_type:checked').val();
          var price1 = $('#select_price1').val();
          var price2 = $('#select_price2').val();
          var cond_type = $(".condition_type:checked").val();
          var model = $(".model").val();
          var year1 = $('#select_year1').val();
          var year2 = $('#select_year2').val();
          var fuel = $('.fuel_type:checked').map(function()
                        {
                            return "'"+$(this).val()+"'";
                        }).get();

          var km1 = $('#select_km1').val();
          var km2 = $('#select_km2').val();
          var at = $(".typeofadd:checked").val();
          var fur = $(".furnished:checked").val();
          var room = $('.select_room:checked').map(function()
                        {
                            return $(this).val();
                        }).get();
          var ms1 = $('#sort_ms1').val();
          var ms2 = $('#sort_ms2').val();
          var jt = $("#job_type").val();
          var sp = $('.salary_period:checked').map(function()
                        {
                            return "'"+$(this).val()+"'";
                        }).get();

          var sr1 = $('#salary_range1').val();
          var sr2 = $('#salary_range2').val();
          var pt = $("#position_type").val();
          var ad = $("#search_by_ad").val();
          var view = $("#view_style").val();
          var order = $("#sort_view").val();
          var place = $("#hid_place").val();
          var place_name = $("#hid_place").attr("main");
          var city = $("#hid_city").val();
          var radius = $("#hid_radius").val();

          if(loc != "")
          {
            url.push("loc="+loc);
            surl += "/"+loc;
          }
          
          url.push("m_id="+m_id);
          surl += "/"+m_name;                   
          if(c_id != "")
          {
            url.push("c_id="+c_id);
            surl += "/"+c_name;
          }
          if(s_id != "")
          {
            url.push("s_id="+s_id);
            surl += "/"+s_name;
          }

          if(place != "")
          {
            url.push("place="+place);
            url.push("pm="+place_name);
          }

          if(city != "")
          {
            url.push("city="+city);
            surl += "/"+city; 
          }else if(place != "")
          {
            surl += "/"+place_name;
          }

          if(keyword != "")
          {
            url.push("keyword="+keyword);
            surl += "/q-"+keyword;
          }
          if(fap != "")
          {
            url.push("fap="+fap);
          }
          if(adt != "" &&  adt != undefined)
          {
            url.push("adt="+adt);
          }

          if((price1 != undefined && price2 != undefined) && (price1 != "" && price2 != ""))
          {
             url.push("price1="+price1);
             url.push("price2="+price2);
          }

          if(cond_type != "" &&  cond_type != undefined)
          {
            url.push("cond_type="+cond_type);
          }

          if(model != "" && model != undefined)
          {
            url.push("model="+model);
          }

          if((year1 != undefined && year2 != undefined) && (year1 != "" && year2 != ""))
          {
             url.push("year1="+year1);
             url.push("year2="+year2);
          }

          if(fuel != "")
          { 
            fuel = btoa(fuel);
            url.push("fuel="+fuel);
          }

          if((km1 != undefined && km2 != undefined) && (km1 != "" && km2 != ""))
          {
             url.push("km1="+km1);
             url.push("km2="+km2);
          }

          if(at != "" &&  at != undefined)
          {
            url.push("at="+at);
          }

          if(fur != "" &&  fur != undefined)
          {
            url.push("fur="+fur);
          }

          if(room != "")
          { 
            room = btoa(room);
            url.push("room="+room);
          }

          if((ms1 != undefined && ms2 != undefined) && (ms1 != "" && ms2 != ""))
          {
             url.push("ms1="+ms1);
             url.push("ms2="+ms2);
          }

          if(jt != undefined && jt != "")
          {
            url.push("jt="+jt);
          }

          if(sp != "")
          { 
            sp = btoa(sp);
            url.push("sp="+sp);
          }

          if(sr1 != "" &&  sr1 != undefined)
          {
            url.push("sr1="+sr1);
          }
          
          if(sr2 != "" &&  sr2 != undefined)
          {
            url.push("sr2="+sr2);
          }

          if(pt != "" &&  pt != undefined)
          {
            url.push("pt="+pt);
          }
           
          if(radius != "")
          {
            url.push("radius="+radius);
          } 
          url.push("ad="+ad);
          url.push("view="+view);
          url.push("order="+order);
          var strg = url.join("&");
          var newurl = surl+"?"+strg;
          window.location.href = newurl;
      });
      
      /** pagination search **/
      $("body").on("click",".paginate_mag", function(){
          var url = [];
          var keyword =  $(".input_keyword").val();
          var m_id = $("#hid_maincategory").val();
          var m_name = $("#hid_maincategory").attr("main").trim();
          var loc = $(".region_city").val();
          var c_id = $("#hid_category").val();
          var c_name = $("#hid_category").attr("main");
          var s_id = $("#hid_subcategory").val();
          var s_name = $("#hid_subcategory").attr("main");
          var fap = $("#hid_filter").val();
          var adt = $('.post_type:checked').val();
          var price1 = $('#select_price1').val();
          var price2 = $('#select_price2').val();
          var cond_type = $(".condition_type:checked").val();
          var model = $(".model").val();
          var year1 = $('#select_year1').val();
          var year2 = $('#select_year2').val();
          var fuel = $('.fuel_type:checked').map(function()
                        {
                            return "'"+$(this).val()+"'";
                        }).get();

          var km1 = $('#select_km1').val();
          var km2 = $('#select_km2').val();
          var at = $(".typeofadd:checked").val();
          var fur = $(".furnished:checked").val();
          var room = $('.select_room:checked').map(function()
                        {
                            return $(this).val();
                        }).get();
          var ms1 = $('#sort_ms1').val();
          var ms2 = $('#sort_ms2').val();
          var jt = $("#job_type").val();
          var sp = $('.salary_period:checked').map(function()
                        {
                            return "'"+$(this).val()+"'";
                        }).get();

          var sr1 = $('#salary_range1').val();
          var sr2 = $('#salary_range2').val();
          var pt = $("#position_type").val();
          var off = $(this).attr("main");
          var ad = $("#search_by_ad").val();
          var view = $("#view_style").val();
          var order = $("#sort_view").val();
          var place = $("#hid_place").val();
          var place_name = $("#hid_place").attr("main");
          var city = $("#hid_city").val();
          var radius = $("#hid_radius").val();

          if(loc != "")
          {
            url.push("loc="+loc);
            surl += "/"+loc;
          }
          
          if(m_id != "")
          {
            url.push("m_id="+m_id);
            surl += "/"+m_name;
          }
          
          if(c_id != "")
          {
            url.push("c_id="+c_id);
            surl += "/"+c_name;
          }
          if(s_id != "")
          {
            url.push("s_id="+s_id);
            surl += "/"+s_name;
          }
          if(place != "")
          {
            url.push("place="+place);
            url.push("pm="+place_name);
          }

          if(city != "")
          {
            url.push("city="+city);
            surl += "/"+city; 
          }else if(place != "")
          {
            surl += "/"+place_name;
          }
          if(keyword != "")
          {
            url.push("keyword="+keyword);
            surl += "/q-"+keyword;
          }
          if(fap != "")
          {
            url.push("fap="+fap);
          }
          if(adt != "" &&  adt != undefined)
          {
            url.push("adt="+adt);
          }

          if((price1 != undefined && price2 != undefined) && (price1 != "" && price2 != ""))
          {
             url.push("price1="+price1);
             url.push("price2="+price2);
          }

          if(cond_type != "" &&  cond_type != undefined)
          {
            url.push("cond_type="+cond_type);
          }

          if(model != "" && model != undefined)
          {
            url.push("model="+model);
          }

          if((year1 != undefined && year2 != undefined) && (year1 != "" && year2 != ""))
          {
             url.push("year1="+year1);
             url.push("year2="+year2);
          }

          if(fuel != "")
          { 
            fuel = btoa(fuel);
            url.push("fuel="+fuel);
          }

          if((km1 != undefined && km2 != undefined) && (km1 != "" && km2 != ""))
          {
             url.push("km1="+km1);
             url.push("km2="+km2);
          }

          if(at != "" &&  at != undefined)
          {
            url.push("at="+at);
          }

          if(fur != "" &&  fur != undefined)
          {
            url.push("fur="+fur);
          }

          if(room != "")
          { 
            room = btoa(room);
            url.push("room="+room);
          }

          if((ms1 != undefined && ms2 != undefined) && (ms1 != "" && ms2 != ""))
          {
             url.push("ms1="+ms1);
             url.push("ms2="+ms2);
          }

          if(jt != undefined && jt != "")
          {
            url.push("jt="+jt);
          }

          if(sp != "")
          { 
            sp = btoa(sp);
            url.push("sp="+sp);
          }

          if(sr1 != "" &&  sr1 != undefined)
          {
            url.push("sr1="+sr1);
          }
          
          if(sr2 != "" &&  sr2 != undefined)
          {
            url.push("sr2="+sr2);
          }

          if(pt != "" &&  pt != undefined)
          {
            url.push("pt="+pt);
          }  
          
          if(radius != "")
          {
            url.push("radius="+radius);
          }
          url.push("off="+off);
          url.push("ad="+ad);
          url.push("view="+view);
          url.push("order="+order);
          var strg = url.join("&");
          var newurl = surl+"?"+strg;
          window.location.href = newurl;
      });
      
      /** Search Keywords **/
      $("body").on("keyup",".input_keyword", function(){
          var val = $(this).val().trim();
          if(val != "")
          {
            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifieds/searchkeywords",
                    type:"post",
                    data:{val:val},
                    dataType:"json",
                    success: function(data)
                    {
                        var p_list = "";
                        if(data.length > 0)
                        {
                          $.each(data, function(i,v){
                              p_list += '<p class="key_list">'+v["Tag"]["tag"]+'</p>';
                          });
                          $ (".show_place").html(p_list).show();
                        }else
                        {
                           p_list += '<p class="key_list">'+val+'</p>';
                           $ (".show_place").html(p_list).show();
                        }
                    }
            });
          }else
          {
            $(".show_place").html("").hide();
          }
      });

      /* Set Keywords*/
      $("body") .on("click",".key_list", function(){
          var val = $(this).text().trim();
          $(".input_keyword").val(val);
          $(".show_place").html("").hide();
      });

      /* Search region */
      $("body").on("keyup","#region_city", function(){
          var loc = $(this).val().trim();
          if(loc.length > 1)
          {
              $.ajax({
                      url:"<?php echo $this->webroot?>classifieds/getlocations",
                      type:"post",
                      data:{loc:loc},
                      dataType:"json",
                      success: function(data)
                      {
                          var p_list = "";
                          if(data.ldata.length > 0)
                          {
                            $.each(data.ldata, function(i,v){
                                p_list += '<p class="loc_list">'+v["classifieds"]["zipcode"]+"-"+v["classifieds"]["city"]+'</p>';
                            });
                            $ (".loc_place").html(p_list).show();
                          }else
                          {
                             $ (".loc_place").html("").hide();
                          }
                      }
              });
          }else
          {
            $ (".loc_place").html("").hide();
          }
      });
      
      $("body").on("click",".loc_list", function(){
          var val = $(this).text().trim();
          $("#region_city").val(val);
          $ (".loc_place").html("").hide();
      });

      $("body").click(function(){
        $(".show_place").html("").hide();
        $ (".loc_place").html("").hide();
      });

      $(".display_city").popover({
        html: true, 
        content: function() {
                return $('#show_all_cities').html();
              }
      }).on("click", function(){
        $('.popover').addClass("city_popover"); //Add class .dynamic-class to <div>
      });
  });

  function removeend(str)
  {
    var res = str.replace(" & ", "-"); 
    res = res.replace(" ", "-"); 
    return res;
  }
</script>