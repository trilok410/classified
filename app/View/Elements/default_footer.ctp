<?php $user = $this->Session->read("user"); ?>   
<?php $lang = $this->Session->read('lang'); ?> 
    <!--Footer sec start-->
    <footer id="footer" class="footer_sec">
    	  <section class="ftr_sec2">
        	<div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="ftr_logo"><img src="<?php echo $this->webroot ?>images/logo.png" class="img-responsive"></div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        
                        <div class="ftr_inner">
                            <h2><?php echo $lang["Extras"]; ?></h2>
                            <ul>
                                <li><a href="<?php echo $this->webroot; ?>classifieds/terms"><?php echo $lang["Terms of Use"]; ?></a></li>
                                <li><a href="<?php echo $this->webroot; ?>classifieds/privacy"><?php echo $lang["Privacy Policy"]; ?></a></li>
                                <li><a href="<?php echo $this->webroot; ?>classifieds/contactus"><?php echo $lang["Contact Us"]; ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="ftr_inner">
                            <h2><?php echo $lang["User Menu"]; ?></h2>
                            <ul>
                                <?php if(!empty($user)){ ?>
                                
                                <li>
                                    <a href="<?php echo $this->webroot; ?>users/myaccount"><?php echo $lang["My Account"]; ?></a>
                                </li>
                                <li><a href="<?php echo $this->webroot; ?>users/logout"><?php echo $lang["Logout"]; ?></a></li>
                                <?php }else{ ?>
                                <li><a href="javascript:void(0)" id="login2"><?php echo $lang["Login"]; ?></a></li>
                                <li><a href="javascript:void(0)" id="register1"><?php echo $lang["Register"]; ?></a></li>
                                <li> <a href="javascript:void(0)" id="login2"><?php echo $lang["My Account"]; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="ftr_inner">
                          <div class="language_main">
                            <h2><?php echo $lang["LANGUAGE"]; ?></h2>
                              <ul>
                                  <li><a href="javascript:void(0)" class="change_language" main="1"><img src="<?php echo $this->webroot; ?>images/lang1.png" class="img-responsive"></a></li>
                                  <li><a href="javascript:void(0)" class="change_language" main="2"><img src="<?php echo $this->webroot; ?>images/lang2.png" class="img-responsive"></a></li>
                              </ul>
                            </div>
                            <div class="ftr_social">
                                <h2><?php echo $lang["Follow Us on"]; ?></h2>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>
    <!--Footer sec end-->

    <!-- Sign up model -->
    <div class="modal fade" id="signup_modal" role="dialog" aria-labelledby="gridSystemModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content light_box_wrap">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $lang["Register"]; ?></h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <label><input type="radio" class="change_type login_box" value="1" name="signup"><?php echo $lang["I am already a member"]; ?></label>
                    <label><input type="radio" class="change_type signup_box" value="0" name="signup" checked><?php echo $lang["I am still not a member"]; ?></label>
                </div>
            </div>
            <div class="row register_model">
                <form id="signup_form" method="post">
                  <div class="col-md-12">  
                      <div class="form-group">
                        <input class="form-control" placeholder="Email" type="text" name="email" id="email">
                        <p class="bg-danger erro_box error_email p_hide"></p>
                      </div>
                  </div>
                  <div class="col-md-12">  
                      <div class="form-group">
                          <input class="form-control" placeholder="Password"  type="password" name="password" id="password">
                          <p class="bg-danger erro_box error_password p_hide"></p>
                      </div>
                  </div>
                  <div class="col-md-12">   
                      <div class="fom-group">
                          <input class="form-control" placeholder="Confirm Password" type="password" name="confirm_password" id="cpassword">
                          <p class="bg-danger erro_box error_cpassword p_hide"></p>
                          <p class="bg-success erro_box success_msg p_hide"><?php echo $lang["Registration done successfully, Activation link sent on your Email Id"]; ?></p>
                      </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="fom-group">
                        <p><?php echo $lang["By registering, you agreeto our"]; ?> <a href="<?php echo $this->webroot; ?>classifieds/terms"><?php echo $lang["Terms of Use"]; ?></a><?php echo $lang["and our"]; ?>  <a href="<?php echo $this->webroot; ?>classifieds/privacy"><?php echo $lang["Privacy Policy"]; ?>.</a></p>
                        <div class="agree_terms">
                          <input type="checkbox" name="newslater" value="1">
                          <p><?php echo $lang["I agree to be allowed to be contacted by Classified Email (eg. newsletters or surveys). You can revoke this consent in your settings."]; ?></p>
                        </div>
                    </div>
                  </div>
                </form>
            </div>
            <div class="row register_model2" style="display:none">
                <div class="success_register_main">
                  <div class="success_register"  style="box-shadow:0 0 2px #ccc; padding:15px; max-width:700px; background-color:#fff">
                    <div class="success_register_head" style="color:#FFFF00; background-color:#1598d7; padding:10px; border-radius:4px 4px 0px 0px; text-transform:capitalize; font-size:14px;">
                        <?php echo $lang["Just one step towards the registration"]; ?>
                    </div>
                    <div class="success_register_content" style="padding:10px;">
                        <div class="src_icon"><i class="fa fa-exclamation-circle"></i></div>
                        <div class="src_txt">
                            <?php echo $lang["Confirm registration!"]; ?>
                            <span>
                               <?php echo $lang["You will receive your activation link via email"]; ?>.
                            </span>
                        </div>
                    </div>
                  </div>
                  <div class="success_register_bottom">
                    <h5><?php echo $lang['Please click on the activation link in the email with the subject line "click activation link" to confirm successful your registration']; ?>.</h5>
                    <p><?php echo $lang['By clicking on the registration link you will be logged in and your newly created ad is published. If you after a few minutes no E-mail with the subject: "activation link click" 
                    find in your inbox, then please check to see whether the email was accidentally sorted into the spam folder. You should also get the Spam Folder not find any email from kleinanzeigen.de, then 
                    please check whether the entered email address is correct. If you make a mistake, then you can use your email address here correct']; ?>.   
                    </p>
                  </div>
                </div>
            </div>
          </div>
          <div class="modal-footer register_model">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang["Cancel"]; ?></button>
            <button type="button" class="btn btn-primary" id="register_user"><?php echo $lang["submit"]; ?></button>
            <button type="button" class="btn btn-primary fb_login_btn" onclick="fbSignup();"><span class="fa fa-facebook"></span><?php echo $lang["Facebook"]; ?></button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- login model -->
    <div class="modal fade" id="login_modal" role="dialog" aria-labelledby="gridSystemModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content light_box_wrap">
          <div class="modal-header">
            <button type="button" class="close remove_fav" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel"><?php echo $lang["Login"]; ?></h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="show_error"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label><input type="radio" class="change_type login_box" value="1" name="login" checked><?php echo $lang["I am already a member"]; ?></label>
                    <label><input type="radio" class="change_type signup_box" value="0" name="login"><?php echo $lang["I am still not a member"]; ?></label>
                </div>
            </div>
            <div class="row">
                <form id="login_form" method="post">
                  <div class="col-md-12">
                    <div class="form-group">  
                      <input class="form-control" placeholder="Email" type="text" name="data[User][email]" id="email">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-goup">  
                        <input class="form-control" placeholder="Password" type="password" name="data[User][password]" id="password">
                    </div>
                  </div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
                <div class="col-sm-6 text-left">
                    <span class="keep_me_sign"><input type="checkbox" name="keepsignin"><?php echo $lang["Keep Me sign in"]; ?></span>
                    <a href="javascript:void(0)" class="forget_password"><?php echo $lang[""]; ?>Forget your password?</a>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-default remove_fav" data-dismiss="modal"><?php echo $lang["Cancel"]; ?></button>
                    <button type="button" class="btn btn-primary" id="login_user"><?php echo $lang["Login"]; ?></button>
                    <button type="button" class="btn btn-primary fb_login_btn" onclick="fbLogin();"><span class="fa fa-facebook"></span><?php echo $lang["Facebook"]; ?></button>
                </div>
            </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- forget password modal -->
    <div id="forget_conf_box_post" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete_comment" aria-hidden="true">
           
        <form id="forget_pass">
            <div class="modal-dialog">
                 <div class="modal-content light_box_wrap">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">×</span></button>
                          <h4 class="modal-title"><?php echo $lang["Forgot Password"]; ?></h4>
                     </div>
                 <div class="modal-body">
                    <div class="form-group">
                        <div class="forget_message"></div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="f_email" placeholder="Email" name="email" required>
                    </div>
                   <div class="clear"></div>
                </div>
                <div class="modal-footer">
                    <input type="button" class=" btn btn-danger" id="send_forget" value="<?php echo $lang["submit"]; ?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $lang["Cancel"]; ?></button>
               </div>
            </div>
          </div>
        </form>
    </div>
</main>  
<script type="text/javascript" src="<?php echo $this->webroot ?>js/fblogin.js"></script>
<script>
    $(document).ready(function(){
        $("body").on("click", "#register,#register1", function(){
            $(".register_model").show();
            $(".register_model2").hide();
            $("#signup_modal").modal({
                backdrop: 'static',
                keyboard: false
            })
        });

        $("body").on("click", "#login, #login1,#login2", function(){
            $("#login_modal").modal({
                backdrop: 'static',
                keyboard: false
            })
        });
        
        $("body").on("change",".change_type", function(){
            var val = $(this).val();
            if(val == 1)
            { 
              $(".login_box").prop("checked",true);
              $("#login_modal").modal({
                  backdrop: 'static',
                  keyboard: false
              });
              $("#signup_modal").modal("hide");
            }else if(val == 0)
            {
              $(".signup_box").prop("checked",true);
              $(".register_model").show();
              $(".register_model2").hide();
              $("#signup_modal").modal({
                  backdrop: 'static',
                  keyboard: false
              });
              $("#login_modal").modal("hide");
            }
        });

        /* Register user */
        $("body").on("click", "#register_user", function(){
            $("#signup_form input").each(function(){
                if($(this).val() == "")
                {
                    $(this).addClass("p_error");
                }else{
                    $(this).removeClass("p_error");
                }
            });

            if(!$("#signup_form input").hasClass("p_error"))
            {
                var data = $("#signup_form").serialize();
                $.ajax({
                        url:"<?php echo $this->webroot; ?>users/register",
                        type:"post",
                        data:data,
                        dataType:"json",
                        success: function(data)
                        {
                            if(data.message == "success")
                            {
                                $("#signup_form")[0].reset();
                                //$(".success_msg").show();
                                $(".register_model").hide();
                                $(".register_model2").show();
                                // setTimeout(function(){  
                                //    window.location.reload();
                                // },3500);
                            }else
                            {
                                if(typeof(data.error.email) != 'undefined' )
                                {
                                    $(".error_email").html(data.error.email).show();
                                } 
                                if(typeof(data.error.password) != 'undefined' )
                                {
                                    $(".error_password").html(data.error.password).show();
                                }
                            }
                        }
                });
            }
        });
        
        /* Check Email */
        $("#email, #f_email").on("keypress change", function() {
            var email = $(this).val();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (regex.test(email)) {
                $(this).removeClass("p_error").next("p").hide();
            } else {
                $(this).addClass("p_error").next("p").html("Email should be in correct format").show();
            }
        });

        /* Check password */
        // $("#password,#cpassword").keyup(function() {
        //     var password = $(this).val();
        //     var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
        //     if (regex.test(password)) {
        //         $(this).removeClass("p_error").next("p").hide();
        //     } else {
        //         $(this).addClass("p_error").next("p").html("Password should contain first letter Capital than small letter,Special Character,Numbers minimum 8 Digit").show();
        //     }
        // });

        /* Login User */
        $("body").on("click", "#login_user", function(){
            $("#login_form input").each(function(){
                if($(this).val() == "")
                {
                    $(this).addClass("p_error");
                }else{
                    $(this).removeClass("p_error");
                }
            });

            if(!$("#login_form input").hasClass("p_error"))
            {
                var data = $("#login_form").serialize();
                $.ajax({
                        url:"<?php echo $this->webroot; ?>users/login",
                        type:"post",
                        data:data,
                        dataType:"json",
                        success: function(data)
                        {
                            if(data.message == "success")
                            {
                                window.location.reload();
                            }else
                            {
                                $(".show_error").html(data.message);
                            }
                        }
                });
            }
        });

        $("body").on("click",".forget_password", function(){
            $("#login_modal").modal("hide");
            $("#forget_conf_box_post").modal("show");
        });

        /* Forget Link */
        $("body").on("click", "#send_forget", function(){
            if($("#f_email").val() != "" && !$("#f_email").hasClass("p_error"))
            {
                var data = $("#forget_pass").serialize();
                $.ajax({
                        url:"<?php echo $this->webroot ?>users/forgotpassword",
                        type:"post",
                        data:data,
                        dataType:"json",
                        success: function(data)
                        {
                            if(data.message == "success")
                            {   
                                $('#forget_pass')[0].reset();
                                $(".forget_message").html("Reset Password link sent on your mail");
                                setTimeout(function(){ $("#forget_conf_box_post").modal("hide"); },1500);
                            }else
                            {
                                $(".forget_message").html(data.message);
                            }
                        }
                });
            }else
            {
                $("#f_email").addClass("p_error")
            }
        });

        $('.header_right ul li').hover(function() {
            $(this).children('ul').stop(true, false, true).slideToggle(300);
        });

        /* change language */
        $("body").on("click",".change_language", function(){
            var val = $(this).attr("main");
            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifieds/changelanguage",
                    type:"post",
                    data:{ val:val},
                    dataType:"json",
                    success: function(data)
                    {
                        window.location.reload();
                    }
            });
        });
    });
</script>