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
                      <li role="presentation" class="active"><a href="#Ads" aria-controls="home" role="tab" data-toggle="tab"><?php echo $lang["Favorite Ads"]; ?></a></li>
                      <li role="presentation"><a href="<?php echo $this->webroot ?>users/savesearch"><?php echo $lang["Favorite searches"]; ?></a></li>
                      <li role="presentation"><a href="<?php echo $this->webroot ?>users/billing"><?php echo $lang["billing address"]; ?></a></li>
                    </ul>
                    <p class="clear_serch">
                      <?php if(!empty($ufav)){ ?>
                      <a href="javascript:void(0)" class="clearall_favorite" main=""><?php echo $lang["clear all favorites"]; ?></a>
                      <?php } ?>
                    </p>
                  
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="Ads">
                         <?php foreach($ufav as $fav){ ?>
                         <div class="favorite_box">
                            <div class="img_fav">
                              <div class="star_icon clearall_favorite" main="<?php echo $fav["classifieds"]["id"]; ?>"><i class="fa fa-star"></i></div>
                              <img src="<?php echo $this->webroot.$fav["files"]["base_url"]; ?>">
                            </div>
                            <div class="text_fav">
                               <h3><a target="_blank" href="<?php $this->webroot ?>classifieds/viewdetail/<?php echo $fav["classifieds"]["id"]; ?>"><?php echo $fav["classifieds"]["title"]; ?></a></h3>
                               <div class="price_box"> <?php echo ($fav["classifieds"]["price"] > 0)? $fav["classifieds"]["price"] : ""; ?> </div>
                                 <div class="breadcrumb_wrap">
                                   <ol class="breadcrumb">
                                    <li class="active"><?php echo $fav["classified_category"]["category"]; ?></li>
                                    <?php if(!empty($fav[0]["subcategory"])){ ?>
                                    <li class="active"><?php echo $fav[0]["subcategory"]; ?></li>
                                    <?php } ?>
                                  </ol>
                                   <span class="active"><?php echo $fav["classifieds"]["city"]; ?></span>
                                 </div>
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