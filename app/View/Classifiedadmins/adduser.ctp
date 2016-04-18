<div class="container-fluid" id="content"> 
    <!-- Page Heading -->
    <div class="col-lg-12"> 
      <h3 class="page-header">Create User</h3>
    </div>
    <div class="row">
      <div class="col-md-8">
      		<form class="form-horizontal" action="<?php echo $this->webroot; ?>classifiedadmins/adduser" method="post">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">User Type</label>
			    <div class="col-sm-10">
			      	<label class="radio-inline"><input type="radio" class="provider_type" value="private" name="provider" checked>Private</label>
                	<label class="radio-inline"><input type="radio" class="provider_type" value="commercial" name="provider">commercial</label>
                </div>
			  </div>
			  <div class="form-group">
	              <label for="name" class="col-sm-2 control-label">name</label>
	              <div class="col-sm-10">
	                <input type="text" class="form-control" name="name" id="name" placeholder="" required>
	              </div>
	          </div>
	          <div class="form-group imprint"  style="display:none">
                  <label for="text" class="col-sm-2 control-label">Imprint</label>
                  <div class="col-sm-10">
                    <textarea class="form-control show_tip imprint_text" name="imprint"></textarea>
                  </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control check_mail" name="email" id="email" placeholder="" required>
                  <span class="show_error check_mail_exist" style="display:none">Email Already Exist!</span>
                </div>
              </div>
              <div class="form-group current">
	              <label for="text" class="col-sm-2 control-label">Password</label>
	              <div class="col-sm-10">
	                <input type="password" class="form-control" name="password" id="p_password" placeholder="" required>
	              </div>
	            </div>
	            <div class="form-group current">
	              <label for="text" class="col-sm-2 control-label">Confirm Password</label>
	              <div class="col-sm-10">
	                <input type="password" class="form-control" name="confirm_password" id="p_cpassword" placeholder="" required>
	              </div>
	          </div>
	          <div class="form-group" >
	                <label for="name" class="col-sm-2 control-label">Country</label>
	                <div class="col-sm-10">
	                  <select class="form-control country" name="country" required>
	                        <option value="">Country</option>
	                        <?php foreach($country as $cont){ ?>
	                        <option main="<?php echo $cont["countries"]["code"]; ?>" value="<?php echo $cont["countries"]["id"]; ?>"><?php echo $cont["countries"]["name"]; ?></option>
	                        <?php } ?>
	                  </select>
	                </div>
	          </div>
	          <div class="form-group" >
	                <label for="name" class="col-sm-2 control-label">State</label>
	                <div class="col-sm-10">
	                  <select class="form-control state" name="state" required>
	                      <option value="">State</option>
	                  </select>
	                </div>
	          </div>
	          <div class="form-group" >
                    <label for="name" class="col-sm-2 control-label">Zip Code</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control zip zipcode" name="zipcode" required>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control city" name="city" Placeholder="City" readonly="" required>
                        <div class="show_place" style="display:none"></div>
                    </div>
              </div>
              <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-10">
                    <textarea name="street_no" class="form-control" required></textarea>
                  </div>
              </div>
              <div class="form-group current">
	              <label for="text" class="col-sm-2 control-label">Phone Number</label>
	              <div class="col-sm-10">
	                <input type="text" class="form-control" name="phone" id="phone" placeholder="" maxlength="15" required>
	              </div>
	          </div>
			  <div class="form-group">
			    <label for="" class="col-sm-2 control-label">Map</label>
			    <div class="col-sm-10" >
			      	 <div id="map"></div>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" id="submit_form" class="btn btn-primary">Create</button>
			    </div>
			  </div>
			</form>
      </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmlyK9ixyiCOGAU2PTw6cw0uDT1qI-FR4&callback=initMap"
    async defer></script>
<script>
var map;
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -34.397, lng: 150.644},
      zoom: 8
    });
  }
$(document).ready(function(){
  
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

  /* Check Email */
  $("body").on("keyup blur",".check_mail", function(){
      var val = $(this).val();
      if(val.length > 5)
      {
          $.ajax({
                url:"<?php echo $this->webroot; ?>classifieds/checkemail",
                type:"post",
                data:{val:val},
                dataType:"json",
                success: function(data)
                {
                  if(data.message == "exist")
                  {
                    $(".check_mail").addClass("p_error");
                    $(".check_mail_exist").show();
                  }else
                  {
                    $(".check_mail").removeClass("p_error");
                    $(".check_mail_exist").hide();
                  }
                }
          });
      }
  });

  /* Check Empty fields*/
  $('body').on("click","#submit_form",function(){
      var city = $(".city").val();
      var pass = $("#p_password").val();
      var cpass = $("#p_cpassword").val();
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

      if($("#post_adform input").hasClass("p_error"))
      {
          return false;
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
});
</script>

