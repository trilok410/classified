<?php $lang = $this->Session->read('lang'); ?>
</section>
<!--conten sec start-->
<div class="conten">
  <div class="post_details">
       <div class="container">
         <div class="row">
            <div class="col-md-12 col-sm-12">
             <div class="post_main">
               <div class="post_left">
                  <h1><?php echo $lang["Edit Ad"]; ?></h1>
                  <form class="form-horizontal" id="post_adform" method="post" action="<?php echo $this->webroot ?>classifieds/updatepostadd" enctype="multipart/form-data">
                      <section class="form_section">
                        <div class="form_sec_inner">
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $lang["add title"]; ?><span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control hide1 show_tip" name="title" value="<?php echo $add["classifieds"]["title"]; ?>" id="addtitle" placeholder="" maxlength="70" required>
                                <div class="tooltip_box">
                                  <?php echo $tip[1]; ?>
                                </div>
                                <div class="title"><span class="addtitle_chr">70</span>characters left</div>
                              </div>
                            </div>
                            <div class="form-group cat_main">
                                <label for="Category" class="col-sm-3 control-label"><?php echo $lang["Category"]; ?><span>*</span></label>
                                <div class="col-sm-9">
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                           <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <h4 class="modal-title" id="myModalLabel"><?php echo $lang["Select"]." ".$lang["Category"]; ?></h4>
                                            </div>
                                            <div class="modal-body">
                                               <ul class="list_model">
                                                      <?php foreach($main_cat as $main){ ?>
                                                      <li>
                                                        <a href="javascript:void(0)" class="color_<?php echo $main["classified_maincategories"]["lead_cat"] ?> main_cat" main="<?php echo $main["classified_maincategories"]["m_id"] ?>" omg ="<?php echo $this->webroot.$main["files"]["base_url"]; ?>">
                                                            <img src="<?php echo $this->webroot.$main["files"]["base_url"]; ?>" class="img-responsive">
                                                              <span><?php echo utf8_encode($main["classified_maincategories"]["maincategory"]); ?></span>
                                                          </a>
                                                      </li>
                                                      <?php } ?>
                                                    <div class="clearfix"></div>
                                                </ul>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <!--category list start here-->
                                    <div class="category_list">
                                      <ul>
                                        <li class="cat_img"><img src="<?php echo $this->webroot.$add['files']['base_url']; ?>" class="img-responsive maincat_img"></li>
                                        <li class="cat_maincat"><?php echo $add["classified_maincategories"]["maincategory"]; ?> >></li>
                                        <li class="cat_cat"><?php echo $add["classified_category"]["category"]; ?></li>
                                        <?php if(!empty($add[0]["subcategory"])){ ?>
                                        <li class="cat_sub"> >> <?php echo $add[0]["subcategory"]; ?></li>
                                        <?php } ?>
                                        <li><a href="javascript:void(0)" class="change_btn change_maincat"><?php echo $lang["change"]; ?></a></li>
                                        <li><div class="change_icon"><i class="fa fa-check-circle"></i></div></li>
                                        <div class="clearfix"></div>
                                      </ul>
                                    </div>
                                    <div id="error_cat" style="color:red; display:none"><?php echo $lang["Please Choose Category"]; ?></div>
                                    <input type="hidden" id="main_cat" name="m_id" main="" value="<?php echo $add["classifieds"]["m_id"]; ?>" required>
                                    <input type="hidden" id="only_cat" name="c_id" main="" value="<?php echo $add["classifieds"]["c_id"]; ?>">
                                    <input type="hidden" id="sub_cat" name="s_id" main="" value="<?php echo $add["classifieds"]["s_id"]; ?>">
                                    <input type="hidden" id="pap_id" value=""> 
                                    <!--category list end here-->
                                </div>
                            </div>
                        </div>
                      </section>
                      <section class="form_section">
                        <div class="form_sec_inner">
                            <div id="load_pages">
                                <?php if($add["classifieds"]["post_type"] > 0){ ?>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label"><?php echo $lang["Ad type"]; ?><span>*</span></label>
                                    <div class="col-sm-9">
                                      <div class="radio_box">
                                          <label class="radio-inline"><input type="radio" name="post_type" value="1" <?php echo ($add["classifieds"]["post_type"] == 1)? "checked" : ""; ?> ><?php echo $lang["I want to Sell"]; ?></label>
                                          <label class="radio-inline"><input type="radio" name="post_type" value="2" <?php echo ($add["classifieds"]["post_type"] == 2)? "checked" : ""; ?>><?php echo $lang["I want to Buy"]; ?></label>
                                      </div>
                                    </div>
                                </div>
                                <?php }else if($add["classifieds"]["typeofadd"] > 0){  ?>
                                <div class="form-group">
                                    <label for="typeofadd" class="control-label col-sm-3">
                                        <?php echo $lang["Add"]." ".$lang["Type"]; ?>
                                    </label>
                                    <div class="col-sm-6">
                                        <div class="radio_sec">
                                        <label class="radio-inline">
                                          <input type="radio" name="typeofadd" id="typeofadd1" value="1" <?php echo ($add["classifieds"]["typeofadd"] == 1)? "checked" : ""; ?>><?php echo $lang["Rent"]; ?> 
                                        </label>
                                        <label class="radio-inline">
                                          <input type="radio" name="typeofadd" id="typeofadd2" value="2"<?php echo ($add["classifieds"]["typeofadd"] == 2)? "checked" : ""; ?>><?php echo $lang["Sell"]; ?> 
                                        </label>
                                        </div>
                                    </div>
                                </div>
                                <?php } if($add["classifieds"]["price"] > 0){  ?>
                                <div class="form-group">
                                  <div class="price_main">
                                      <label for="price" class="col-sm-3 control-label"><?php echo $lang["Price"]; ?><span>*</span></label>
                                      <div class="col-sm-9">
                                          <input type="text" class="form-control price" name="price" id="price" value="<?php echo $add["classifieds"]["price"]; ?>" required>
                                          <div class="price_short">, 00 EUR</div>
                                      </div>
                                      <div class="price_list">
                                        <ul>
                                            <!-- <li>00 EUR</li> -->
                                            <li><label class="radio-inline"><input type="radio" name="price_type" value="fixed"  <?php echo ($add["classifieds"]["price_type"] == "fixed")? "checked" : ""; ?>><?php echo $lang["Fixed price"]; ?></label></li>
                                            <li><label class="radio-inline"><input type="radio" name="price_type" value="negotiable" <?php echo ($add["classifieds"]["price_type"] == "negotiable")? "checked" : ""; ?>><?php echo $lang["Negotiable"]; ?></label></li>
                                            <li><label class="radio-inline"><input type="radio" name="price_type" value="to give away" <?php echo ($add["classifieds"]["price_type"] == "to give away")? "checked" : ""; ?>><?php echo $lang["To give away"]; ?></label></li>
                                            <div class="clearfix"></div>
                                        </ul>
                                      </div>
                                  </div>
                                </div>
                                <?php } if($add["classifieds"]["condition_type"] > 0){ ?>
                                <div class="form-group">
                                    <label for="condition_type" class="control-label col-sm-3">
                                      <?php echo $lang["Condition"]; ?>
                                    </label>
                                    <div class="col-sm-6">
                                      <div class="radio_sec">
                                        <label class="radio-inline">
                                          <input type="radio" name="condition_type" id="inlineRadio1" value="1" <?php echo ($add["classifieds"]["condition_type"] == 1)? "checked" : ""; ?>> <?php echo $lang["New"]; ?>
                                        </label>
                                        <label class="radio-inline">
                                          <input type="radio" name="condition_type" id="inlineRadio2" value="2" <?php echo ($add["classifieds"]["condition_type"] == 2)? "checked" : ""; ?>> <?php echo $lang["Used"]; ?>
                                        </label>
                                      </div>
                                    </div>
                                </div> 
                                <?php } if(!empty($add["classifieds"]["model"])){ ?>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="fuel"><?php echo $lang["Model"]; ?>*</label>
                                    <div class="col-sm-4">
                                      <select class="form-control" name="model" id="model" required>
                                          <option value=""><?php echo $lang["Select"]." ".$lang["Model"]; ?></option>
                                          <?php foreach($model as $mod){ ?>
                                          <option value="<?php echo $mod["Models"]["model"]; ?>" <?php echo ($mod["Models"]["model"] == $add["classifieds"]["model"])? "selected" : ""; ?> ><?php echo $mod["Models"]["model"]; ?></option>
                                          <?php } ?>
                                      </select>
                                    </div>
                                </div>
                                <?php } if(!empty($add["classifieds"]["year"])){ ?>
                                <div class="form-group">
                                    <label for="year" class="control-label col-sm-3">
                                        <?php echo $lang["Year"]; ?>*
                                    </label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control show_tip year" name="year" value="<?php echo $add["classifieds"]["year"]; ?>" id="year" maxlength="4" required>
                                    </div>
                                </div>
                                <?php } if(!empty($add["classifieds"]["fuel"])){ ?>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="fuel"><?php echo $lang["Fuel"]; ?>*</label>
                                    <div class="col-sm-4">
                                    <select class="form-control" name="fuel" id="fuel" required>
                                      <option selected disabled><?php echo $lang["Select"]." ".$lang["Fuel"]; ?></option>
                                      <option value="<?php echo $lang["Petrol"]; ?>" <?php echo ($add["classifieds"]["fuel"] == $lang["Petrol"])? "selected" : ""; ?>><?php echo $lang["Petrol"]; ?></option>
                                      <option value="<?php echo $lang["Diesel"]; ?>" <?php echo ($add["classifieds"]["fuel"] == $lang["Diesel"])? "selected" : ""; ?>><?php echo $lang["Diesel"]; ?></option>
                                      <option value="<?php echo $lang["LPG"]; ?>" <?php echo ($add["classifieds"]["fuel"] == $lang["LPG"])? "selected" : ""; ?>><?php echo $lang["LPG"]; ?></option>
                                      <option value="<?php echo $lang["CNG"]; ?>" <?php echo ($add["classifieds"]["fuel"] == $lang["CNG"])? "selected" : ""; ?>><?php echo $lang["CNG"]; ?></option>
                                    </select>
                                    </div>
                                </div>
                                <?php } if($add["classifieds"]["kilometer"] > 0){ ?>
                                <div class="form-group">
                                    <label for="kilometer" class="control-label col-sm-3">
                                        <?php echo $lang["KM's driven"]; ?>*
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control show_tip" name="kilometer" value="<?php echo $add["classifieds"]["kilometer"]; ?>" id="kilometer" required>
                                    </div>
                                </div>
                                <?php } if(!empty($add["classifieds"]["furnished"])){ ?>
                                <div class="form-group">
                                    <label for="furnished" class="control-label col-sm-3">
                                          <?php echo $lang["Furnished"]; ?>
                                    </label>
                                    <div class="col-sm-6">
                                      <div class="radio_sec">
                                        <label class="radio-inline">
                                          <input type="radio" name="furnished" id="furnished1" value="Yes" <?php echo ($add["classifieds"]["furnished"] == "Yes")? "checked" : ""; ?>><?php echo $lang["Yes"]; ?> 
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="furnished" id="furnished2" value="No" <?php echo ($add["classifieds"]["furnished"] == "No")? "checked" : ""; ?>><?php echo $lang["No"]; ?> 
                                        </label>
                                      </div>
                                    </div>
                                </div>
                                <?php } if($add["classifieds"]["rooms"] > 0){ ?>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="rooms"><?php echo $lang["Rooms"]; ?>*</label>
                                    <div class="col-sm-6">
                                    <select class="form-control" name="rooms" id="rooms" required>
                                      <option selected disabled><?php echo $lang["Select"]." ".$lang["Rooms"]; ?></option>
                                      <option value="1" <?php echo ($add["classifieds"]["rooms"] == 1)? "selected" : ""; ?>>1 <?php echo $lang["Rooms"]; ?></option>
                                      <option value="2" <?php echo ($add["classifieds"]["rooms"] == 2)? "selected" : ""; ?>>2 <?php echo $lang["Rooms"]; ?></option>
                                      <option value="3" <?php echo ($add["classifieds"]["rooms"] == 3)? "selected" : ""; ?>>3 <?php echo $lang["and More"]; ?></option>
                                    </select>
                                    </div>
                                </div>
                                <?php } if($add["classifieds"]["squaremeter"] > 0){ ?>
                                <div class="form-group">
                                    <label for="squaremeter" class="control-label col-sm-3">
                                        <?php echo $lang["Square Meters"]; ?>*
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control show_tip" name="squaremeter" value="<?php echo $add["classifieds"]["squaremeter"]; ?>" id="squaremeter" required>
                                    </div>
                                </div>
                                <?php } if($add["classifieds"]["job_type"] > 0){ ?>
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="add_type"><?php echo $lang["Type of ad"]; ?>*</label>
                                    <div class="col-sm-6">
                                    <select class="form-control" name="job_type" id="add_type" required>
                                      <option><?php echo $lang["Choose"]; ?></option>
                                      <option value="1" <?php echo ($add["classifieds"]["job_type"] == 1)? "selected" : ""; ?>><?php echo $lang["Offering job"]; ?></option>
                                      <option value="2" <?php echo ($add["classifieds"]["job_type"] == 2)? "selected" : ""; ?>><?php echo $lang["Seeking job"]; ?></option>
                                    </select>
                                    </div>
                                </div>
                                <?php } if($add["classifieds"]["job_type"] ==  1){ ?>
                                <div id="show_off_data">
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="salary_period"><?php echo $lang["Salary period"]; ?>*</label>
                                        <div class="col-sm-6">
                                        <select class="form-control" name="salary_period" id="salary_period" required>
                                          <option value=""><?php echo $lang["Choose"]; ?></option>
                                          <option value="hourly" <?php echo ($add["classifieds"]["salary_period"] == "hourly")? "selected" : ""; ?>><?php echo $lang["Hourly"]; ?></option>
                                          <option value="weekly" <?php echo ($add["classifieds"]["salary_period"] == "weekly")? "selected" : ""; ?>><?php echo $lang["Weekly"]; ?></option>
                                          <option value="monthly" <?php echo ($add["classifieds"]["salary_period"] == "monthly")? "selected" : ""; ?>><?php echo $lang["Monthly"]; ?></option>
                                          <option value="yearly" <?php echo ($add["classifieds"]["salary_period"] == "yearly")? "selected" : ""; ?>><?php echo $lang["Yearly"]; ?></option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="salary_range" class="control-label col-sm-3">
                                            <?php echo $lang["Salary range"]; ?>*
                                        </label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="salary_from" value="<?php echo $add["classifieds"]["salary_from"]; ?>" id="salary_range" placeholder="<?php echo $lang["From"]; ?>" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="salary_to" value="<?php echo $add["classifieds"]["salary_to"]; ?>" id="salary_range1" placeholder="<?php echo $lang["To"]; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="position_type"><?php echo $lang["Position type"]; ?>*</label>
                                        <div class="col-sm-6">
                                        <select class="form-control" name="position_type" id="position_type" required>
                                          <option value=""><?php echo $lang["Choose"]; ?></option>
                                          <option value="fulltime" <?php echo ($add["classifieds"]["position_type"] == "fulltime")? "selected" : ""; ?>><?php echo $lang["Full-time"]; ?></option>
                                          <option value="parttime" <?php echo ($add["classifieds"]["position_type"] == "parttime")? "selected" : ""; ?>><?php echo $lang["Part-time"]; ?></option>
                                          <option value="contract" <?php echo ($add["classifieds"]["position_type"] == "contract")? "selected" : ""; ?>><?php echo $lang["Contract"]; ?></option>
                                          <option value="temporary" <?php echo ($add["classifieds"]["position_type"] == "temporary")? "selected" : ""; ?>><?php echo $lang["Temporary"]; ?></option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                <div id="show_off_data" style="display:none">
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="salary_period"><?php echo $lang["Salary period"]; ?>*</label>
                                        <div class="col-sm-6">
                                        <select class="form-control" name="salary_period" id="salary_period">
                                          <option value=""><?php echo $lang["Choose"]; ?></option>
                                          <option value="hourly"><?php echo $lang["Hourly"]; ?></option>
                                          <option value="weekly"><?php echo $lang["Weekly"]; ?></option>
                                          <option value="monthly"><?php echo $lang["Monthly"]; ?></option>
                                          <option value="yearly"><?php echo $lang["Yearly"]; ?></option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="salary_range" class="control-label col-sm-3">
                                            <?php echo $lang["Salary range"]; ?>*
                                        </label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="salary_from" id="salary_range" placeholder="<?php echo $lang["From"]; ?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="salary_to" id="salary_range1" placeholder="<?php echo $lang["To"]; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-sm-3" for="position_type"><?php echo $lang["Position type"]; ?>*</label>
                                        <div class="col-sm-6">
                                        <select class="form-control" name="position_type" id="position_type">
                                          <option value=""><?php echo $lang["Choose"]; ?></option>
                                          <option value="fulltime"><?php echo $lang["Full-time"]; ?></option>
                                          <option value="parttime"><?php echo $lang["Part-time"]; ?></option>
                                          <option value="contract"><?php echo $lang["Contract"]; ?></option>
                                          <option value="temporary"><?php echo $lang["Temporary"]; ?></option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $lang["Tags"]; ?><span>*</span></label>
                              <div class="col-sm-9">
                                 <input type="text" class="form-control" name="tag_name" value="<?php echo $add["classifieds"]["tag_name"]; ?>" placeholder="Tags" required>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $lang["Ad Description"]; ?><span>*</span></label>
                              <div class="col-sm-9">
                               <textarea class="form-control show_tip" name="description" placeholder="<?php echo $lang["include the brand model"]; ?>" required><?php echo $add["classifieds"]["description"]; ?></textarea>
                               <div class="tooltip_box">
                                  <?php echo $tip[3]; ?>
                                </div>
                               <div class="title"><span class="description_chr">4096</span> characters left</div>
                              </div>
                            </div>
                            <div class="form-group image_block">
                              <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $lang["upload photos"]; ?><span>*</span>
                              <div class="upload_img"><img src="<?php echo $this->webroot; ?>images/upload.png" class="img-responsive"></div>
                              </label>
                              <div class="col-sm-9">
                                  <div class="img_filesec">
                                  <?php
                                      if(!empty($add_images))
                                      {
                                        $img_logoid = "";
                                        $i_count = count($add_images);
                                        foreach($add_images as $images){ ?>
                                        <div class="file_btn">
                                            <input type="file" class="input_img1" name="logo_image[]" style="display:none">
                                            <span class="glyphicon glyphicon-plus-sign input_img1" style="display:none"></span>
                                            <img class="show_img1" style="display: block;" alt="img" src="<?php echo $this->webroot.$images["files"]["base_url"]; ?>">
                                            <span class="fa fa-close remove_img" main="<?php echo $images["classifiedimages"]["logo_id"]; ?>"></span>
                                        </div>
                                        <?php $img_logoid .= $images["classifiedimages"]["logo_id"].","; ?>
                                  <?php } }  ?>
                                  <?php for($i = 1; $i <= (8 - $i_count); $i++){ ?>
                                      <div class="file_btn">
                                          <input type="file" class="input_img1" name="logo_image[]">
                                          <span class="glyphicon glyphicon-plus-sign input_img1"></span>

                                          <img class="show_img1" style="display:none" alt="img" src="">
                                          <span style="display:none" class="fa fa-close remove_img"></span>
                                      </div>
                                  <?php } ?>
                                      <input type="hidden" name="img_logoid" id="img_logoid" value="<?php echo $img_logoid; ?>">    
                                  </div> 
                                  <div class="tooltip_box image_tip">
                                    <?php echo $tip[4]; ?>
                                  </div>                           
                                  <div class="clearfix"></div>
                              </div>
                            </div>
                        </div>
                      </section>
                      <section class="form_section">
                        <div class="form_sec_inner">
                            <div class="location">
                               <h3><?php echo $lang["Location"]; ?></h3>
                               <div class="form-group" >
                                    <label for="name" class="col-sm-3 control-label"><?php echo $lang["Country"]; ?><span>*</span></label>
                                    <div class="col-sm-9">
                                      <select class="form-control country" name="country" required>
                                            <option value=""><?php echo $lang["Country"]; ?></option>
                                            <?php foreach($country as $cont){ ?>
                                            <option main="<?php echo $cont["countries"]["code"]; ?>" value="<?php echo $cont["countries"]["id"]; ?>" <?php echo ( $cont["countries"]["id"] == $add["classifieds"]["country"])? "selected" : "";  ?>><?php echo $cont["countries"]["name"]; ?></option>
                                            <?php } ?>
                                      </select>
                                    </div>
                               </div>
                               <div class="form-group" >
                                    <label for="name" class="col-sm-3 control-label"><?php echo $lang["State"]; ?><span>*</span></label>
                                    <div class="col-sm-9">
                                      <select class="form-control state" name="state" required>
                                            <option value="<?php echo $add["classifieds"]["state"]; ?>"><?php echo $add["states"]["name"]; ?></option>
                                      </select>
                                    </div>
                               </div>
                               <div class="form-group" >
                                    <label for="name" class="col-sm-3 control-label"><?php echo $lang["Zip Code"]; ?><span>*</span></label>
                                    <div class="col-sm-3">
                                      <input type="text" class="form-control zip zipcode" value="<?php echo $add["classifieds"]["zipcode"]; ?>" name="zipcode" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control city" value="<?php echo $add["classifieds"]["city"]; ?>" name="city" Placeholder="City" readonly="" required>
                                        <div class="show_place" style="display:none">
                                            
                                        </div>
                                    </div>
                               </div>
                               <div class="form-group">
                                  <label for="name" class="col-sm-3 control-label"><?php echo $lang["Address"]; ?><span>*</span></label>
                                  <div class="col-sm-9">
                                    <input type="text" name="street_no" class="form-control" value="<?php echo $add["classifieds"]["street_no"]; ?>" required>
                                  </div>
                               </div>
                            </div>
                            <h3><?php echo $lang["suplier details"]; ?></h3>
                            <div class="form-group">
                              <label for="name" class="col-sm-3 control-label"><?php echo $lang["provider type"]; ?><span>*</span></label>
                              <div class="col-sm-9">
                                <div class="radio_box">
                                <label class="radio-inline"><input type="radio" class="provider_type" value="private" name="provider" <?php echo ($add["classifieds"]["provider"] == "private")? "checked" : ""; ?> ><?php echo $lang["Private"]; ?></label>
                                <label class="radio-inline"><input type="radio" class="provider_type" value="commercial" name="provider" <?php echo ($add["classifieds"]["provider"] == "commercial")? "checked" : ""; ?> ><?php echo $lang["commercial"]; ?></label>
                                </div>
                              </div>
                            </div>
                            <div class="form-group current">
                              <label for="name" class="col-sm-3 control-label"><?php echo $lang["name"]; ?><span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $add["classifieds"]["name"]; ?>" name="name" id="name" placeholder="" required>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="email" class="col-sm-3 control-label"><?php echo $lang["Email"]; ?><span>*</span></label>
                              <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" value="<?php echo $add["classifieds"]["email"]; ?>" id="email" placeholder="" readonly>
                              </div>
                            </div>
                            <div class="form-group current">
                              <label for="text" class="col-sm-3 control-label"><?php echo $lang["Phone Number"]; ?><span>*</span></label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" value="<?php echo $add["classifieds"]["phone"]; ?>" name="phone" id="phone" placeholder="" maxlength="15" required>
                              </div>
                            </div>
                            <?php if($add["classifieds"]["provider"] == "commercial"){ ?>
                            <div class="form-group imprint">
                              <label for="text" class="col-sm-3 control-label"><?php echo $lang["Imprint"]; ?><span>*</span></label>
                              <div class="col-sm-9">
                                <textarea class="form-control show_tip imprint_text" name="imprint" required></textarea>
                                <div class="tooltip_box">
                                  <?php echo $tip[5]; ?>
                                </div>
                              </div>
                            </div>
                            <?php }else{ ?>
                            <div class="form-group imprint" style="display:none" >
                              <label for="text" class="col-sm-3 control-label"><?php echo $lang["Imprint"]; ?><span>*</span></label>
                              <div class="col-sm-9">
                                <textarea class="form-control show_tip imprint_text" name="imprint"></textarea>
                                <div class="tooltip_box">
                                  <?php echo $tip[5]; ?>
                                </div>
                              </div>
                            </div>
                            <?php } ?>
                        </div>
                      </section>
                      <section class="form_section">
                        <div class="form_sec_inner">
                         <div class="ad_box_head"> 
                           <h3><?php echo $lang["make your ad stand out"]; ?></h3>
                           <p><?php echo $lang["select an option to promote your ad"]; ?></p>
                         </div>
                         <?php foreach($p_mode as $mode){ ?>
                         <div class="ad_box_content">
                           <div class="abc_left">
                             <div class="checkbox">
                                <label>
                                   <input type="checkbox" class="prem_ad" value="<?php echo $mode["payment_modes"]["mode"]; ?>" name="feature[][name]"><p class="urgent"><?php echo $mode["payment_modes"]["title"]; ?></p> 
                                </label>
                                <input type="hidden" name="feat[<?php echo $mode["payment_modes"]["mode"]; ?>]" value="<?php echo $mode["payment_modes"]["days"]; ?> days-<?php echo $mode["payment_modes"]["price"]; ?>">
                                <?php echo $mode["payment_modes"]["description"]; ?><a href="javascript:void(0)" class="view_example" main="<?php echo $this->webroot.$mode["files"]["base_url"]; ?>">View Example</a>
                              </div>
                           </div>
                           <div class="abc_right"><?php echo $mode["payment_modes"]["days"]; ?> days-£<?php echo $mode["payment_modes"]["price"]; ?>
                           </div>
                           <div class="clearfix"></div>
                         </div>
                         <?php } ?>
                         <div class="ad_box_content">
                           <div class="abc_left">
                             <div class="checkbox">
                                <label>
                                   <input type="checkbox" class="feat_all"> <?php echo $lang["select all"]; ?>
                                </label>
                              </div>
                           </div>
                           <div class="abc_right"><?php echo $lang["all prices incl. VAT"]; ?>
                           </div>
                           <div class="clearfix"></div>
                         </div>
                      </section>
                       <div class="condition_box">
                          <div class="form-group">
                            <div class="col-sm-12">
                               <div class="terms_box">
                               <?php echo $lang["By clicking Submit Ad you accept our"]; ?> <a href="<?php echo $this->webroot; ?>classifieds/terms"><?php echo $lang["Terms of Use"]; ?></a> & <a href="<?php echo $this->webroot; ?>classifieds/privacy"> <?php echo $lang["Posting Rules"]; ?></a>
                               </div>
                            </div>
                          </div>
                       </div>
                      <input type="hidden" name="add_id" value="<?php echo $add["classifieds"]["id"]; ?>">
                      <button type="submit" class="btn btn-default btn_submit" id="submit_form"><?php echo $lang["Update"]; ?></button>
                      <button type="button" class="btn btn-danger btn_cancel" id="btn_cancel"><?php echo $lang["Cancel"]; ?></button>
                      <div class="clearfix"></div>
                  </form>
               </div>
             </div>
            </div>
         </div>
       </div>
    </div>
</div>
<!--conten sec end-->

<!-- Modal -->
<div class="modal fade" id="selcat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <section class="light_box">
          <div class="light_box_main">
              <div class="light_box_head">
                <h2><?php echo $lang["Category"]; ?></h2>
              </div>
              <div class="light_box_content">
                <ul class="list_light_box">
                    <?php foreach($main_cat as $main1){ ?>
                    <li><a href="javascript:void(0)" class="main_cat1" main="<?php echo $main1["classified_maincategories"]["m_id"] ?>"  omg ="<?php echo $this->webroot.$main1["files"]["base_url"]; ?>"> <span><?php echo utf8_encode($main1["classified_maincategories"]["maincategory"]); ?></span> <i class="fa fa-angle-right"></i></a></li>
                    <?php } ?>
                </ul>
              </div>
          </div>
          <div class="light_box_main">
              <div class="light_box_head">
                 <h2 class="second_head">Mobiles</h2>
              </div>
              <div class="light_box_content">
                 <ul class="list_light_box" id="cat_p2">
                   
                 </ul>
              </div>
          </div>
          <div class="light_box_main">
              <div class="light_box_head">
                 <h2 class="third_head"></h2>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               </div>
              <div class="light_box_content">
                 <ul class="list_light_box" id="cat_p3">
                   
                 </ul>
              </div>
          </div>
          <div class="clearfix"></div>
        </section>
      </div>
    </div>
  </div>
</div>
<!--model for category end-->

<!-- modal for view example Start  -->
<div id="view_example" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
              <img src="" class="img-responsive" id="pay_example">
          </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- modal for view example End  -->
<script type="text/javascript">
  $(document).ready(function(){
      var cat_hold = [];

      $("body").on("click",".show_tip", function(){
          $(this).parent().parent().addClass("active_bg");
          $(this).next("div").show();
      });

      $("body").on("blur",".show_tip", function(){
          $(this).parent().parent().removeClass("active_bg");
          $(this).next("div").hide();
      });

      $("body").on("mouseover",".image_block", function(){
            $(this).addClass("active_bg");
            $(".image_tip").show();
      });

      $("body").on("mouseout",".image_block", function(){
            $(this).removeClass("active_bg");
            $(".image_tip").hide();
      });

      $("body").on("change", ".provider_type", function(){
          var val = $(this).val();
          if(val == "commercial")
          {
              $(".imprint").show();
              $(".imprint_text").attr("required",true);

          }else
          {
            $(".imprint").hide();
            $(".imprint_text").attr("required",false);
          }
      });

      /* For select check all */
      $("body").on("click",".feat_all", function(){
          if(this.checked) {
              $(".prem_ad").each(function(){
                  this.checked = true;
              });
          }else
          {
            $('.prem_ad').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            }); 
          }
      });

      /* check that all checkbox are checked or not  */
      $("body").on("click",".prem_ad", function(){
          var count = 0;
          if(this.checked)
          {
            $(".prem_ad").each(function(){
                if(this.checked)
                {
                  count++;  
                }                
            });
          }else
          {
            $(".feat_all").prop("checked",false);
          }

          if(count == 3)
          {
            $(".feat_all").prop("checked",true); 
          }
      });

      /** Get State by country **/
      $("body").on("change", ".country", function(){
          var c_id =  $(this).val();
          if(c_id != "")
          {
              $.ajax({
                      url:"<?php echo $this->webroot; ?>classifieds/getstates",
                      type:"post",
                      data:{c_id:c_id},
                      dataType:"json",
                      success: function(data)
                      {
                          var j_list = "";
                          j_list = '<option value="">States</option>';
                          if(data.state != "")
                          { 
                             
                             $.each(data.state, function(i,st){
                                j_list += '<option value="'+st.states.id+'">'+st.states.name+'</option>';
                             });
                             $(".state").html(j_list);
                          }else{
                             $(".state").html(j_list);
                          }
                      }
              });
          }else
          {
            j_list = '<option value="">States</option>';
            $(".state").html(j_list);
          }
          $(".zipcode").val("");
          $(".city").val("");
      });

      /***  Get City by zipcode **/
      $("body").on("blur",".zipcode",function(){
          var val = $(this).val().trim();
          if(val != "" && val.length >= 5)
          {
            if($(".country").val() != "")
            {
              var code = $(".country option:selected").attr("main");
              $.ajax({
                  url:"http://api.zippopotam.us/"+code+"/"+val,
                  type:"get",
                  dataType:"json",
                  success: function(data)
                  {
                    var p_list = "";
                    $.each(data.places, function(i,pl){
                        p_list += '<p class="place_list">'+pl["place name"]+'</p>';
                    });

                    $ (".show_place").html(p_list).show();
                    $(".zipcode").removeClass("p_error");
                  },
                  error: function(resonse)
                  {
                      $ (".show_place").html("No Place found").show();
                      $(".zipcode").addClass("p_error");
                  }
              });
            }else
            {
              alert("Select Country First");
            }
          }
      });
  
      /* Set city*/
      $("body") .on("click",".place_list", function(){
          var city = $(this).text().trim();
          $ (".city").val(city);
          $ (".show_place").html("").hide();
      });

      /* Read img src */
      function readURL(input) {
        var cur = input;
        if (cur.files && cur.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(cur).hide();
                $(cur).next('span:first').hide();
                $(cur).next().next('img').attr('src', e.target.result);
                $(cur).next().next('img').css("display", "block");
                $(cur).next().next().next('span').attr('style' ,"");
            }

            reader.readAsDataURL(input.files[0]);
        }
      }

      $('.input_img1').change(function(){
          readURL(this);
      });

      $('.remove_img').click(function(){
            $(this).hide();
            var logo_id = $(this).attr("main");
            var image_old =  $('#img_logoid').val();
            var image_new = image_old.replace(logo_id+',','');
            $('#img_logoid').val(image_new);
            var cur = $(this).parent();
            cur.children('span:first').show();
            cur.children('input[type="file"]').val("");
            cur.children('input[type="file"]').show();
            cur.children('img').hide();
      });

      /* Validations */

      /* Check Numeric */
      $("body").on("keyup",'#price,#year,#kilometer,#phone',function(){
          var pattern = /^[0-9-+]+$/;
          var val = $(this).val();
          if(val !== "")
          {
            if(val.match(pattern))
            {
              $(this).removeClass("p_error");
            }else
            {
              $(this).addClass("p_error");
            }
          }
      });

      /* Check Empty fields*/
      $('body').on("click","#submit_form",function(){
          var m_id = $('#main_cat').val();
          var c_id = $('#only_cat').val();
          var city = $(".city").val();
          if(m_id == "" || c_id == "")
          {
              $('#error_cat').show();
              return false;
          }else{
              $('#error_cat').hide();
              //return true;
          }
          if(city == "")
          {
            $(".city").addClass("p_error");
          }else{
            $(".city").removeClass("p_error");
          }

          if($("#post_adform input").hasClass("p_error"))
          {
              return false;
          }
      });

      /* Check Email  */
      $("body").on("keypress blur","#email", function() {
          var email = $(this).val();
          var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if (regex.test(email)) {
              $(this).removeClass("p_error");
          } else {
              $(this).addClass("p_error");
          }
      });

      /* Cancel Edit Ad */
      $("body").on("click", "#btn_cancel", function(){
            window.location.href = "<?php echo $this->webroot; ?>users/myaccount";
      });

      /* Select job type*/
      $("body").on("change", "#add_type", function(){
          if($("option:selected",this).val() == 1)
          {
              $("#show_off_data").show();
              $("#show_off_data select, #show_off_data input").attr("required", true);

          }else{
              $("#show_off_data").hide();
              $("#show_off_data select, #show_off_data input").attr("required", false);
          }
      });

      /* Show title length */
      $("body").on("keyup","#addtitle", function(){
          var len = $(this).val().length;
          var nlen = 70 - len;
          $(".addtitle_chr").html(nlen);
      });

      /* show description length */
      $("body").on("keyup","#description", function(){
          var len = $(this).val().length;
          var nlen = 4096 - len;
          $(".description_chr").html(nlen);
      });

      $("body").on("click", ".view_example", function(){
          var url = $(this).attr("main");
          $("#pay_example").attr("src",url);
          $("#view_example").modal("show");
      });

      $("body").on("click", ".change_maincat", function(){
          $("#myModal").modal("show");
      });

      /* Select main category modal 1 */
      $("body").on("click",'.main_cat',function(){
          $('#cat_p3').hide();
          var id = $(this).attr("main");
          var m_id = btoa(id);
          var val = $(this).children("span").text().trim();
          var src = $(this).attr('omg');
          $(".second_head").text(val);
          cat_hold["m_id"] = id;
          cat_hold["m_n"] = val+" >>";
          cat_hold["c_img"] = src;

          $.ajax({
                  url:"<?php echo $this->webroot; ?>classifieds/getcategorybymid",
                  type:"post",
                  data:"m_id="+m_id,
                  dataType:"json",
                  beforeSend: function() {
                    // $('.loading').show();
                    // $('.loading_icon').show();
                  },
                  success: function(data)
                  {
                      $('#cat_p2').html(data.category);
                      $("#myModal").modal("hide");
                      $("#selcat").modal("show");
                      // $('.loading').hide();
                      // $('.loading_icon').hide();
                  }
          });
      });

      /* Select main category modal 2 */
      $("body").on("click",'.main_cat1',function(){
          $('#cat_p3').hide();
          var id = $(this).attr("main");
          var m_id = btoa(id);
          var val = $(this).children("span").text().trim();
          var src = $(this).attr('omg');
          $(".second_head").text(val);
          cat_hold["m_id"] = id;
          cat_hold["m_n"] = val+" >>";
          cat_hold["c_img"] = src;

          $.ajax({
                  url:"<?php echo $this->webroot; ?>classifieds/getcategorybymid",
                  type:"post",
                  data:"m_id="+m_id,
                  dataType:"json",
                  beforeSend: function() {
                    // $('.loading').show();
                    // $('.loading_icon').show();
                  },
                  success: function(data)
                  {
                      $('#cat_p2').html(data.category);
                      // $('.loading').hide();
                      // $('.loading_icon').hide();
                  }
          });
      });
      
      /* Select category modal 2 */
      $('#cat_p2').on('click','.category',function(){
          var id = $(this).attr("main");
          var c_id = btoa(id);
          var val = $(this).text().trim();
          var pap = $(this).attr('pap');
          $(".third_head").text(val);
          cat_hold["c_id"] = id;
          cat_hold["c_n"] = val+" >>";
          cat_hold["pap_id"] = pap;  
          
          $.ajax({
                  url:"<?php echo $this->webroot; ?>classifieds/getsubcategorybycid",
                  type:"post",
                  data:"c_id="+c_id,
                  dataType:"json",
                  beforeSend: function() {
                    //$('.loading').show();
                    //$('.loading_icon').show();
                  },
                  success: function(data)
                  {
                      $('#cat_p3').html(data.subcategory);
                      $('#cat_p3').show();
                      //$('.loading').hide();
                      //$('.loading_icon').hide();
                  }
          });
      });

      /* Select Sub category modal 2 */
      $('body').on('click','.final_step',function(){
          var id = $(this).attr("main");
          var val = $(this).text().trim();
          
          $('#main_cat').val(cat_hold["m_id"]);
          $('#only_cat').val(cat_hold["c_id"]);
          $('#sub_cat').val(id);
          $('#pap_id').val(cat_hold["pap_id"]);

          $('.maincat_img').attr('src',cat_hold["c_img"]);
          $('.cat_maincat').html(cat_hold["m_n"]);
          $('.cat_cat').html(cat_hold["c_n"]);
          $('.cat_sub').html(val);

          var pap = $('#pap_id').val();
          $('#load_pages').load('<?php echo $this->webroot; ?>classifieds/'+pap+'?s_id='+id,function(){
            $(".choose_cat").hide();
            $(".category_list").show();
            $('#selcat').modal('hide');
          });
      });

      /* Final step while sub category not present */
      $('body').on('click','.finalstep_cat',function(){
          var id = $(this).attr("main");
          var c_id = btoa(id);
          var val = $(this).text().trim();
          var pap = $(this).attr('pap');
          
          $('#main_cat').val(cat_hold["m_id"]);
          $('#only_cat').val(id);
          $('#sub_cat').val('0');
          $('#pap_id').val(pap);

          $('.maincat_img').attr('src',cat_hold["c_img"]);
          $('.cat_maincat').html(cat_hold["m_n"]);
          $('.cat_cat').html(val);
          $('.cat_sub').html("");
          
          var pap = $('#pap_id').val();
          $('#load_pages').load('<?php echo $this->webroot; ?>classifieds/'+pap,function(){
              $(".choose_cat").hide();
              $(".category_list").show();
              $('#selcat').modal('hide');
          });
      });
  });
</script>