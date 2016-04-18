<?php $lang = $this->Session->read('lang'); ?>
</section>
<!--conten sec start-->
<div class="conten">
   <div class="favorite_main">
       <div class="container">
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
                      <li role="presentation" class="active"><a href="#searches" aria-controls="profile" role="tab" data-toggle="tab"> <?php echo $lang["Favorite searches"]; ?></a></li>
                      <li role="presentation"><a href="<?php echo $this->webroot ?>users/billing"><?php echo $lang["billing address"]; ?></a></li>
                    </ul>
                    <p class="clear_serch">
                        <?php if(!empty($search)) { ?>
                        <a href="javascript:void(0)" class="remove_savesearch" main=""><?php echo $lang["clear all favorites"]; ?></a>
                        <?php } ?>
                    </p>
                  
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="searches">
                        <?php foreach($search as $sh){ ?>  
                        <div class="panel_box">
                           <div class="panel_head">
                              <?php if(!empty($sh["SaveSearch"]["title"])){ ?>
                              <label>Phrase</label> 
                              <p><?php echo $sh["SaveSearch"]["title"]; ?></p>
                              <?php } if(!empty($sh["SaveSearch"]["category"])){ ?>
                              <label>Category:</label>
                              <p><?php echo $sh["SaveSearch"]["category"]; ?></p>
                              <?php } if(!empty($sh["SaveSearch"]["location"])){ ?>
                              <label>Location:</label>
                              <p><?php echo $sh["SaveSearch"]["location"]; ?></p>
                              <?php } ?>
                           </div>
                           <div class="panel_content">
                               <ul class="list_features">
                                  <?php $filter = unserialize($sh["SaveSearch"]["filters"]);
                                  foreach($filter as $x => $y){ ?>
                                  <li>
                                     <label><?php echo $x; ?></label> 
                                     <p><?php echo $y; ?></p>
                                  </li>
                                  <?php } ?>
                               </ul>
                           </div>
                           <div class="panel_bottom">
                              <div class="left_pb"><a target="_blank" href="<?php echo $sh["SaveSearch"]["url"]; ?>"><?php echo $lang["view search"]; ?></a></div>
                              <div class="right_pb"><a href="javascript:void(0)" class="remove_savesearch" main="<?php echo $sh["SaveSearch"]["id"]; ?>"><?php echo $lang["remove"]; ?></a></div>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
               </div>
           </div>
         </div>
       </div>
   </div>
</div>
<!--conten sec end-->