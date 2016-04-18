<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
             <h2>Post Ad</h2>   
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            	<div class="post_main">
               <div class="post_left">
                  <form class="form-horizontal" id="post_adform" method="post" action="<?php echo $this->webroot ?>classifiedadmins/addad" enctype="multipart/form-data">
                      <section class="form_section">
	                        <div class="form_sec_inner">
	                        	<div class="ad_box_head">
	                        		<h3>Categorization</h3>
	                        	</div>
		                        <div class="form-group">
		                          <label for="inputEmail3" class="col-sm-3 control-label">add title<span>*</span></label>
		                          <div class="col-sm-9">
		                            <input type="text" class="form-control hide1 show_tip" name="title" id="addtitle" placeholder="" maxlength="70" required>
		                            <div class="title"><span class="addtitle_chr">70</span>characters left</div>
		                          </div>
		                        </div>
		                        <div class="form-group cat_main">
		                            <label for="Category" class="col-sm-3 control-label">Category<span>*</span></label>
		                            <div class="col-sm-9">
		                                <div class="choose_cat">
		                                    <button type="button" class="btn model_btn" data-toggle="modal" data-target="#myModal">choose a category</button>
		                                    <div class="category_image"><a href="#"  data-toggle="modal" data-target="#myModal"><img src="<?php echo $this->webroot; ?>images/category.jpg"></a></div>
		                                </div>
		                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		                                    <div class="modal-dialog" role="document">
		                                      <div class="modal-content">
		                                       <div class="modal-header">
		                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                                          <h4 class="modal-title" id="myModalLabel">Select Category</h4>
		                                        </div>
		                                        <div class="modal-body">
		                                           <ul class="list_model">
		                                                  <?php foreach($main_cat as $main){ ?>
		                                                  <li>
		                                                    <a href="javascript:void(0)" class="color_<?php echo $main["classified_maincategories"]["lead_cat"] ?> main_cat" main="<?php echo $main["classified_maincategories"]["m_id"]; ?>" omg="<?php echo $this->webroot.$main["files"]["base_url"]; ?>">
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
		                                <div class="category_list" style="display:none">
		                                  <ul>
		                                    <li class="cat_img"><img src="" class="img-responsive maincat_img"></li>
		                                    <li class="cat_maincat"></li>
		                                    <li class="cat_cat"></li>
		                                    <li class="cat_sub"></li>
		                                    <li><a href="javascript:void(0)" class="change_btn change_maincat">change</a></li>
		                                    <li><div class="change_icon"><i class="fa fa-check-circle"></i></div></li>
		                                    <div class="clearfix"></div>
		                                  </ul>
		                                </div>
		                                <div id="error_cat" style="color:red; display:none">Please Choose Category</div>
		                                <input type="hidden" id="main_cat" name="m_id" main="" value="" required>
		                                <input type="hidden" id="only_cat" name="c_id" main="" value="">
		                                <input type="hidden" id="sub_cat" name="s_id" main="" value="">
		                                <input type="hidden" id="pap_id" value="">  
		                                <!--category list end here-->
		                            </div>
		                        </div>
	                  		</div>
                      </section>
                      <section class="form_section">
                         <div class="form_sec_inner">
                         	<div class="ad_box_head">
                         		<h3>Ad Details</h3>
                         	</div>
	                        <div id="load_pages">
	                            
	                        </div>
	                        <div class="form-group">
	                          <label for="inputEmail3" class="col-sm-3 control-label">Tags<span>*</span></label>
	                          <div class="col-sm-9">
	                             <input type="text" class="form-control show_tip" name="tag_name" placeholder="Tags" required>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label for="inputEmail3" class="col-sm-3 control-label">Ad Description<span>*</span></label>
	                          <div class="col-sm-9">
	                           <textarea class="form-control show_tip" id="description" name="description" placeholder="include the brand model" maxlength="4096" required></textarea>
	                           <div class="title"><span class="description_chr">4096</span> characters left</div>
	                          </div>
	                        </div>
	                        <div class="form-group image_block">
	                          <label for="inputEmail3" class="col-sm-3 control-label">upload photos<span>*</span>
	                          <div class="upload_img"><img src="<?php echo $this->webroot; ?>images/upload.png" class="img-responsive"></div>
	                          </label>
	                          <div class="col-sm-9">
	                              <div class="img_filesec">
	                                  <div class="file_btn">
	                                      <input type="file" required="" class="input_img1" name="logo_image[]" style="display: inline-block;">
	                                      <span class="glyphicon glyphicon-plus-sign input_img1" style="display: block;"></span>
	                                      <img class="show_img1" style="display:none" alt="img" src="">
	                                      <span style="display:none" class="fa fa-close remove_img"></span>
	                                  </div>
	                                  <div class="file_btn">
	                                      <input type="file" class="input_img1" name="logo_image[]">
	                                      <span class="glyphicon glyphicon-plus-sign input_img1"></span>

	                                      <img class="show_img1" style="display:none" alt="img" src="">
	                                      <span style="display:none" class="fa fa-close remove_img"></span>
	                                  </div>
	                                  <div class="file_btn">
	                                      <input type="file" class="input_img1" name="logo_image[]">
	                                      <span class="glyphicon glyphicon-plus-sign input_img1"></span>

	                                      <img class="show_img1" style="display:none" alt="img" src="">
	                                      <span style="display:none" class="fa fa-close remove_img"></span>
	                                  </div>
	                                  <div class="file_btn">
	                                      <input type="file" class="input_img1" name="logo_image[]">
	                                      <span class="glyphicon glyphicon-plus-sign input_img1"></span>

	                                      <img class="show_img1" style="display:none" alt="img" src="">
	                                      <span style="display:none" class="fa fa-close remove_img"></span>
	                                  </div>
	                                  <div class="file_btn">
	                                      <input type="file" class="input_img1" name="logo_image[]">
	                                      <span class="glyphicon glyphicon-plus-sign input_img1"></span>

	                                      <img class="show_img1" style="display:none" alt="img" src="">
	                                      <span style="display:none" class="fa fa-close remove_img"></span>
	                                  </div>
	                                  <div class="file_btn">
	                                      <input type="file" class="input_img1" name="logo_image[]">
	                                      <span class="glyphicon glyphicon-plus-sign input_img1"></span>

	                                      <img class="show_img1" style="display:none" alt="img" src="">
	                                      <span style="display:none" class="fa fa-close remove_img"></span>
	                                  </div>
	                                  <div class="file_btn">
	                                      <input type="file" class="input_img1" name="logo_image[]">
	                                      <span class="glyphicon glyphicon-plus-sign input_img1"></span>

	                                      <img class="show_img1" style="display:none" alt="img" src="">
	                                      <span style="display:none" class="fa fa-close remove_img"></span>
	                                  </div>
	                                  <div class="file_btn">
	                                      <input type="file" class="input_img1" name="logo_image[]">
	                                      <span class="glyphicon glyphicon-plus-sign input_img1"></span>

	                                      <img class="show_img1" style="display:none" alt="img" src="">
	                                      <span style="display:none" class="fa fa-close remove_img"></span>
	                                  </div>
	                              </div> 
	                              <div class="clearfix"></div>
	                          </div>
	                        </div>
                         </div>
                      </section>
                      <section class="form_section">
                         <div class="form_sec_inner">
                         	<div class="ad_box_head">
	                        	<h3>suplier details</h3>
	                        </div>
	                        <div class="form-group">
	                          <label for="name" class="col-sm-3 control-label">User<span>*</span></label>
	                          <div class="col-sm-4">
	                            	<input type="text" id="search_user" class="form-control" placeholder="Search User">
	                          </div>
	                          <div class="col-sm-5">
	                            	<select class="form-control" id="select_user">
	                            		<option>Select User</option>
	                            	</select>	
	                          </div>
	                        </div>
	                        <div class="form-group current">
	                          <label for="name" class="col-sm-3 control-label">name<span>*</span></label>
	                          <div class="col-sm-9">
	                            <input type="text" class="form-control" value="" name="name" id="name" placeholder="" required>
	                          	<input type="hidden" id="user_id" name="uid">
	                          </div>
	                        </div>
	                        <div class="form-group">
	                            <label for="email" class="col-sm-3 control-label">Email<span>*</span></label>
	                            <div class="col-sm-9">
	                              <input type="email" class="form-control check_mail" name="email" id="email" placeholder="" required>
	                              <span class="show_error check_mail_exist" style="display:none">Email Already Exist!</span>
	                            </div>
	                        </div>
	                       
	                        <div class="form-group current">
	                          <label for="text" class="col-sm-3 control-label">Phone Number<span>*</span></label>
	                          <div class="col-sm-9">
	                            <input type="text" class="form-control" value="" name="phone" id="phone" placeholder="" maxlength="15" required>
	                          </div>
	                        </div>
	                        <div class="form-group imprint" style="display:none" >
	                          <label for="text" class="col-sm-3 control-label">Imprint<span>*</span></label>
	                          <div class="col-sm-9">
	                            <textarea class="form-control show_tip imprint_text" name="imprint"></textarea>
	                          </div>
	                        </div>
	                     </div>
                      </section>
                      <section class="form_section">
                         <div class="form_sec_inner">
	                        <div class="location">
	                           <div class="ad_box_head">
	                           		<h3>Place</h3>
	                           </div>
	                           <div class="form-group" >
	                                <label for="name" class="col-sm-3 control-label">Country<span>*</span></label>
	                                <div class="col-sm-9">
	                                  <select class="form-control country" name="country" required>
	                                        <option value="">Country</option>
	                                        <?php foreach($country as $cont){ ?>
	                                        <option main="<?php echo $cont["countries"]["code"]; ?>" value="<?php echo $cont["countries"]["id"]; ?>" <?php echo (isset($user) && !(empty($user)) && $user["country"] == $cont["countries"]["id"])? "selected" : ""; ?> ><?php echo $cont["countries"]["name"]; ?></option>
	                                        <?php } ?>
	                                  </select>
	                                  <input type="hidden" id="cont_name" name="cont_name">
	                                </div>
	                           </div>
	                           <div class="form-group" >
	                                <label for="name" class="col-sm-3 control-label">State<span>*</span></label>
	                                <div class="col-sm-9">
	                                  <select class="form-control state" name="state" required>
	                                      <?php if(!empty($user)){ ?>
	                                      <?php foreach($state as $ste){ ?>  
	                                      <option value="<?php echo $ste["states"]["id"]; ?>" <?php echo (!(empty($user)) && $user["state"] == $ste["states"]["id"])? "selected" : ""; ?> ><?php echo $ste["states"]["name"]; ?></option>
	                                      <?php } }else{ ?>
	                                      <option value="">State</option>
	                                      <?php } ?>
	                                  </select>
	                                </div>
	                           </div>
	                           <div class="form-group" >
	                                <label for="name" class="col-sm-3 control-label">Zip Code<span>*</span></label>
	                                <div class="col-sm-3">
	                                  <input type="text" class="form-control zip zipcode" value="<?php echo (!empty($user) && isset($user["zipcode"]))? $user["zipcode"] : ''; ?> " name="zipcode" required>
	                                </div>
	                                <div class="col-sm-6">
	                                    <input type="text" class="form-control city" name="city" Placeholder="City" value="<?php echo (!empty($user) && isset($user["city"]))? $user["city"] : ''; ?>" readonly="" required>
	                                    <div class="show_place" style="display:none"></div>
	                                </div>
	                           </div>
	                           <div class="form-group">
	                              <label for="name" class="col-sm-3 control-label">Address<span>*</span></label>
	                              <div class="col-sm-9">
	                                <input type="text" name="street_no" class="form-control street_no" value="<?php echo (!empty($user) && isset($user["street_no"]))? $user["street_no"] : ''; ?>" required>
	                              </div>
	                           </div>
	                        </div>
                         </div>
                      </section>
                      <section class="form_section">
                         <div class="form_sec_inner">
	                         <div class="ad_box_head"> 
	                           <h3>Increase Opportunity. Highlight Display</h3>
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
	                                   <input type="checkbox" class="feat_all"> select all
	                                </label>
	                              </div>
	                           </div>
	                           <div class="abc_right">all prices incl. VAT
	                           </div>
	                           <div class="clearfix"></div>
	                         </div>
                         </div>
                      </section>
                      <div class="condition_box">
                          <div class="form-group">
                            <div class="col-sm-12">
                               <div class="terms_box">
                               By clicking Submit Ad you accept our <a href="<?php echo $this->webroot; ?>classifieds/terms">Terms of Use</a> & <a href="<?php echo $this->webroot; ?>classifieds/privacy"> Posting Rules</a>
                               </div>
                            </div>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-default btn_submit" id="submit_form">submit</button>
                      <div class="clearfix"></div>
                  </form>
               </div>
             </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="selcat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <section class="light_box">
          <div class="light_box_main">
              <div class="light_box_head">
                <h2>Category</h2>
              </div>
              <div class="light_box_content">
                <ul class="list_light_box">
                    <?php foreach($main_cat as $main1){ ?>
                    <li><a href="javascript:void(0)" class="main_cat1" main="<?php echo $main1["classified_maincategories"]["m_id"] ?>" omg="<?php echo $this->webroot.$main["files"]["base_url"]; ?>"> <span><?php echo utf8_encode($main1["classified_maincategories"]["maincategory"]); ?></span> <i class="fa fa-angle-right"></i></a></li>
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

      $("body").on("click", ".change_maincat", function(){
          $("#myModal").modal("show");
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

      /* Select main category modal 1 */
      $("body").on("click",'.main_cat',function(){
          $('#cat_p3').hide();
          var id = $(this).attr("main");
          var m_id = btoa(id);
          var src = $(this).attr('omg');
          var val = $(this).children("span").text().trim();
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
          var src = $(this).attr('omg');
          var val = $(this).children("span").text().trim();
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
              var cname = $(".country option:selected").text().trim();
              $("#cont_name").val(cname);

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
            var j_list = "";
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
      function readURL(input)
      {
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
          var pass = $("#p_password").val();
          var cpass = $("#p_cpassword").val();
          var uid = $("#user_id").val();
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

          if(pass != cpass)
          {
            $("#p_cpassword").addClass("p_error");
          }else
          {
            $("#p_cpassword").removeClass("p_error");
          }

          if(uid == "" )
          {
          	 alert("Please select user");
          	 return false;
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

      $("body").on("click", ".view_example", function(){
          var url = $(this).attr("main");
          $("#pay_example").attr("src",url);
          $("#view_example").modal("show");
      });

      /* Search User Details */
      $("body").on("keyup", "#search_user", function(){
      		var val = $(this).val();
      		var list = "<option value=''>Select User</option>";
      		if(val.length > 2)
      		{
      			$.ajax({
      					url:"<?php echo $this->webroot; ?>classifiedadmins/searchuser",
      					type:"post",
      					data:{val:val},
      					dataType:"json",
      					success: function(data)
      					{
      						if(data.user.length > 0)
      						{	
      							$.each(data.user, function(i,k){
      								list += '<option email="'+k.User.email+'" pn="'+k.User.phone+'" prov="'+k.User.provider+'" imp="'+k.User.imprint+'" uid="'+k.User.id+'">'+k.User.name+'</option>';
      							});
      						}
      						$("#select_user").html(list);
      					}
      			});
      		}else
      		{
      			$("#select_user").html(list);
      		}
      });

      /* Select User Details */
      $("body").on("change","#select_user", function(){
      		var id = $("option:selected",this).attr("uid");
      		var name = $("option:selected",this).text().trim();
      		var email = $("option:selected",this).attr("email");
      		var pn = $("option:selected",this).attr("pn");
      		var prov = $("option:selected",this).attr("prov");
      		var imp = $("option:selected",this).attr("imp");
      		if(id != undefined && id != "")
      		{
	      		$.ajax({
	      				url:"<?php echo $this->webroot; ?>classifiedadmins/userdetail",
	      				type:"post",
	      				data:{id:id},
	      				dataType:"json",
	      				success: function(data)
	      				{
	      					var us = data.user.users;
	      					$("#name").val(name);
				      		$("#email").val(email);
				      		$("#phone").val(pn);
				      		$("#user_id").val(id);
				      		$(".zipcode").val(us.zipcode);
				      		$(".city").val(us.city);
				      		$(".street_no").val(us.street_no);
				      		$(".state option:selected").val(us.state).text(data.user.states.name);
				      		$('.country option[value='+us.country+']').attr('selected','selected');
				      		if(prov == "commercial")
				      		{
				      			$(".imprint_text").val(imp);
				      			$(".imprint").show();	
				      		}else
				      		{
				      			$(".imprint").hide();	
				      			$(".imprint_text").val("");
				      		}
	      				}
	      		});
      		}	
      });

  });
</script>