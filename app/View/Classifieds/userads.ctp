<?php $lang = $this->Session->read('lang'); ?>
<?php $user = $this->Session->read('user'); ?>   
    <div class="banner_inner">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">
                      <div class="baner_text text-center">
                          <p><span><?php echo $lang["Looking for an item?"]; ?></span>
                          <?php echo $lang["Search a Region or type in a keyword"]; ?> <br>
                          <?php echo $lang["below"]; ?>. <span><?php echo $lang["Want to sell an item?"]; ?></span><?php echo $lang["Signup for a free account and start posting!"]; ?> </p>
                      </div>
                      <div class="search_main_head">
                          <div class="seaerch_main">
                            <div class="input-inner adds_near">
                                <div class="field_icon"><i class="fa fa-search"></i></div>
                                <input type="text" class="form-control input_keyword" placeholder="<?php echo $lang["what are looking for"]; ?>..">
                                <select class="main_category">
                                  <option value=""><?php echo $lang["All"]." ".$lang["Category"];?></option>
                                  <?php foreach($mcat as $mc){ ?>
                                  <option value="<?php echo $mc["classified_maincategories"]["m_id"]; ?>"><?php echo utf8_encode($mc["classified_maincategories"]["maincategory"]); ?></option>
                                  <?php } ?>
                                </select>
                                <div class="search_arrow"> <i class="fa fa-angle-down"></i></div>
                            </div>
                            <div class="input-inner region">
                              <div class="field_icon"><i class="fa fa-map-marker"></i></div>
                              <input type="text" id="region_city" class="form-control region_city" placeholder="<?php echo $lang["CITY"]; ?>" value="">
                            </div>
                            <div class="input-inner search_btn">
                              <button class="search_add"><i class="fa fa-search"></i><?php echo $lang["Search"]; ?></button>
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
          <div class="row">
             <div class="col-md-9 col-sm-3">
                 <div class="right_box">
                  <?php if(!empty($userad)){
                     foreach($userad as $uad){ ?>
                   <div class="right_box_list">
                      <div class="rb_img_box">
                        <img src="<?php echo $this->webroot.$uad['files']['base_url']; ?>" class="img-responsive">
                     </div>
                      <div class="rb_txt_box">
                        <div class="rb_head"><h2><a href="<?php echo $this->webroot; ?>ad/<?php echo $uad['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($uad["classifieds"]["title"]); ?>"><?php echo $uad["classifieds"]["title"]; ?></a></h2> <div class="clearfix"></div></div>
                        
                        <p><?php echo $uad["classifieds"]["description"]; ?></p>
                        <ul class="list_tag">
                          <li><img src="<?php echo $this->webroot.$uad[0]['category_image']; ?>"></li>
                          <li><a href="<?php echo $this->webroot; ?>ad/<?php echo $uad['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($uad["classifieds"]["title"]); ?>"><?php echo $uad['classified_maincategories']['maincategory']; ?>,</a></li>
                          <li><a href="<?php echo $this->webroot; ?>ad/<?php echo $uad['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($uad["classifieds"]["title"]); ?>"><?php echo $uad['classified_category']['category']; ?>,</a></li>
                          <li><a href="<?php echo $this->webroot; ?>ad/<?php echo $uad['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($uad["classifieds"]["title"]); ?>"><?php echo $uad[0]['subcategory']; ?>,</a></li>
                          <div class="clearfix"></div>
                        </ul>
                        <div class="price_btn_box"><a href="<?php echo $this->webroot; ?>ad/<?php echo $uad['classifieds']['id']; ?>/<?php echo $this->Link->changetitle($uad["classifieds"]["title"]); ?>" class="price_btn"><?php echo $lang["details"]; ?></a></div>
                     </div>
                     <div class="rb_txt_box_right">
                       <div class="price_tag">
                           <div class="price">£ <?php echo $uad['classifieds']['price']; ?></div><div class="price_tag_txt"><?php echo $uad['classifieds']['zipcode']; ?> <span><?php echo $uad['classifieds']['city']; ?>,</span>
                           </div>
                       </div>
                        <div class="date_box"><div class="date"><?php echo date("d-m-Y H:i:s", strtotime($uad["classifieds"]["create_date"])); ?></div>
                         <div class="wish_icon">
                            <?php if(!empty($user)){ ?>
                                <?php if(!empty($f_data) && in_array($uad["classifieds"]["id"], $f_data)){ ?>
                                  <a href="javascript:void(0)" id="remember_<?php echo $uad["classifieds"]["id"]; ?>" class="fav_remove" main="<?php echo $uad["classifieds"]["id"]; ?>"><i class="fa fa-heart-o mark_favorite"></i></a>
                                <?php }else{ ?>
                                  <a href="javascript:void(0)" id="remember_<?php echo $uad["classifieds"]["id"]; ?>" class="remember" main="<?php echo $uad["classifieds"]["id"]; ?>"><i class="fa fa-heart-o"></i></a>
                                <?php } ?>
                            <?php }else{ ?>
                                  <a href="javascript:void(0)" id="remember_<?php echo $uad["classifieds"]["id"]; ?>" class="remember_log" main="<?php echo $uad["classifieds"]["id"]; ?>"><i class="fa fa-heart-o"></i></a>
                            <?php } ?>
                         </div>
                          <div class="clearfix"></div>
                        </div>
                     </div>
                     
                     <div class="clearfix"></div>
                   </div>
                   <?php } }else{ ?>
                    <div class="right_box_list">
                        <div class="well"><h2> <?php echo $lang["No Result Found"]; ?> </h2></div>
                    </div>
                   <?php } ?>
                </div>
             </div>
          </div>  
       </div>
    </div>
</div>
<!--conten sec end-->

<script type="text/JavaScript" src="<?php echo $this->webroot; ?>js/geo.js"></script>

<script type="text/javascript">
   $(document).ready(function(){
      var surl = "<?php echo $this->webroot; ?>classifieds/search";
      /** Save Favourite**/
      $("body").on("click", ".bookmark,.remember", function(){
          var ad_id = $(this).attr ("main");
          var cur = $(this);
          if(!cur.find("i").hasClass("mark_favorite"))
          {
            $.ajax({
                  url:"<?php echo $this->webroot; ?>classifieds/savebookmark",
                  type:"post",
                  data:{ad_id:ad_id},
                  dataType:"json",
                  success: function(data)
                  {
                    cur.find("i").addClass("mark_favorite");
                  }
            });
          }else
          {
            $.ajax({
                  url:"<?php echo $this->webroot; ?>classifieds/removebookmark",
                  type:"post",
                  data:{ad_id:ad_id},
                  dataType:"json",
                  success: function(data)
                  {
                    cur.find("i").removeClass("mark_favorite");
                  }
            });
          }
      });

      /* Search by Search Button */
      $("body").on("click", ".search_add", function(){
          var url = [];
          var keyword =  $(".input_keyword").val();
          var m_id = $(".main_category").val();
          var loc = $(".region_city").val();

          if(m_id != "")
          {
            url.push("m_id="+m_id);
          }
          if(keyword != "")
          {
            url.push("keyword="+keyword);
          }
          if(loc != "")
          {
            url.push("loc="+loc);
          }
          var strg = url.join("&");
          var newurl = surl+"?"+strg;
          window.location.href = newurl;
      });

      /* Search by Main category on change */
      $("body").on("change", ".main_category", function(){
          var url = [];
          var keyword =  $(".input_keyword").val();
          var m_id = $(".main_category").val();
          var loc = $(".region_city").val();

          if(m_id != "")
          {
            url.push("m_id="+m_id);
          }
          if(keyword != "")
          {
            url.push("keyword="+keyword);
          }
          if(loc != "")
          {
            url.push("loc="+loc);
          }
          var strg = url.join("&");
          var newurl = surl+"?"+strg;
          window.location.href = newurl;
      });
   });
</script>
