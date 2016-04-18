<?php $lang = $this->Session->read('lang'); ?>
</section>
	
<!--conten sec start-->
<div class="conten">
   <div class="adds_main">
       <div class="container">
         <div class="row">
           <div class="col-md-12 col-sm-12">
              <div class="adds_main_head">
                 <h1><?php echo $lang["Account Settings"] ?> </h1>
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
                      <li role="presentation" class="active"><a href="javascript:void(0)"><?php echo $lang["Settings"]; ?></a></li>
                      <li role="presentation"><a href="<?php echo $this->webroot; ?>users/paymenthistory"><?php echo $lang["Payment History"]; ?></a></li>
                      <li role="presentation"><a href="<?php echo $this->webroot ?>users/favoritead"><?php echo $lang["Favorite Ads"] ?></a></li>
                      <li role="presentation"><a href="<?php echo $this->webroot ?>users/savesearch"><?php echo $lang["Favorite searches"]; ?></a></li>
                      <li role="presentation"><a href="<?php echo $this->webroot ?>users/billing"><?php echo $lang["billing address"]; ?></a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="messages">
                        <div class="show_message">
                            <div class="alert alert-success success" role="alert" style="display:none">Data Updated Successfully.</div>
                            <div class="alert alert-danger error" role="alert" style="display:none">There are some Error in Updating Data.</div>
                        </div>
                        <div class="accordian_wrap">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                  <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <?php echo $lang["Change Contact Details"]; ?>
                                      </a>
                                      <div class="accor_icon"><i class="fa fa-angle-down"></i></div>
                                    </h4>
                                  </div>
                                  <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <form id="contact_detail">
                                          <div class="select_box">
                                              <label for="select" class="control-label"><?php echo $lang["Country"]; ?></label>
                                              <select class="form-control input" id="country" name="country">
                                                  <option value=""><?php echo $lang["Select"]." ".$lang["Country"]; ?></option>
                                                  <?php foreach($country as $cont){ ?> 
                                                  <option value="<?php echo $cont["countries"]["id"]; ?>" <?php echo ($cont["countries"]["id"] == $u_data["users"]["country"])? "selected" : ""; ?> main="<?php echo $cont["countries"]["code"]; ?>"><?php echo $cont["countries"]["name"]; ?></option>
                                                  <?php } ?>
                                              </select>
                                          </div>
                                          <div class="select_box">
                                              <label for="select" class="control-label"><?php echo $lang["State"]; ?></label>
                                              <select class="form-control input" id="state" name="state">
                                                  <option value="<?php echo $u_data["users"]["state"]; ?>"><?php echo $u_data["states"]["name"]; ?></option>
                                              </select>
                                          </div>
                                          <div class="form-group">
                                              <label for="name"><?php echo $lang["Zip Code"]; ?></label>
                                              <input type="text" class="form-control input" id="zipcode" name="zipcode" value="<?php echo $u_data["users"]["zipcode"]; ?>" placeholder="<?php echo $lang["Zip Code"]; ?>">
                                          </div>
                                          <div class="form-group">
                                            <label for="name"><?php echo $lang["CITY"]; ?></label>
                                            <input type="text" class="form-control input" id="city" value="<?php echo $u_data["users"]["city"]; ?>" name="city" placeholder="<?php echo $lang["CITY"]; ?>" readonly>
                                            <div class="show_place show_city" style="display:none"></div>
                                          </div>
                                          <div class="form-group">
                                            <label for="name"><?php echo $lang["Address"]; ?></label>
                                            <input type="text" class="form-control input" id="street_no" value="<?php echo $u_data["users"]["street_no"]; ?>" name="street_no" placeholder="<?php echo $lang["Address"]; ?>">
                                          </div>
                                          <div class="form-group">
                                            <h2><?php echo $lang["provider type"]; ?></h2>
                                          </div>
                                          <div class="form-group">
                                            <label class="radio-inline"><input type="radio" class="provider_type" value="private" name="provider" <?php echo ($u_data["users"]["provider"] == "private")? "checked" : "";  ?> ><?php echo $lang["Private"]; ?></label>
                                            <label class="radio-inline"><input type="radio" class="provider_type" value="commercial" name="provider"  <?php echo ($u_data["users"]["provider"] == "commercial")? "checked" : "";  ?>><?php echo $lang["commercial"]; ?></label>
                                            <label><button type="button" class="btn provider_tip"><i class="fa fa-question-circle"></i></button>
                                               <span class="tooltip1" style="display:none">
                                                <?php echo $tip[6]; ?>
                                               </span>
                                            </label>
                                          </div>
                                          <div class="form-group">
                                            <label for="name"><?php echo $lang["name"]; ?></label>
                                            <input type="text" class="form-control input" id="name" value="<?php echo $u_data["users"]["name"]; ?>" name="name" placeholder="<?php echo $lang["name"]; ?>">
                                          </div>
                                          <div class="form-group">
                                            <label for="phonenumber"><?php echo $lang["Phone Number"]; ?></label>
                                            <input type="text" class="form-control input" id="phone" name="phone" value="<?php echo $u_data["users"]["phone"]; ?>" maxlength="15" placeholder="<?php echo $lang["Phone Number"]; ?>">
                                          </div>
                                          <?php if($u_data["users"]["provider"] == "commercial"){ ?>
                                          <div class="form-group imprint">
                                            <label for="imprint"><?php echo $lang["Imprint"]; ?>
                                              <button type="button" class="btn imprint_tip"><i class="fa fa-question-circle"></i></button>
                                              <span class="imprint_info" style="display:none">
                                                <?php echo $tip[5]; ?>
                                              </span>
                                            </label>
                                            <textarea class="form-control show_tip imprint_text" name="imprint"><?php echo $u_data["users"]["imprint"]; ?></textarea>
                                          </div>
                                          <?php }else{ ?>
                                          <div class="form-group imprint"  style="display:none">
                                            <label for="imprint"><?php echo $lang["Imprint"]; ?>
                                              <button type="button" class="btn imprint_tip"><i class="fa fa-question-circle"></i></button>
                                              <span class="imprint_info" style="display:none">
                                                Add small overlays of content, like those on the iPad, to any element for housing secondary information. Popovers whose both title and 
                                              </span>
                                            </label>
                                            <textarea class="form-control show_tip imprint_text" name="imprint"></textarea>
                                          </div>
                                          <?php } ?>
                                          <div class="form-group">
                                            <label for="email"><?php echo $lang["Email"]; ?></label>
                                            <input type="text" class="form-control" value="<?php echo $u_data["users"]["email"]; ?>" readonly>
                                          </div>
                                          <div class="form-group">
                                            <label for="ppp"><?php echo $lang["Privacy Policy"]; ?></label>
                                            <label class="radio-inline1"><input type="checkbox" class="" value="1" name="newslater" <?php echo ($u_data["users"]["newslater"] == "1")? "checked" : "";  ?> ><?php echo $lang["I agree to be allowed to be contacted by Classifieds Email( eg newsletter or surveys)"]; ?></label>
                                          </div>
                                          <button type="button" class="btn_setting save_contact"><?php echo $lang["Save"]; ?></button>
                                        </form>  
                                    </div>
                                  </div>
                                </div>
                                <div class="panel panel-default">
                                  <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <?php echo $lang["Change Password"]; ?>
                                      </a>
                                      <div class="accor_icon"><i class="fa fa-angle-down"></i></div>
                                    </h4>
                                  </div>
                                  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                   <div class="panel-body">
                                      <form id="change_password">
                                          <div class="form-group">
                                              <label for="exampleInputPassword1"><?php echo $lang["Old Password"]; ?>*</label>
                                              <input type="password" class="form-control input" id="oldpassword" name="oldpassword" placeholder="<?php echo $lang["Old Password"]; ?>">
                                              <p id="old_error" style="display:none">Old Password is incorrect</p>
                                          </div>
                                          <div class="form-group">
                                              <label for="exampleInputPassword1"><?php echo $lang["New Password"]; ?>*</label>
                                              <input type="password" class="form-control input" id="npassword" name="password" placeholder="<?php echo $lang["New Password"]; ?>">
                                          </div>
                                          <div class="form-group">
                                              <label for="exampleInputPassword2"><?php echo $lang["Confirm Password"]; ?>*</label>
                                              <input type="password" class="form-control input" id="confpassword" name="confirm_password" placeholder="<?php echo $lang["Confirm Password"]; ?>">
                                          </div>
                                          <button type="button" class="btn_setting save_password"><?php echo $lang["Change Password"]; ?></button>
                                      </form>
                                   </div>
                                  </div>
                                </div>
                                <div class="panel panel-default email_panel">
                                    <div class="panel-heading" role="tab" id="headingfour">
                                      <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                          <?php echo $lang["Change Email"]; ?>
                                        </a>
                                        <div class="accor_icon"><i class="fa fa-angle-down"></i></div>
                                      </h4>
                                    </div>
                                    <div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                      <div class="panel-body">
                                       <p><?php echo $lang["To change your e-mail address, you will receive two emails from us."]; ?></p>
                                        <ul class="email_top">
                                          <li><?php echo $lang["For your safety we send an email to your current email address. This is for information."]; ?> </li>
                                          <li><?php echo $lang["You still get an email to your new email address. Please confirm by selecting the link in the email that you are the owner of this email account. The change is now complete."]; ?></li>
                                        </ul>
                                        <p><?php echo $lang["For more information, see the"]; ?> <a href="#"><?php echo $lang["help"]; ?></a> <?php echo $lang["section"]; ?></p>
                                        <form id="email_section">
                                           <div class="form-group">
                                           <div class="alert alert-success success_mail" role="alert" style="display:none">Mail Sent successfully</div>
                                            <label for="exampleInputEmail1"><?php echo $lang["Registered Email"]; ?> </label>
                                            <input type="text" class="form-control input" id="" name="remail" value="<?php echo $u_data["users"]["email"]; ?>" readonly>
                                           </div>
                                           <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $lang["new Email"]; ?></label>
                                            <input type="text" class="form-control input" id="nemail" name="nemail" placeholder="<?php echo $lang["new Email"]; ?>">
                                            <p class="show_error"></p>
                                           </div>
                                           <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo $lang["Repeat new Email"]; ?></label>
                                            <input type="text" class="form-control input" id="rnemail" placeholder="<?php echo $lang["Repeat new Email"]; ?>">
                                            <p class="show_error"></p>
                                           </div>
                                            <button type="button" class="btn_setting change_email"><?php echo $lang["Save"]; ?></button>
                                           </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                  <div class="panel-heading" role="tab" id="headingsix">
                                    <h4 class="panel-title">
                                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                                        <?php echo $lang["Delete Account"]; ?>
                                      </a>
                                      <div class="accor_icon"><i class="fa fa-angle-down"></i></div>
                                    </h4>
                                  </div>
                                  <div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                     <div class="delete_main">
                                       <div class="dm_head">
                                        <h3><?php echo $lang["delete this account:"]; ?></h3>
                                       </div>
                                       <div class="dm_content">
                                         <p><b><?php echo $lang["ATTENTION:"]; ?></b> <?php echo $lang["Please not that all existing data will be deleted and your account"]; ?> <b><?php echo $lang["can not be reactivated"]; ?></b> <?php echo $lang["after you have completed your membership."]; ?></p>
                                         <p><?php echo $lang["Why you want to delete your account?"]; ?></p>
                                         <div class="radio">
                                            <label>
                                              <input type="radio" name="reason" id="" value="0" checked>
                                              <?php echo $lang["The user account is no longer needed"]; ?>
                                            </label>
                                        </div>
                                        <div class="radio">
                                          <label>
                                            <input type="radio" name="reason" id="" value="1">
                                            <?php echo $lang["due to dissatisfaction - Please tell us why you were disatisfied:"]; ?>
                                          </label>
                                        </div>
                                        <textarea class="form-control" rows="2"></textarea>

                                       </div>

                                       <div class="delete_btn">
                                        <button type="button" class="btn_setting_del del"><?php echo $lang["Delete Account"]; ?></button>
                                       </div>
                                     </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
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
<script type="text/javascript">
   $(document).ready(function(){
      /* Get States By Country */
      $("body").on("change", "#country", function(){
          var id = $(this).val();
          if(id != "")
          {
            $.ajax({
                    url:"<?php echo $this->webroot; ?>users/getstates",
                    type:"post",
                    data:{id:id},
                    dataType:"json",
                    success: function(data)
                    {
                      var j_list = "";
                      j_list = '<option value="">States</option>';
                      if(data.states != "")
                      { 
                         
                         $.each(data.states, function(i,st){
                            j_list += '<option value="'+st.states.id+'">'+st.states.name+'</option>';
                         });
                         $("#state").html(j_list);
                      }else{
                         $("#state").html(j_list);
                      }
                    }
            });
          }else
          {
            var j_list = "";
            j_list = '<option value="">States</option>';
            $("#state").html(j_list);
          }
          $("#zipcode").val("");
          $("#city").val("");
      }); 
      
      /***  Get City by zipcode **/
      $("body").on("blur","#zipcode",function(){
          var val = $(this).val().trim();
          if(val != "" && val.length >= 5)
          {
            if($("#country").val() != "")
            {
              var code = $("#country option:selected").attr("main");
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
                    $("#zipcode").removeClass("p_error");
                  },
                  error: function(resonse)
                  {
                      $ (".show_place").html("No Place found").show();
                      $("#zipcode").addClass("p_error");
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
          $ ("#city").val(city).removeClass("p_error");
          $ (".show_place").html("").hide();
      });

      /* Save Contact Detail */
      $("body").on("click", ".save_contact", function(){
          $("#contact_detail .input").each(function(){
              if($(this).val() == "")
              {
                 $(this).addClass("p_error");
              }
          });
          if(!$("#contact_detail .input").hasClass("p_error"))
          {
              var data = $("#contact_detail").serialize();  
              $.ajax({
                      url:"<?php echo $this->webroot; ?>users/setting",
                      type:"post",
                      data:data,
                      dataType:"json",
                      success: function(data)
                      {
                          show_message(data.message);
                      }
              });
          }
      });

      /* Change Password */
      $("body").on("click",".save_password", function(){
          $("#change_password .input").each(function(){
              if($(this).val() == "")
              {
                 $(this).addClass("p_error");
              }
          });

          if($("#npassword").val() != $("#confpassword").val())
          {
              $("#confpassword").addClass("p_error");
          }

          if(!$("#change_password .input").hasClass("p_error"))
          {
              var data = $("#change_password").serialize();
              $.ajax({
                      url:"<?php echo $this->webroot; ?>users/changepassword",
                      type:"post",
                      data:data,
                      dataType:"json",
                      success: function(data)
                      {
                        $("#change_password")[0].reset();
                        if(data.message == "password")
                        {
                          $("#oldpassword").addClass("p_error");
                          $("#old_error").show();
                        }else
                        {
                          show_message(data.message);
                        }
                      }
              });
          }
      });

      /* Check Numeric */
      $("body").on("keyup",'#phone',function(){
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

      /* Remove Class From Inputs*/
      $('body').on("change keyup","#oldpassword,#npassword,#state, #confpassword,#country,#city,#street_no,.imprint_text,#name", function(){
          if($(this).val() != "")
          {
            $(this).removeClass("p_error");
            $("#old_error").hide();
          }else
          {
            $(this).addClass("p_error");
          }
      });

      /* show / hide imprtint */
      $("body").on("change", ".provider_type", function(){
          var val = $(this).val();
          if(val == "commercial")
          {
              $(".imprint").show();
              $(".imprint_text").addClass("input");

          }else
          {
            $(".imprint").hide();
            $(".imprint_text").removeClass("input").val("");
          }
      });

      /* show provider tooltip1 */
      $("body").on("click", ".provider_tip", function(){
        $(".tooltip1").toggle();
      });

      /* show imprint_tip */
      $("body").on("click",".imprint_tip", function(){
        $(".imprint_info").toggle();
      });

      /* Change email */
      $("body").on("click", ".change_email", function(){
          var nemail = $("#nemail").val();
          var remail = $("#rnemail").val();
          $("#email_section .input").each(function(){
              if($(this).val() == "")
              {
                $(this).addClass("p_error");
              }
          });

          if(nemail == remail)
          {
            if(!$("#email_section .input").hasClass("p_error"))
            {
               var data = $("#email_section").serialize();
               $.ajax({
                      url:"<?php echo $this->webroot; ?>users/changeemail",
                      type:"post",
                      data:data,
                      dataType:"json",
                      success: function(data)
                      {
                        if(data.message == "success")
                        {
                          $(".success_mail").show();
                          $("#email_section")[0].reset();
                        }else{
                          $("#nemail").addClass("p_error").next("p").html(data.message).show();
                        }
                      }
               });
            }
          }else{
            $("#rnemail").addClass("p_error").next("p").html("Email not matched").show();
          }
      });

      /* Check Email */
      $("#nemail, #rnemail").on("keypress change",function() {
          var email = $(this).val();
          var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if (regex.test(email)) {
              $(this).removeClass("p_error").next("p").hide();
          }else {
              $(this).addClass("p_error").next("p").html("Email should be in correct format").show();
          }
      });

      $("body").on("click",".btn_setting_del", function(){
          if(confirm("Are you sure!"))
          {
            $.ajax({
                  url:"<?php echo $this->webroot ?>users/deleteaccount",
                  type:"post",
                  dataType:"json",
                  success: function(data)
                  {
                    if(data.message == "success")
                    {
                       window.location.href="<?php echo $this->webroot; ?>users/logout";
                    }
                  }
            });  
          }else{
            return false;
          }
          
      });
   });

   function show_message(cl)
   {
      $("."+cl).show();
      setTimeout(function(){ $("."+cl).hide(); },1500);
   }   
</script>