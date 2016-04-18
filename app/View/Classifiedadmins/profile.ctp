<div class="container-fluid" id="content"> 
      <div class="row">
          <div class="col-md-3 col-sm-3">
              <aside class="settings_left">
                  <ul>
                      <li><a href="javascript:void(0)"><span class="icon icon-cogs"></span>Profile</a></li>
                    </ul>
                </aside>
            </div>
            <div class="col-md-9 col-sm-9">
              <div class="settings_right">
                  <h4>User Profile</h4>
                    <ul>
                        <li>
                        <a href="javascript:void(0)">
                            <div class="set_field">
                            Name
                            </div>
                            <div class="set_value">
                              <span class="stname"><?php echo $user["Admin"]["first_name"]." ".$user["Admin"]["last_name"]; ?></span>
                            </div>
                            <div class="set_delete">
                              <span class=" fa fa-pencil"></span>Edit
                            </div>
                            <div class="clear"></div>
                        </a>
                        <div class="edit_name">
                              <div class="set_field">
                                   <span class="edited_name"> Name</span>
                                    </div>
                                    <div class="set_value">
                                    <form role="form" class="form-horizontal">
                                    <div class="form-group">
                                          <label for="name" class="control-label col-sm-4">
                                            First Name
                                            </label>
                                            <div class="col-sm-6">
                                              <input type="text" name="f_name" id="f_name" class="form-control" value="<?php echo $user["Admin"]["first_name"]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="name" class="control-label col-sm-4">
                                            Last Name
                                            </label>
                                            <div class="col-sm-6">
                                              <input type="text" name="l_name" id="l_name" class="form-control" value="<?php echo $user["Admin"]["last_name"]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <div class="col-sm-6 col-sm-offset-4">
                                              <input type="button" id="submit_name" value="Save Changes" class="btn btn-success btn-sm">
                                                <input type="button" value="Cancel" class="btn btn-danger btn-sm">
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                        </li>
                         <li>
                        <a href="javascript:void(0)">
                            <div class="set_field">
                            Contact No.
                            </div>
                            <div class="set_value">
                            <?php echo $user["Admin"]["contact_no"]; ?>
                            </div>
                            <div class="set_delete2">
                              <span class=" fa fa-pencil"></span>Edit
                            </div>
                            <div class="clear"></div>
                        </a>
                        
                       <div class="edit_contact">
                              <div class="set_field">
                                   <span class="edited_name">Contact No.</span>
                                    </div>
                                    <div class="set_value">
                                    <div class="form-group">
                                          <label for="name" class="control-label col-sm-4">
                                           Contact No.
                                            </label>
                                            <div class="col-sm-6">
                                              <input type="text" class="form-control" name="contact_no" id="contact_no" value="<?php echo $user["Admin"]["contact_no"]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <div class="col-sm-6 col-sm-offset-4">
                                              <input type="button" value="Save Changes" id="submit_contact" class="btn btn-success btn-sm">
                                                <input type="button" value="Cancel" class="btn btn-danger btn-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                         </li>
                         <li>
                        <a href="javascript:void(0)">
                            <div class="set_field">
                            Web Address
                            </div>
                            <div class="set_value">
                            <?php echo $user["Admin"]["web_address"]; ?>
                            </div>
                            <div class="set_delete3">
                              <span class=" fa fa-pencil"></span>Edit
                            </div>
                            <div class="clear"></div>
                        </a>
                        
                       <div class="edit_webaddress">
                              <div class="set_field">
                                   <span class="edited_name">Web Address</span>
                                    </div>
                                    <div class="set_value">
                                    <div class="form-group">
                                          <label for="name" class="control-label col-sm-4">
                                            Web Address
                                            </label>
                                            <div class="col-sm-6">
                                              <input type="text" class="form-control" name="web_address" id="web_address" value="<?php echo $user["Admin"]["web_address"]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <div class="col-sm-6 col-sm-offset-4">
                                              <input type="button" value="Save Changes" id="submit_web" class="btn btn-success btn-sm">
                                                <input type="button" value="Cancel" class="btn btn-danger btn-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                         </li>

                        <li>
                        <a href="javascript:void(0)">
                            <div class="set_field">
                            Password
                            </div>
                            <div class="set_value">
                            *********
                            </div>
                            <div class="set_delete4">
                              <span class=" fa fa-pencil"></span>Edit
                            </div>
                            <div class="clear"></div>
                        </a>
                        <div class="edit_pass">
                              <div class="set_field">
                                   <span class="edited_name">Password</span>
                                    </div>
                                    <div class="set_value">
                                        <form class = "form-horizontal" id="password_change">
                                      <div class="form-group">
                                          <label for="name" class="control-label col-sm-4">
                                            Current Password
                                            </label>
                                            <div class="col-sm-6">
                                              <input type="password" name="cur_pass" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="name" class="control-label col-sm-4">
                                            New Password
                                            </label>
                                            <div class="col-sm-6">
                                              <input type="password" name="password" class="form-control" id="password">
                                            <div class="error_d">
                                            <div class="erro_b">first letter Capital than small letter,Special Character,Numbers minimum 8 Digit</div>
                                        </div> 
                                                </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="name" class="control-label col-sm-4">
                                            Re Type New Password
                                            </label>
                                            <div class="col-sm-6">
                                              <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                                            <div class="error_d">
                                            <div class="erro_b">first letter Capital than small letter,Special Character,Numbers minimum 8 Digit</div>
                                        </div> 
                                                </div>
                                        </div>
                                        <div class="form-group">
                                          <div class="col-sm-6 col-sm-offset-4">
                                              <input type="button" name="updatepass" id="updatepass" value="Save Changes" class="btn btn-success btn-sm">
                                                <input type="button" value="Cancel" class="btn btn-danger btn-sm">
                                            </div>
                                        </div>
                                            <div class="text-danger" id="password_error"></div>
                                     </form>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
 <script>
    $(document).ready(function(){
        //jquery for edit name start
            $('.set_delete').click(function() {
                $('.edit_name').css('display','block');
                $(this).parent('li a').css('display','none');
            });
            
            $('.edit_name .btn-danger').click(function() {
                $('.edit_name').css('display','none');
                $('.settings_right li a').css('display','block');
            });
            //jquery for edit name end
            
           
            //jquery for edit contact start
            $('.set_delete2').click(function() {
                $('.edit_contact').css('display','block');
                $(this).parent('li a').css('display','none');
            });
            
            $('.edit_contact .btn-danger').click(function() {
                $('.edit_contact').css('display','none');
                $('.settings_right li a').css('display','block');
            });
            //jquery for edit contact  end

            //jquery for edit web address start
            $('.set_delete3').click(function() {
                $('.edit_webaddress').css('display','block');
                $(this).parent('li a').css('display','none');
            });
            
            $('.edit_webaddress .btn-danger').click(function() {
                $('.edit_webaddress').css('display','none');
                $('.settings_right li a').css('display','block');
            });
            //jquery for edit web address end
            
            
            //jquery for edit password start
            $('.set_delete4').click(function() {
                $('.edit_pass').css('display','block');
                $(this).parent('li a').css('display','none');
            });
            
            $('.edit_pass .btn-danger').click(function() {
                $('.edit_pass').css('display','none');
                $('.settings_right li a').css('display','block');
            });
            //jquery for edit password end
    });
 </script>
  <script>
    $(document).ready(function(){
        $('#submit_name').click(function(){
            var f_name = btoa($('#f_name').val());
            var l_name = btoa($('#l_name').val());

            $.ajax({
                     type:"post",
                     url:"<?php echo $this->webroot ?>classifiedadmins/updatesettings",
                     data:"f_name="+f_name+"&l_name="+l_name,
                     dataType:"json",
                     success: function(data){
                        if(data.message == 'success'){
                          window.location.reload();  
                        }
                     }
                });
        });

        $('#submit_contact').click(function(){
            var contact_no = btoa($('#contact_no').val());
            $.ajax({
                     type:"post",
                     url:"<?php echo $this->webroot ?>classifiedadmins/updatesettings",
                     data:"contact_no="+contact_no,
                     dataType:"json",
                     success: function(data){
                        if(data.message == 'success'){
                           window.location.reload();   
                        }
                     }
                });
        });

        $('#submit_web').click(function(){
            var web_address = btoa($('#web_address').val());
            $.ajax({
                     type:"post",
                     url:"<?php echo $this->webroot ?>classifiedadmins/updatesettings",
                     data:"web_address="+web_address,
                     dataType:"json",
                     success: function(data){
                        if(data.message == 'success'){
                           window.location.reload();   
                        }
                     }
                });
        });
        
    $("#updatepass").click(function(){
    if($(".form-group").hasClass("error")){
    alert("Please fill all red tabs");
    return false;
    }else{
    var data = $("#password_change").serialize();
           $.ajax({
                     type:"post",
                     url:"<?php echo $this->webroot ?>classifiedadmins/updatepassword",
                     data:data,
                     dataType:"json",
                     success: function(data){
                      $("#password_error").text(data.message);
                      $("#password_error").show().delay(5000).fadeOut(function(){
                      window.location.reload();      
                      });                              
                     }
                });
  
    
    }
    });
    
    $("#password,#confirm_password").keyup(function() {
            var password = $(this).val();

            var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
            if (regex.test(password)) {
                $(this).closest(".form-group").removeClass("p_error");
            } else {
                $(this).closest(".form-group").addClass("p_error");
            }
        });
        
        
        
    });
 </script>
 