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
  });
</script>