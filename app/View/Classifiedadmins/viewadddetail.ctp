 <!--content start-->
  <div class="conten classified view_addetail">
      <div class="container">
          <div class="row">
              <div id="load_search">
                        
                </div>
            </div>
            
            <div class="row con_inner">
              <div class="col-md-8 col-sm-8">
                  <div class="left_block view_detail">
                     <div class="gallery">
                        <div class="slideshow-container" id="gallery_inner">
                          <div id="controls" class="controls"></div>
                          <div id="loading" class="loader"></div>
                          <div id="slideshow" class="slideshow"></div>
                        </div>
                   </div>
                        
                   <div class="navigation-container">
                        <div id="thumbs" class="navigation">
                          <div id="sync1" class="owl-carousel">
                            <?php foreach($add_images as $images): ?>
                                <div class="item">
                                  <h1><img src="<?php echo $this->webroot.$images["files"]["base_url"]; ?>" class="img-responsive"></h1>
                                </div>
                            <?php endforeach; ?>
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
                  </div>
                    
                  <div class="product_detail">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                              <?php  
                              if($add["classifieds"]["post_type"] > 0)
                              {
                                echo ($add["classifieds"]["post_type"] == 1)? "Sell":"Buy";
                              }else if($add["classifieds"]["job_type"] > 0)
                              {
                                echo ($add["classifieds"]["job_type"] == 1)? 'Offering job' : 'Seeking job';
                              }
                              echo " ".$add["classifieds"]["title"]; ?></h3>
                          </div>
                          <div class="panel-body">
                            <ul>
                              <li><div class="list_details1">Location</div><div class="list_details2"><?php echo $add["classifieds"]["zipcode"]."  ".$add["classifieds"]["city"]; ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <li><div class="list_details1">creation date</div><div class="list_details2"><?php echo date("d/m/Y", strtotime($add["classifieds"]["create_date"])); ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <li><div class="list_details1">ad id</div><div class="list_details2"><?php echo $add["classifieds"]["id"]; ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <?php if(!empty($add[0]["subcategory"])){ ?>
                              <li><div class="list_details1">Brand</div><div class="list_details2"><?php echo $add[0]["subcategory"]; ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <?php } if($add["classifieds"]["post_type"] > 0){ ?>
                               <li><div class="list_details1">Ad type</div><div class="list_details2"><?php echo ($add["classifieds"]["post_type"] == 1)? 'Sell' :  'Buy'; ?></div>
                                <div class="clearfix"></div>
                              </li>
                              <?php }else if($add["classifieds"]["typeofadd"] > 0){  ?>
                               <li><div class="list_details1">Ad type</div><div class="list_details2"><?php echo ($add["classifieds"]["typeofadd"] == 1)? 'Rent' :  'Sell'; ?></div>
                                <div class="clearfix"></div>
                              </li>
                              <?php } if($add["classifieds"]["condition_type"] > 0){ ?>
                               <li><div class="list_details1">Condition Type</div><div class="list_details2"><?php echo ($add["classifieds"]["condition_type"] == 1)? 'New' : 'Used'; ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <?php } if(!empty($add["classifieds"]["year"])){ ?>
                               <li><div class="list_details1">Year</div><div class="list_details2"><?php echo $add["classifieds"]["year"]; ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <?php } if(!empty($add["classifieds"]["fuel"])){ ?>
                               <li><div class="list_details1">Fuel</div><div class="list_details2"><?php echo $add["classifieds"]["fuel"]; ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <?php } if($add["classifieds"]["kilometer"] > 0){ ?>
                               <li><div class="list_details1">KM's driven</div><div class="list_details2"><?php echo $add["classifieds"]["kilometer"]; ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <?php } if(!empty($add["classifieds"]["furnished"])){ ?>
                              <li><div class="list_details1">Furnished</div><div class="list_details2"><?php echo $add["classifieds"]["furnished"]; ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <?php } if($add["classifieds"]["rooms"] > 0){ ?>
                              <li><div class="list_details1">Rooms</div><div class="list_details2"><?php echo $add["classifieds"]["rooms"]." "."Rooms"; ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <?php } if($add["classifieds"]["squaremeter"] > 0){ ?>
                              <li><div class="list_details1">Square Meters</div><div class="list_details2"><?php echo $add["classifieds"]["squaremeter"]; ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <?php } if($add["classifieds"]["job_type"] > 0){ ?>
                              <li><div class="list_details1">Ad type</div><div class="list_details2"><?php echo ($add["classifieds"]["job_type"] == 1)? 'Offering job' :  'Seeking job'; ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <?php } if(!empty($add["classifieds"]["salary_period"])){ ?>
                              <li><div class="list_details1">Salary period</div><div class="list_details2"><?php echo $add["classifieds"]["salary_period"]; ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <?php } if(!empty($add["classifieds"]["salary_from"]) && !empty($add["classifieds"]["salary_to"])){ ?>
                              <li><div class="list_details1">Salary range</div><div class="list_details2"><?php echo $add["classifieds"]["salary_from"]."-".$add["classifieds"]["salary_to"]; ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <?php } if(!empty($add["classifieds"]["position_type"])){ ?>
                              <li><div class="list_details1">Position type</div><div class="list_details2"><?php echo $add["classifieds"]["position_type"]; ?></div>
                              <div class="clearfix"></div>
                              </li>
                              <?php } ?>
                            </ul>
                            <div class="prdetail_txt">
                            <?php echo nl2br($add["classifieds"]["description"]); ?>
                          </div>
                        </div>
                      </div>  
                  </div>
                </div>
                <div class="col-md-4 col-sm-4">
                  <div class="vd_right">
                        <?php if($add["classifieds"]["price"] > 0){ ?>
                        <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title"><span class="fa fa-dollar"></span><?php echo $add["classifieds"]["price"]; ?></h3>
                          </div>
                        </div>
                        <?php } ?>
                        <div class="panel-body">
                          <div class="well well-sm">
                                <div><span class="fa fa-user"></span><?php echo $add["classifieds"]["name"]; ?></div>
                                <div><span class="fa fa-map-marker"></span><?php echo $add["countries"]["name"].">>".$add["states"]["name"].">>".$add["classifieds"]["city"]; ?></div>
                                <div><span class="fa fa-phone-square"></span><?php echo $add["classifieds"]["phone"]; ?></div>
                            </div>
                            <div class="well well-sm">
                              <form role="form" id="mail_sellor">
                                  <h3>Email Sellor</h3>
                                    <div class="form-group">
                                      <label for="mesg" class="sr-only"></label>
                                      <textarea class="form-control" id="mesg" name="description"></textarea>
                                      <input type="hidden" value="<?php echo $add["classifieds"]["name"]; ?>" name="to_name" id="to_name">
                                      <input type="hidden" value="<?php echo $add["classifieds"]["email"]; ?>" name="to_mail" id="to_email">
                                      <input type="hidden" value="<?php echo $add["classifieds"]["title"]; ?>" name="title" id="add_title">
                                    </div>
                                    <!-- <div class="form-group">
                                      <label for="email" class="sr-only">Email</label>
                                      <input type="email" class="form-control email" name="from_mail" placeholder="Email">
                                    </div> -->
                                    <div class="form-group">  
                                      <input type="button" class="btn btn-primary send_mailsellor" value="submit">
                                    </div>
                                </form>
                            </div>
                            <div class="well well-sm">
                                  <?php if($add["classifieds"]["status"] == 2){ ?>
                                    <input type="button" class="btn btn-primary block_event" main="<?php echo $add["classifieds"]["id"]; ?>"  value="Block This Add">
                                  <?php }else{ ?>
                                    <input type="button" class="btn btn-primary unblock_event" main="<?php echo $add["classifieds"]["id"]; ?>" value="Unblock This Add">
                                  <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    <!--content end-->


<script>
    $(document).ready(function(){
        $('.email').hide();
        $('#mesg').focus(function(e) {
            $('.email').slideDown('slow');
        });

        $(".block_event").click(function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'classifieds';
            var col = 'id';

            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/blockdata",
                    type:"post",
                    data:"c_id="+c_id+"&tab="+tab+"&col="+col,
                    dataType:"json",
                    beforeSend: function() {
                        $('.loading').show();
                        $('.loading_icon').show();
                     },
                    success: function(data){
                        if(data.message == 'success')
                        {
                            window.location.reload();
                        }
                    }
            });
        });

        $(".unblock_event").click(function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'classifieds';
            var col = 'id';

            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/unblockdata",
                    type:"post",
                    data:"c_id="+c_id+"&tab="+tab+"&col="+col,
                    dataType:"json",
                    beforeSend: function() {
                        $('.loading').show();
                        $('.loading_icon').show();
                     },
                    success: function(data){
                        if(data.message == 'success')
                        {
                            window.location.reload();
                        }
                    }
            });
        });

        /* For Send Mail to sellor **/

        $('.send_mailsellor').click(function(){
            var data = $('#mail_sellor').serialize();
            
            $.ajax({
                    url:"<?php echo $this->webroot ?>classifiedadmins/sendmailtosellor",
                    data:data,
                    type:"post",
                    dataType:"json",
                    success: function(data)
                    {
                       if(data.success == "success")
                       {
                           $('#mail_sellor')[0].reset(); 
                       }
                    }
            });
        });
  });
</script>
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