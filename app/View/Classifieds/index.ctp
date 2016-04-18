<?php $user = $this->Session->read("user"); ?>
<?php $lang = $this->Session->read('lang'); ?>
<div class="banner_inner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="baner_text text-center">
                    <p><span><?php echo $lang["Looking for an item?"]; ?></span><?php echo $lang["Search a Region or type in a keyword"]; ?> <br>
                    <?php echo $lang["below"]; ?>. <span><?php echo $lang["Want to sell an item?"]; ?></span><?php echo $lang["Signup for a free account and start posting!"]; ?> </p>
                </div>
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
                              <span class="radius_keyword"><?php echo (isset($data["radius"]) && !empty($data["radius"]))? "+ ".$data["radius"]." km" : $lang['Radius']; ?></span><span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu">
                            <li>
                              <a href="javascript:void(0)" class="search_radius" main=""><?php echo $lang["Radius"]; ?></a>
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
                <?php if(empty($user)){ ?>
                <div class="free_register">
                    <?php echo $lang["Click here to register for a"]; ?> <a href="javascript:void(0)" id="login1"> <?php echo $lang["Free"]; ?> </a> <?php echo $lang["account"]; ?>.
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
        
</section>

<!--conten sec start-->
<div class="conten">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12 col-sm-12">
            	<div class="home_main">
              	  <div class="menu_list">
                    	<ul>
                        <?php foreach($main_cat as $main){ ?>
                        	<li>
                            	<a href="<?php echo $this->webroot ?>classified/<?php echo $this->Link->changename($main["classified_maincategories"]["maincategory"]); ?>?m_id=<?php echo $main["classified_maincategories"]["m_id"]; ?>" main="<?php echo $main["classified_maincategories"]["m_id"]; ?>" class="color_<?php echo $main["classified_maincategories"]["lead_cat"]; ?>">
                                	<img src="<?php echo $this->webroot.$main["files"]["base_url"]; ?>" class="img-responsive">
                                    <span><?php echo utf8_encode($main["classified_maincategories"]["maincategory"]); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                            <li>
                            	<a href="<?php echo $this->webroot ?>classified" class="color_11">
                                	<div class="menu_more">More</div>
                                </a>
                            </li>
                            
                            <div class="clearfix"></div>
                        </ul>
                  </div>
                  <div class="product_grp">
                      <div class="pro_head">
                        <div class="pro_head1"><h2><?php echo $lang["premium ads"]; ?></h2></div>
                        <div class="pro_head2"><a href="<?php echo $this->webroot; ?>classifieds/postadd" class="premium_btn"><?php echo $lang["submit"]." ".$lang["premium ads"]; ?> </a></div>
                         <div class="clearfix"></div>
                      </div>
                      <div class="row">
                        <?php foreach($premium as $pre){ ?>
                          <div class="col-md-4 col-sm-4">
                              <div class="thumb_main">
                                  <div class="thumb_img">
                                      <a href="<?php echo $this->webroot; ?>ad/<?php echo $pre["classifieds"]["id"]; ?>/<?php echo $this->Link->changetitle($pre["classifieds"]["title"]); ?>">
                                      <img src="<?php echo $this->webroot.$pre["files"]["base_url"]; ?>" class="img-responsive">
                                      <?php if($pre["classifieds"]["price"] > 0){ ?>
                                      <div class="budget_box">
                                          <span><?php echo $pre["classifieds"]["price"]; ?> €</span>
                                      </div>
                                      <?php } ?>
                                      </a>
                                  </div>
                                  <div class="thmb_cap">
                                    <div class="pro_name"><?php echo $pre["classifieds"]["title"]; ?></div>
                                     <div class="time_rgt_main">
                                       <a href="<?php echo $this->webroot; ?>ad/<?php echo $pre["classifieds"]["id"]; ?>/<?php echo $this->Link->changetitle($pre["classifieds"]["title"]); ?>">
                                         <div class="time_rgt"><i class="fa fa-map-marker"></i></div>
                                         <div class="time_rgt_txt"><?php echo $pre["classifieds"]["city"]; ?></div></a>
                                         <div class="clearfix"></div>
                                     </div>
                                     <div class="time_rgt_main">
                                       <a href="<?php echo $this->webroot; ?>ad/<?php echo $pre["classifieds"]["id"]; ?>/<?php echo $this->Link->changetitle($pre["classifieds"]["title"]); ?>">
                                         <div class="time_rgt"><i class="fa fa-car"></i></div>
                                         <div class="time_rgt_txt"><?php echo $pre["classified_category"]["category"]; ?></div>
                                      </a>
                                         <div class="clearfix"></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        <?php } ?>
                      </div>
                  </div>
                  <div class="product_grp">
                      <div class="pro_head">
                        <div class="pro_head1"><h2><?php echo $lang["latest ads"]; ?></h2></div>
                        <div class="pro_head2"><a href="<?php echo $this->webroot; ?>classifieds/postadd" class="premium_btn"><?php echo $lang["submit"]." ".$lang["free ads"]; ?></a></div>
                         <div class="clearfix"></div>
                      </div>
                      <div class="row">
                          <?php foreach($latest as $lat){ ?>
                          <div class="col-md-4 col-sm-4">
                              <div class="thumb_main">
                                  <div class="thumb_img">
                                      <a href="<?php echo $this->webroot; ?>ad/<?php echo $lat["classifieds"]["id"]; ?>/<?php echo $this->Link->changetitle($lat["classifieds"]["title"]); ?>">
                                      <img src="<?php echo $this->webroot.$lat["files"]["base_url"]; ?>" class="img-responsive">
                                      <?php if($lat["classifieds"]["price"] > 0){ ?>
                                      <div class="budget_box">
                                          <span><?php echo $lat["classifieds"]["price"]; ?> €</span>
                                      </div>
                                      <?php } ?>
                                      </a>
                                  </div>
                                  <div class="thmb_cap">
                                    <div class="pro_name"><?php echo $lat["classifieds"]["title"]; ?></div>
                                     <div class="time_rgt_main">
                                       <a href="<?php echo $this->webroot; ?>ad/<?php echo $lat["classifieds"]["id"]; ?>/<?php echo $this->Link->changetitle($lat["classifieds"]["title"]); ?>">
                                         <div class="time_rgt"><i class="fa fa-map-marker"></i></div>
                                         <div class="time_rgt_txt"><?php echo $lat["classifieds"]["city"]; ?></div></a>
                                         <div class="clearfix"></div>
                                     </div>
                                     <div class="time_rgt_main">
                                       <a href="<?php echo $this->webroot; ?>ad/<?php echo $lat["classifieds"]["id"]; ?>/<?php echo $this->Link->changetitle($lat["classifieds"]["title"]); ?>">
                                         <div class="time_rgt"><i class="fa fa-car"></i></div>
                                         <div class="time_rgt_txt"><?php echo $lat["classified_category"]["category"]; ?></div>
                                      </a>
                                         <div class="clearfix"></div>
                                      </div>
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
<!--conten sec end-->

<input type="hidden" id="hid_radius" value="<?php echo (isset($data["radius"]) && !empty($data["radius"]))? $data["radius"] : ""; ?>">


<script>
  var surl = "<?php echo $this->webroot; ?>classified";
  $(document).ready(function(){
      var surl = "<?php echo $this->webroot; ?>classified";
      
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
          var radius = $("#hid_radius").val();
          //$("#hid_maincategory").val(m_id).attr("main",m_name);
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
          
          var strg = url.join("&");
          var newurl = surl+"?"+strg;
          window.location.href = newurl;
      });
      
      /* Search by Search Button */
      $("body").on("click", ".search_add", function(){
          var url = [];
          var keyword =  $(".input_keyword").val();
          var loc = $(".region_city").val();
          var radius = $("#hid_radius").val();
          if(loc != "")
          {
            url.push("loc="+loc);
            surl += "/"+loc;
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
          var fap = $(this).attr("fap").trim();
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
  });
</script>
<!--<script type="text/JavaScript" src="<?php echo $this->webroot; ?>js/geo.js"></script>-->