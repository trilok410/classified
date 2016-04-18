<?php $lang = $this->Session->read('lang'); ?>
</section>
<!--conten sec start-->
    <div class="conten">
       <div class="adds_main">
           <div class="container">
             <div class="row">
               <div class="col-md-12 col-sm-12">
                  <div class="adds_main_head">
                     <!-- <h1>You can manage your Active & Inactive Ads</h1> -->
                    <?php 
                     $msg = $this->Session->flash('address');
                     if(!empty($msg)){ ?>
                     <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong><?php echo $msg; ?></strong>
                     </div>
                    <?php } ?>
                  </div>
               </div>
             </div>
             <div class="row">
               <div class="col-md-12 col-sm-12">
                   <div class="tab_box">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                          <li role="presentation"><a href="<?php echo $this->webroot; ?>users/myaccount"><?php echo $lang["ads"]; ?></a></li>
                          <li role="presentation"><a href="<?php echo $this->webroot; ?>users/message"><?php echo $lang["Message"]; ?></a></li>
                          <li role="presentation"><a href="<?php echo $this->webroot; ?>users/setting"><?php echo $lang["Settings"]; ?></a></li>
                          <li role="presentation"><a href="<?php echo $this->webroot; ?>users/paymenthistory"><?php echo $lang["Payment History"]; ?></a></li>
                          <li role="presentation"><a href="<?php echo $this->webroot ?>users/favoritead"><?php echo $lang["Favorite Ads"] ?></a></li>
                          <li role="presentation"><a href="<?php echo $this->webroot ?>users/savesearch"><?php echo $lang["Favorite searches"]; ?></a></li>
                          <li role="presentation" class="active"><a href="javascript:void(0)"><?php echo $lang["billing address"]; ?></a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="billing">
                              <div class="tab_head">
                                  <div class="tab_head_left">
                                      <?php echo $lang["billing details"]; ?>
                                  </div>
                               </div>
                               <div class="accordian_wrap">
                                 <form class="form-horizontal" method="post" action="<?php echo $this->webroot; ?>users/billing">
                                      <div class="form-group">
                                        <label for="companyname" class="col-sm-2 control-label"><?php echo $lang["company name"]; ?><span>*</span></label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="companyname" name="company_name" value="<?php echo (isset($ba) && !empty($ba))? $ba["BillingAddress"]["company_name"] : ""; ?>" placeholder="" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="first given name" class="col-sm-2 control-label"><?php echo $lang["first name"]; ?></label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo (isset($ba) && !empty($ba))? $ba["BillingAddress"]["first_name"] : ""; ?>"  placeholder="" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="surname" class="col-sm-2 control-label"><?php echo $lang["Last Name"]; ?></label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo (isset($ba) && !empty($ba))? $ba["BillingAddress"]["last_name"] : ""; ?>"  placeholder="" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="street" class="col-sm-2 control-label"><?php echo $lang["street, Nr"]; ?></label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="street" name="street" value="<?php echo (isset($ba) && !empty($ba))? $ba["BillingAddress"]["street"] : ""; ?>"  placeholder="" required>
                                        </div>
                                      </div>
                                       <div class="form-group">
                                        <label for="zip" class="col-sm-2 control-label"><?php echo $lang["Zip Code"]; ?></label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="zipcode" name="zipcode" value="<?php echo (isset($ba) && !empty($ba))? $ba["BillingAddress"]["zipcode"] : ""; ?>"  placeholder="" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="place" class="col-sm-2 control-label"><?php echo $lang["Place"]; ?></label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" id="place" name="place" value="<?php echo (isset($ba) && !empty($ba))? $ba["BillingAddress"]["place"] : ""; ?>"  placeholder="" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="countory" class="col-sm-2 control-label"><?php echo $lang["country"]; ?></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="country" name="country" value="<?php echo (isset($ba) && !empty($ba))? $ba["BillingAddress"]["country"] : ""; ?>"  placeholder="" required>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                      <label for="VAT" class="col-sm-2 control-label"><?php echo $lang["VAT Reg."]; ?></label>
                                        <div class="col-sm-1">
                                          <input type="text" class="form-control" id="country_code" name="country_code" value="<?php echo (isset($ba) && !empty($ba))? $ba["BillingAddress"]["country_code"] : ""; ?>"  placeholder="" required>
                                        </div>
                                        <div class="col-sm-9">
                                          <input type="text" class="form-control" id="vat_reg" name="vat_reg" value="<?php echo (isset($ba) && !empty($ba))? $ba["BillingAddress"]["vat_reg"] : ""; ?>"  placeholder="" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                      <div class="button_box">
                                        <input type="hidden" name="ba_id" value="<?php echo (isset($ba) && !empty($ba))? $ba["BillingAddress"]["id"] : ""; ?>">
                                        <!-- <button type="button">back</button> -->
                                        <button type="submit"><?php echo $lang["Save"]; ?></button>
                                       </div>
                                      </div>
                                    </form>
                               </div>
                            </div>
                        </div>
                   </div>
               </div>
             </div>
           </div>
       </div>
    </div>
    <!--conten sec end-->