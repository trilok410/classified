<?php if($message == "success"){ ?>
<script> 
 $(document).ready(function(){
  $("#reset_conf_box_post").modal("show");
 });
 </script>
 <?php }else{?>
 <script>
    $(document).ready(function(){
    $("#error_body").html("<h5><?php echo $message ?></h5>");
    $("#register_error").modal("show");
  });
</script> 
<?php } ?>

 <div id="reset_conf_box_post" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete_comment" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
             <span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
             <h4 class="modal-title">Reset your password</h4>
         </div>
         <div class="modal-body">
           <div class="form-group col-md-9">
                <label for="event name" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-7 check_input">
                     <input type="password" class="form-control" name="password" id="password" required>
                </div>
          </div>
          <div class="form-group col-md-9">
                <label for="event name" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-7 check_input">
                     <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                </div>
          </div>
          <div class="clear"></div>
          </div>
        <div class="modal-footer">
        <input type="hidden" value="<?php echo $user_id; ?>" id="user_id">
        <input type="button" class=" btn btn-danger" id="reset_pass" value="Submit">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
       </div>
    </div>
  </div>
</div>
 <div class="modal fade success" id="register_successfully" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="sum_from">
    <div class="modal-header">
    <button type="button" class="close close_popup" data-dismiss="modal"><span aria-hidden="true">X</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">Classified-Reset Password</h4>
    </div>
        <div class="modal-body">
            <h5>Your Password Reset Successfully.</h5>
        </div>
    <div class="modal-footer">
    <input type="button" class="btn btn-danger close_popup" value="OK"/>
    </div></div></div></div></div>   
      <div class="modal fade error" id="register_error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="sum_from">
    <div class="modal-header">
    <button type="button" class="close close_popup" data-dismiss="modal"><span aria-hidden="true">X</span><span class="sr-only">Close</span></button>
    <h2 class="modal-title" id="myModalLabel">Classified-Error</h2>
    </div>
    <div class="modal-body" id="error_body"></div>
    <div class="modal-footer">
    <input type="button" class="btn btn-default close_popup" value="OK"/>
    </div></div></div></div></div>   
<script>
$(document).ready(function(){

   $("#password,#confirm_password").keyup(function(){
   var password = $(this).val(); 
  
   var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
   if(regex.test(password)){   
   $(this).closest(".check_input").removeClass("error");
   }else{
   $(this).closest(".check_input").addClass("error");    
   }    
  });

 $('#reset_pass').click(function(){

  var pass = $('#password').val();
  var c_pass = $('#confirm_password').val();
  // if(pass != c_pass)
  // {
  //   $('#confirm_password').addClass("error");
  //   return false;
  // }
  var id = $('#user_id').val();
  $.ajax({
       type: "post",   // Request method: post, get
       url: "<?php echo $this->webroot ?>users/resetpassword",  // URL to request
       data:"pass="+pass+"&c_pass="+c_pass+"&id="+id,
       dataType: "json", // Expected response type
       success: function(data){   
               if(data.message == 'success'){
                $("#reset_conf_box_post").modal("hide");
                $("#register_successfully").modal("show"); 
                }else{
                $("#error_body").html("<h5>"+data.message+"</h5>");
                $("#reset_conf_box_post").modal("hide");
                $("#register_error").modal("show");
                }
            },
        error: function(response, status) {
              //console.log(response);
        }
     
    });

 });


});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $(".close_popup").click(function(){
    window.location.href =  "<?php echo $this->webroot ?>";   
 });
});
</script>