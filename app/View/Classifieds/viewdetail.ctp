</section>
<?php $lang = $this->Session->read('lang'); ?>
<?php $user = $this->Session->read('user'); ?>
      
<!--conten sec start-->
    <div class="conten">
      <div class="product_details">
           <div class="container">
              <div class="row">
                 <?php if(!empty($add)){ ?>
                 <div class="col-md-8 col-sm-8">
                    <div class="product_slider">
                       <div class="product_slider_head">
                           <h2><?php echo $add["classifieds"]["title"]; ?></h2>
                           <ul class="list_slider_head">
                             <li>
                                <a href="javascript:void(0)">
                                  <div class="img_icon"><i class="fa fa-exclamation-circle"></i></div>
                                  <div class="img_icon_txt"><?php echo $lang["View"]." ".$add["classifieds"]["model"]." ".$add["classified_category"]["category"]." ".$lang["in"]." ".$add["classifieds"]["city"]; ?></div>
                                  <div class="clearfix"></div>
                                </a>
                             </li>
                             <div class="clearfix"></div>
                           </ul>
                       </div>
                       <div class="product_slider_box">
                          <?php if(!empty($user)){ ?>
                            <?php if(!empty($f_data) && in_array($add["classifieds"]["id"], $f_data)){ ?>
                              <a class="fav_btn bookmark_remove" href="javascript:void(0)" main="<?php echo $add["classifieds"]["id"]; ?>"><i class="fa fa-star mark_favorite"></i><?php echo $lang["mark as favorite"]; ?></a>
                            <?php }else{ ?>
                              <a class="fav_btn bookmark" href="javascript:void(0)" main="<?php echo $add["classifieds"]["id"]; ?>"><i class="fa fa-star"></i><?php echo $lang["mark as favorite"]; ?></a>  
                            <?php } ?>
                          <?php }else{ ?>
                              <a class="fav_btn bookmark_log" href="javascript:void(0)" main="<?php echo $add["classifieds"]["id"]; ?>"><i class="fa fa-star"></i><?php echo $lang["mark as favorite"]; ?></a>  
                          <?php } ?>
                          <div class="span12">
                              <div id="sync1" class="owl-carousel">
                                <?php if(!empty($add_images)){ 
                                      foreach($add_images as $images){ ?>
                                        <div class="item">
                                          <h1><img src="<?php echo $this->webroot.$images["files"]["base_url"]; ?>" class="img-responsive"></h1>
                                        </div>
                                <?php } }else{  ?>
                                          <div class="item"><h1><img src="<?php echo $this->webroot.$add["files"]["base_url"]; ?>" class="img-responsive"></h1></div>
                                <?php } ?>
                              </div>
                              <div id="sync2" class="owl-carousel">
                                <?php if(!empty($add_images)){ 
                                    foreach($add_images as $images1){ ?>
                                      <div class="item" ><h1><img src="<?php echo $this->webroot.$images1["files"]["base_url"]; ?>" class="img-responsive"></h1></div>
                                <?php } }else{ ?>
                                      <div class="item" ><h1><img src="<?php echo $this->webroot.$add["files"]["base_url"]; ?>" class="img-responsive"></h1></div>
                                <?php } ?>    
                              </div>
                              <div class="slider_list">
                                   <ul>
                                     <li><a href="javascript:void(0)" class="open_mail"><div class="slider_list_icon"><i class="fa fa-envelope-o"></i></div><div class="slider_list_txt"><?php echo $lang["To Contact"]; ?>   </div>
                                      <div class="clearfix"></div>
                                     </a></li>
                                     <li><a id="recommend" href="javascript:void(0)"><div class="slider_list_icon"><i class="flaticon1-social-network15"></i></div><div class="slider_list_txt"><?php echo $lang["Recommend"]; ?></div>
                                      <div class="clearfix"></div>
                                     </a></li>
                                     <li>
                                        <?php if(!empty($user)){ ?>
                                          <?php if(!empty($f_data) && in_array($add["classifieds"]["id"], $f_data)){ ?>
                                            <a href="javascript:void(0)" class="bookmark_remove" main="<?php echo $add["classifieds"]["id"]; ?>"><div class="slider_list_icon"><i class="fa fa-star mark_favorite"></i></div><div class="slider_list_txt"><?php echo $lang["Remember"]; ?></div>
                                               <div class="clearfix"></div>
                                            </a>
                                          <?php } else{ ?>
                                            <a href="javascript:void(0)" class="bookmark" main="<?php echo $add["classifieds"]["id"]; ?>"><div class="slider_list_icon"><i class="fa fa-star"></i></div><div class="slider_list_txt"><?php echo $lang["Remember"]; ?></div>
                                               <div class="clearfix"></div>
                                            </a>
                                          <?php } ?>
                                        <?php }else{ ?>
                                            <a href="javascript:void(0)" class="bookmark_log" main="<?php echo $add["classifieds"]["id"]; ?>"><div class="slider_list_icon"><i class="fa fa-star"></i></div><div class="slider_list_txt"><?php echo $lang["Remember"]; ?></div>
                                               <div class="clearfix"></div>
                                            </a>
                                        <?php } ?>   
                                     </li>
                                     <li><a id="report" href="javascript:void(0)"><div class="slider_list_icon"><i class="fa fa-envelope-o"></i></div><div class="slider_list_txt"><?php echo $lang["Report"]; ?></div>
                                      <div class="clearfix"></div>
                                     </a></li>
                                     <li><a href="javascript:void(0)"><div class="slider_list_icon"><i class="flaticon1-printer70"></i></div><div class="slider_list_txt print_page"><?php echo $lang["Push"]; ?></div>
                                      <div class="clearfix"></div>
                                     </a></li>
                                     <li><a target="_blank" href="https://www.facebook.com/sharer.php?u=http://<?php echo env('SERVER_NAME'); ?>/classifieds/viewdetail/<?php echo $add["classifieds"]["id"]; ?>"><div class="slider_list_icon"><i class="fa fa-facebook-square"></i></div><div class="slider_list_txt"><?php echo $lang["On Facebook"]; ?></div>
                                     <div class="clearfix"></div>
                                     </a></li>
                                     <div class="clearfix"></div>
                                   </ul>
                              </div>
                          </div>
                       </div>
                       <div class="form_sec recome" style="display: none;">
                          <div class="form_sec_head">
                             <h3><?php echo $lang["Recommend"]; ?></h3>
                             <div class="close_btn">
                                  <a href="javascript:void(0)"><i class="fa fa-times"></i></a>
                             </div>
                          </div>
                          <div class="form_sec_content" >
                             <form id="recommend_form">
                              <div class="row">
                                <div class="col-md-12 col-sm-12">
                                  <div class="form-group">
                                      <div class="alert alert-success recommend_alert" role="alert" style="display:none;"><?php echo $lang["Message"]." ".$lang["Send"]." ".$lang["Successfully"]; ?></div>
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $lang["Your"]." ".$lang["name"]; ?></label>
                                    <input type="text" placeholder="" id="exampleInputname" name="from_name" class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $lang["Recipient"]." ".$lang["Email"]." ".$lang["Address"]; ?></label>
                                    <input type="email" placeholder="Email" id="exampleInputEmail1" name="to_email" class="form-control input">
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $lang["Your"]." ".$lang["Email"]." ".$lang["Address"]; ?></label>
                                    <input type="email" placeholder="" id="exampleInputconfirmEmail1" name="from_email" class="form-control input">
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                    <label for="textarea"><?php echo $lang["Message"]; ?></label>
                                    <textarea class="form-control" name="message"></textarea>
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                  <div class="form-group">
                                   <input type="hidden" value="<?php echo $add["classifieds"]["id"]; ?>" name="ad_id"> 
                                   <button class="btn btn_sin recommend_id" type="button"><?php echo $lang["Send"]; ?></button>
                                  </div>
                                </div>
                              </div>
                             </form>
                          </div>
                       </div>
                       <div class="form_sec report" style="display: none;">
                         <div class="form_sec_head">
                           <h3><?php echo $lang["Suspected abuse"]; ?></h3>
                           <div class="close_btn">
                              <a href="javascript:void(0)"><i class="fa fa-times"></i></a>
                           </div>
                         </div>
                         <div class="form_sec_content">
                           <form id="report_form">
                            <div class="row">
                              <div class="col-md-12 col-sm-12">
                                  <div class="form-group">
                                      <div class="alert alert-success report_alert" role="alert" style="display:none;"><?php echo $lang["Message"]." ".$lang["Send"]." ".$lang["Successfully"]; ?></div>
                                  </div>
                                </div>
                              <div class="col-md-6 col-sm-6">
                                 <h5><?php echo $lang["Suspected abuse"]; ?></h5>
                                 <p>Geben Sie bitte rechts Ihre Daten ein, wenn Sie der Ansicht sind, dass dieses Inserat ein Betrugsversuch ist. Wir werden so schnell wie möglich diesem Verdachtsfall nachgehen.</p>
                              </div>
                              <div class="col-md-6 col-sm-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $lang["Your"]." ".$lang["name"]; ?></label>
                                <input type="text" placeholder="" id="exampleInputtxt" name="name" class="form-control input">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $lang["Your"]." ".$lang["Email"]." ".$lang["Address"]; ?></label>
                                <input type="email" placeholder="" id="exampleInputconfirmEmail1" name="email" class="form-control input">
                              </div>
                              <div class="form-group">
                                <label for="textarea"><?php echo $lang["Message"]; ?></label>
                                <textarea class="form-control input" name="message"></textarea>
                              </div>
                              <div class="form-group">
                               <input type="hidden" name="ad_id" value="<?php echo $add["classifieds"]["id"]; ?>">
                               <input type="hidden" name="report_type" value="ad">  
                               <button class="btn btn_sin report_id" type="button"><?php echo $lang["Send"]; ?></button>
                              </div>
                              </div>
                            </div>
                           </form>
                         </div>
                       </div>
                       <div class="details_box">
                          <h2><?php echo $lang["details"]; ?></h2>
                          <ul class="list_details">
                            <li><div class="list_details1"><?php echo $lang["Location"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["zipcode"]."  ".$add["classifieds"]["city"]; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <li><div class="list_details1"><?php echo $lang["creation date"]; ?></div><div class="list_details2"><?php echo date("d/m/Y", strtotime($add["classifieds"]["create_date"])); ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <li><div class="list_details1"><?php echo $lang["ad id"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["id"]; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <?php if(!empty($add[0]["subcategory"])){ ?>
                            <li><div class="list_details1"><?php echo $lang["Brand"]; ?></div><div class="list_details2"><?php echo $add[0]["subcategory"]; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <?php } if(!empty($add["classifieds"]["model"])){ ?>
                            <li><div class="list_details1"><?php echo $lang["Model"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["model"]; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <?php } if($add["classifieds"]["post_type"] > 0){ ?>
                             <li><div class="list_details1"><?php echo $lang["Ad type"]; ?></div><div class="list_details2"><?php echo ($add["classifieds"]["post_type"] == 1)? $lang['Sell'] :  $lang['Buy']; ?></div>
                              <div class="clearfix"></div>
                            </li>
                            <?php }else if($add["classifieds"]["typeofadd"] > 0){  ?>
                             <li><div class="list_details1"><?php echo $lang["Ad type"]; ?></div><div class="list_details2"><?php echo ($add["classifieds"]["typeofadd"] == 1)? $lang['Rent'] :  $lang['Sell']; ?></div>
                              <div class="clearfix"></div>
                            </li>
                            <?php } if($add["classifieds"]["condition_type"] > 0){ ?>
                             <li><div class="list_details1"><?php echo $lang["Condition"]." ".$lang["Type"]; ?></div><div class="list_details2"><?php echo ($add["classifieds"]["condition_type"] == 1)? $lang['New'] :  $lang['Used']; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <?php } if(!empty($add["classifieds"]["year"])){ ?>
                             <li><div class="list_details1"><?php echo $lang["Year"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["year"]; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <?php } if(!empty($add["classifieds"]["fuel"])){ ?>
                             <li><div class="list_details1"><?php echo $lang["Fuel"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["fuel"]; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <?php } if($add["classifieds"]["kilometer"] > 0){ ?>
                             <li><div class="list_details1"><?php echo $lang["KM's driven"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["kilometer"]; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <?php } if(!empty($add["classifieds"]["furnished"])){ ?>
                            <li><div class="list_details1"><?php echo $lang["Furnished"]; ?></div><div class="list_details2"><?php echo $lang[$add["classifieds"]["furnished"]]; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <?php } if($add["classifieds"]["rooms"] > 0){ ?>
                            <li><div class="list_details1"><?php echo $lang["Rooms"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["rooms"]." ".$lang["Rooms"]; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <?php } if($add["classifieds"]["squaremeter"] > 0){ ?>
                            <li><div class="list_details1"><?php echo $lang["Square Meters"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["squaremeter"]; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <?php } if($add["classifieds"]["job_type"] > 0){ ?>
                            <li><div class="list_details1"><?php echo $lang["Ad type"]; ?></div><div class="list_details2"><?php echo ($add["classifieds"]["job_type"] == 1)? $lang['Offering job'] :  $lang['Seeking job']; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <?php } if(!empty($add["classifieds"]["salary_period"])){ ?>
                            <li><div class="list_details1"><?php echo $lang["Salary period"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["salary_period"]; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <?php } if(!empty($add["classifieds"]["salary_from"]) && !empty($add["classifieds"]["salary_to"])){ ?>
                            <li><div class="list_details1"><?php echo $lang["Salary range"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["salary_from"]."-".$add["classifieds"]["salary_to"]; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <?php } if(!empty($add["classifieds"]["position_type"])){ ?>
                            <li><div class="list_details1"><?php echo $lang["Position type"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["position_type"]; ?></div>
                            <div class="clearfix"></div>
                            </li>
                            <?php } ?>
                            <li><div class="list_details1">Description</div>
                            <div class="list_details2"><?php echo nl2br($add["classifieds"]["description"]); ?></div>
                            <div class="clearfix"></div>
                            </li>
                          </ul>
                          <div class="description_box">
                          <h2><span><i class="fa fa-eye"></i><?php echo $view; ?></span></h2>
                          </div>
                       </div>
                    </div>
                 </div> 
                 <div class="col-md-4 col-sm-4">
                    <div class="sidebar">
                       <?php if($add["classifieds"]["price"] > 0){ ?> 
                       <div class="sidebar_head">
                          <h2>£ <?php echo $add["classifieds"]["price"]; ?></h2>
                       </div>
                       <?php }else if(!empty($add["classifieds"]["salary_from"])){ ?>
                       <div class="sidebar_head">
                          <h2>£ <?php echo $add["classifieds"]["salary_from"]." - ".$add["classifieds"]["salary_to"] ; ?></h2>
                       </div>
                       <?php } ?>
                       <div class="sidebar_name">
                         <div class="sidebar_name_img"><img src="<?php echo $this->webroot; ?>images/male-user.png"></div>
                         <div class="sidebar_name_txt"><a href="javascript:void(0)"><?php echo $add["classifieds"]["name"]; ?></a><!-- <span class="away">away</span> --><span>(<?php echo $lang["active on site since"]." ".yearago($add["users"]["created_date"],$lang); ?> )</span></div>
                         <div class="clearfix"></div>
                       </div>
                       <div class="sidebar_number">
                         <ul>
                           <li> <a href="#"><i class="flaticon1-phone72"></i> <span><?php echo $add["classifieds"]["phone"]; ?></span></a></li>

                         </ul>
                       </div>
                       <div class="seller_box">
                          <div class="email_form_head">
                            <h2 id="emailtog"><i class="fa fa-envelope"></i><?php echo $lang["email seller"]; ?></h2>
                          </div>
                          <div class="email_form">
                              <form id="send_mail">
                                    <div class="form-group">
                                      <label for="exampleInputname"><?php echo $lang["name"]; ?></label>
                                      <input type="text" placeholder="name" id="name" name="from_name" class="form-control input">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1"><?php echo $lang["Email"]." ".$lang["Address"]; ?></label>
                                      <input type="text" placeholder="Email" name="from_email" id="exampleInputEmail1" class="form-control input">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputname"><?php echo $lang["Mobile Number"]; ?></label>
                                      <input type="text" placeholder="" name="from_phone" id="phone" class="form-control">
                                    </div>
                                    <div class="checkbox">
                                      <label>
                                        <input type="checkbox" value="send_copy" name="send_copy"><?php echo $lang["Send me a copy"]; ?> 
                                      </label>
                                    </div>
                                    <textarea placeholder="message content" name="message"></textarea>
                                    <input type="hidden" value="<?php echo $add["users"]["email"]; ?>" name="to_email">
                                    <input type="hidden" value="<?php echo $add["users"]["name"]; ?>" name="name_email">
                                    <input type="hidden" value="<?php echo $add["classifieds"]["id"]; ?>" name="add_id">
                                    <input type="hidden" name="title_email" value="<?php echo $add["classifieds"]["title"]; ?>"> 
                                    <div class="seller_btn_box"><button type="button" class="seller_btn mail_send"><i class="fa fa-envelope"></i><?php echo $lang["Send"]; ?></button></div>
                              </form>
                          </div>
                       </div>
                       <?php if(!empty($user) && $user["id"] != $add["classifieds"]["user_id"]){ ?>
                       <div class="seller_box">
                          <div class="email_form_head">
                            <h2 id="msgtouser"><i class="fa fa-envelope"></i><?php echo $lang["Message"]; ?></h2>
                          </div>
                          <div class="msg_form" style="display:none;">
                              <form id="send_msg">
                                    <textarea placeholder="message content" name="message" id="user_msg"></textarea>
                                    <input type="hidden" value="<?php echo $add["classifieds"]["user_id"]; ?>" name="to_id">
                                    <div class="seller_btn_box"><button type="button" class="seller_btn msg_send"><i class="fa fa-envelope"></i><?php echo $lang["Send"]; ?></button></div>
                              </form>
                          </div>
                       </div>
                       <?php } ?>
                       
                       <div class="all_item"><a href="<?php echo $this->webroot; ?>classifieds/userads?id=<?php echo base64_encode($add["classifieds"]["user_id"]); ?>&ad_id=<?php echo base64_encode($add["classifieds"]["id"]); ?>"><?php echo $lang["all user ads"]; ?></a></div>
                       <div class="sidebar_bottom">
                         <h3><?php echo $lang["safety tips for buyers"]; ?></h3>
                         <ul class="list_sidebar">
                          <li><a href="#">meet seller at a sfe location</a></li>
                          <li><a href="#">meet seller at a sfe location</a></li>
                          <li><a href="#">meet seller at a sfe location</a></li>
                         </ul>
                         <div class="know_btn_box"><a href="#" class="know_btn"><?php echo $lang["View more"]; ?></a>
                          <div class="clearfix"></div>
                         </div>
                       </div>
                    </div>
                 </div>
                 <?php }else{ ?>
                 <div class="col-md-12 col-sm-12">
                    <div class="product_slider">
                       <div class="product_slider_head">
                            <h2><?php echo $lang["Ad Blocked"]; ?> </h2>
                       </div>
                    </div>
                 </div>
                 <?php } ?>
              </div>  
           </div>
        </div>
    </div>
    <!--conten sec end-->

<!-- print add -->
<div class="conten" id="contener" style="display:none;">
  <div class="product_details">
       <div class="container">
          <div class="row">
             <div class="col-md-8 col-sm-8">
                <div class="product_slider">
                   <div class="product_slider_head">
                       <h2 style="color: #0f90d2 !importent;"><?php echo $add["classifieds"]["title"]; ?></h2>
                       <ul class="list_slider_head">
                         <li><a href="javascript:void(0)"><div class="img_icon"><i class="fa fa-exclamation-circle"></i></div> <div class="img_icon_txt"><?php echo $add["classifieds"]["city"]; ?></div><div class="clearfix"></div></a></li>
                         <div class="clearfix"></div>
                       </ul>
                   </div>
                   <div class="product_slider_box">
                      <div class="span12">
                          <div id="" class="">
                              <div class="item">
                                  <h1>
                                    <img src="<?php echo $this->webroot.$add["files"]["base_url"]; ?>" class="img-responsive">
                                  </h1>
                              </div>
                          </div>
                      </div>
                   </div>
                   <div class="details_box">
                      <h2><?php echo $lang["details"]; ?></h2>
                      <ul class="list_details">
                        <li><div class="list_details1"><?php echo $lang["Location"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["city"]; ?></div>
                        <div class="clearfix"></div>
                        </li>
                         <li><div class="list_details1"><?php echo $lang["creation date"]; ?></div><div class="list_details2"><?php echo date("d/m/Y", strtotime($add["classifieds"]["create_date"])); ?></div>
                        <div class="clearfix"></div>
                        </li>
                        <li><div class="list_details1"><?php echo $lang["ad id"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["id"]; ?></div>
                            <div class="clearfix"></div>
                        </li>
                        <?php if(!empty($add[0]["subcategory"])){ ?>
                        <li><div class="list_details1"><?php echo $lang["Brand"]; ?></div><div class="list_details2"><?php echo $add[0]["subcategory"]; ?></div>
                        <div class="clearfix"></div>
                        </li>
                        <?php } if($add["classifieds"]["post_type"] > 0){ ?>
                         <li><div class="list_details1"><?php echo $lang["Ad type"]; ?></div><div class="list_details2"><?php echo ($add["classifieds"]["post_type"] == 1)? $lang['Sell'] :  $lang['Buy']; ?></div>
                          <div class="clearfix"></div>
                        </li>
                        <?php }else if($add["classifieds"]["typeofadd"] > 0){  ?>
                         <li><div class="list_details1"><?php echo $lang["Ad type"]; ?></div><div class="list_details2"><?php echo ($add["classifieds"]["typeofadd"] == 1)? $lang['Rent'] :  $lang['Sell']; ?></div>
                          <div class="clearfix"></div>
                        </li>
                        <?php } if($add["classifieds"]["condition_type"] > 0){ ?>
                         <li><div class="list_details1"><?php echo $lang["Condition"]." ".$lang["Type"]; ?></div><div class="list_details2"><?php echo ($add["classifieds"]["condition_type"] == 1)? $lang['New'] :  $lang['Used']; ?></div>
                        <div class="clearfix"></div>
                        </li>
                        <?php } if(!empty($add["classifieds"]["year"])){ ?>
                         <li><div class="list_details1"><?php echo $lang["Year"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["year"]; ?></div>
                        <div class="clearfix"></div>
                        </li>
                        <?php } if(!empty($add["classifieds"]["fuel"])){ ?>
                         <li><div class="list_details1"><?php echo $lang["Fuel"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["fuel"]; ?></div>
                        <div class="clearfix"></div>
                        </li>
                        <?php } if($add["classifieds"]["kilometer"] > 0){ ?>
                         <li><div class="list_details1"><?php echo $lang["KM's driven"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["kilometer"]; ?></div>
                        <div class="clearfix"></div>
                        </li>
                        <?php } if(!empty($add["classifieds"]["furnished"])){ ?>
                        <li><div class="list_details1"><?php echo $lang["Furnished"]; ?></div><div class="list_details2"><?php echo $lang[$add["classifieds"]["furnished"]]; ?></div>
                        <div class="clearfix"></div>
                        </li>
                        <?php } if($add["classifieds"]["rooms"] > 0){ ?>
                        <li><div class="list_details1"><?php echo $lang["Rooms"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["rooms"]." ".$lang["Rooms"]; ?></div>
                        <div class="clearfix"></div>
                        </li>
                        <?php } if($add["classifieds"]["squaremeter"] > 0){ ?>
                        <li><div class="list_details1"><?php echo $lang["Square Meters"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["squaremeter"]; ?></div>
                        <div class="clearfix"></div>
                        </li>
                        <?php } if($add["classifieds"]["job_type"] > 0){ ?>
                        <li><div class="list_details1"><?php echo $lang["Ad type"]; ?></div><div class="list_details2"><?php echo ($add["classifieds"]["job_type"] == 1)? $lang['Offering job'] :  $lang['Seeking job']; ?></div>
                        <div class="clearfix"></div>
                        </li>
                        <?php } if(!empty($add["classifieds"]["salary_period"])){ ?>
                        <li><div class="list_details1"><?php echo $lang["Salary period"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["salary_period"]; ?></div>
                        <div class="clearfix"></div>
                        </li>
                        <?php } if(!empty($add["classifieds"]["salary_from"]) && !empty($add["classifieds"]["salary_to"])){ ?>
                        <li><div class="list_details1"><?php echo $lang["Salary range"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["salary_from"]."-".$add["classifieds"]["salary_to"]; ?></div>
                        <div class="clearfix"></div>
                        </li>
                        <?php } if(!empty($add["classifieds"]["position_type"])){ ?>
                        <li><div class="list_details1"><?php echo $lang["Position type"]; ?></div><div class="list_details2"><?php echo $add["classifieds"]["position_type"]; ?></div>
                        <div class="clearfix"></div>
                        </li>
                        <?php } ?>

                      </ul>
                      <div class="description_box">
                      <h2><?php echo $lang["Description"]; ?><span><i class="fa fa-eye"></i><?php echo $view; ?></span></h2>
                      <p><?php echo nl2br($add["classifieds"]["description"]); ?></p>
                      </div>
                   </div>
                </div>
             </div> 
             <div class="col-md-4 col-sm-4">
                <div class="sidebar">
                   <?php if($add["classifieds"]["price"] > 0){ ?> 
                   <div class="sidebar_head" style="background-color: #0f90d2; border-radius: 2px;">
                      <h2 style='color: #ffffff; font-family: "myriadpro-semibold";font-size: 36px;padding: 29px;text-align: center;'>£ <?php echo $add["classifieds"]["price"]; ?></h2>
                   </div>
                   <?php }else if(!empty($add["classifieds"]["salary_from"])){ ?>
                   <div class="sidebar_head">
                      <h2>£ <?php echo $add["classifieds"]["salary_from"]." - ".$add["classifieds"]["salary_to"] ; ?></h2>
                   </div>
                   <?php } ?>
                   <div class="sidebar_name">
                     <div class="sidebar_name_img"><img src="<?php echo $this->webroot; ?>images/male-user.png"></div>
                     <div class="sidebar_name_txt"><a href="javascript:void(0)"><?php echo $add["classifieds"]["name"]; ?></a><!-- <span class="away">away</span> --><span>(<?php echo $lang["active on site since"]." ".yearago($add["users"]["created_date"],$lang); ?> )</span></div>
                     <div class="clearfix"></div>
                   </div>
                   <div class="sidebar_number">
                     <ul>
                       <li> <a href="#"><i class="flaticon1-phone72"></i> <span><?php echo $add["classifieds"]["phone"]; ?></span></a></li>

                     </ul>
                   </div>
                </div>
             </div>
          </div>  
       </div>
    </div>
</div>    

<?php 
  function yearago($olddate,$lang)
  {
    $today = date("Y-m-d H:i:s");
    $olddate = strtotime($olddate);
    $today = strtotime($today);

    $diff = $today - $olddate;

    if($diff/60 < 1)
    {
      return (int)$diff." ".$lang["Second"];
    }else if($diff/(60*60) < 1)
    {
      return (int)($diff/60)." ".$lang["Minute"];
    }else if($diff/(60*60*24) < 1)
    {
      return (int)($diff/(60*60))." ".$lang["Hour"];
    }else if($diff/(60*60*24*30) < 1)
    {
      return (int)($diff/(60*60*24))." ".$lang["Day"];
    }else if($diff/(60*60*24*30*365) < 1)
    {
      return (int)($diff/(60*60*24*30))." ".$lang["Month"];
    }else if($diff/(60*60*24*30*365) > 1)
    {
      return (int)($diff/(60*60*24*30*365))." ".$lang["Year"];
    }
  }
?>
<script>
    $(document).ready(function() {

      var sync1 = $("#sync1");
      var sync2 = $("#sync2");

      sync1.owlCarousel({
        singleItem : true,
        slideSpeed : 1000,
        navigation: true,
        pagination:false,
        afterAction : syncPosition,
        responsiveRefreshRate : 200,
      });

      sync2.owlCarousel({
        items : 15,
        itemsDesktop      : [1199,10],
        itemsDesktopSmall     : [979,10],
        itemsTablet       : [768,8],
        itemsMobile       : [479,4],
        pagination:false,
        responsiveRefreshRate : 100,
        afterInit : function(el){
          el.find(".owl-item").eq(0).addClass("synced");
        }
      });

      function syncPosition(el)
      {
        var current = this.currentItem;
        $("#sync2")
          .find(".owl-item")
          .removeClass("synced")
          .eq(current)
          .addClass("synced")
        if($("#sync2").data("owlCarousel") !== undefined){
          center(current)
        }
      }

      $("#sync2").on("click", ".owl-item", function(e){
        e.preventDefault();
        var number = $(this).data("owlItem");
        sync1.trigger("owl.goTo",number);
      });

      function center(number){
        var sync2visible = sync2.data("owlCarousel").owl.visibleItems;

        var num = number;
        var found = false;
        for(var i in sync2visible){
          if(num === sync2visible[i]){
            var found = true;
          }
        }

        if(found===false){
          if(num>sync2visible[sync2visible.length-1]){
            sync2.trigger("owl.goTo", num - sync2visible.length+2)
          }else{
            if(num - 1 === -1){
              num = 0;
            }
            sync2.trigger("owl.goTo", num);
          }
        } else if(num === sync2visible[sync2visible.length-1]){
          sync2.trigger("owl.goTo", sync2visible[1])
        } else if(num === sync2visible[0]){
          sync2.trigger("owl.goTo", num-1)
        }
      }

      $("body").on("click",".mail_send", function(){
        $("#send_mail .input").each(function(){
            if($(this).val() == "")
            {
              $(this).addClass("p_error"); 
            }else
            {
              $(this).removeClass("p_error"); 
            }
        });
        if(!$("#send_mail .input").hasClass("p_error"))
        {
          var data = $("#send_mail").serialize();
          $.ajax({
                  url:"<?php echo $this->webroot; ?>classifieds/sendmailtouser",
                  type:"post",
                  data: data,
                  dataType: "json",
                  success: function(data)
                  {
                    if(data.message == "success")
                    {
                      $("#send_mail")[0].reset();
                    }
                  }
          });
        }
      });

      $("body").on("click","#emailtog, .open_mail",function(){
        $(".recome").slideUp("slow");
        $(".report").slideUp("slow");
        $(".email_form").slideToggle();
      });

      $("body").on("click","#recommend",function(){
        $(".email_form").slideUp("slow");
        $(".report").slideUp("slow");
        $(".recome").slideToggle();
      });

      $("body").on("click","#msgtouser", function(){
        $(".msg_form").slideToggle();
      });

      $("body").on("click","#report",function(){
          $(".email_form").slideUp("slow");
          $(".recome").slideUp("slow");
          $(".report").slideToggle();
      });

      $("body").on("click",".close_btn a", function(){
          $(".report").slideUp("slow");
          $(".recome").slideUp("slow");
      });

      /* Send recommend mail */
      $("body").on("click",".recommend_id", function(){
          $("#recommend_form .input").each(function(){
            if($(this).val() == "")
            {
              $(this).addClass("p_error"); 
            }else
            {
              $(this).removeClass("p_error"); 
            }
          });
          if(!$("#recommend_form .input").hasClass("p_error"))
          {
              var data = $("#recommend_form").serialize();
              $.ajax({
                      url:"<?php echo $this->webroot; ?>classifieds/sendrecommendmail",
                      type:"post",
                      data:data,
                      dataType:"json",
                      success: function(data)
                      {
                          if(data.message == "success")
                          {
                             $("#recommend_form")[0].reset();
                             $(".recommend_alert").show();
                             setTimeout(function(){ 
                                $(".recommend_alert").hide();
                                $(".recome").slideUp("slow");
                             },1500);
                          }
                      }
              });
          }
      });

      /* Send report mail */
      $("body").on("click",".report_id", function(){
          $("#report_form .input").each(function(){
            if($(this).val() == "")
            {
              $(this).addClass("p_error"); 
            }else
            {
              $(this).removeClass("p_error"); 
            }
          });
          if(!$("#report_form .input").hasClass("p_error"))
          {
              var data = $("#report_form").serialize();
              $.ajax({
                      url:"<?php echo $this->webroot; ?>classifieds/sendreport",
                      type:"post",
                      data:data,
                      dataType:"json",
                      success: function(data)
                      {
                          if(data.message == "success")
                          {
                             $("#report_form")[0].reset();
                             $(".report_alert").show();
                             setTimeout(function(){ 
                                $(".report_alert").hide();
                                $(".report").slideUp("slow");
                             },1500);
                          }
                      }
              });
          }
      });

      $("body").on("click",".msg_send", function(){
          var msg = $("#user_msg").val().trim();
          if(msg != "")
          {
            var data = $("#send_msg").serialize();
            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifieds/sendmsg",
                    type:"post",
                    data:data,
                    dataType:"json",
                    success: function(data)
                    {
                        $("#send_msg")[0].reset();
                        $(".msg_form").slideToggle();
                    }
            }); 
          }else
          {
            alert("Please enter message");
          }
          
      });
      
      $("body").on("click",".print_page", function(){
          printDiv("contener");
      });

      function printDiv(divName) {
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
          //$( "#"+divName ).print();
      }
  });
</script>