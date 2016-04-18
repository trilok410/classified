  <div style="margin-top: 15px;" >
    <div>
      <div class="col-xs-12 col-sm-12 col-md-12 toppad" >
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title"><?php if(!empty($user[0]["users"]["name"])){ echo $user[0]["users"]["name"]; }?></h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class=" col-md-12 col-lg-9 "> 
                <table class="table table-user-information" style="margin-top: 15px;">
                  <tbody>
                    <tr>
                      <td  style="border-top: none !important;">Name:</td>
                      <td style="border-top: none !important;"><?php if(!empty($user[0]["users"]["name"])){ echo " ". $user[0]["users"]["name"]; }?></td>
                    </tr>
                    <tr>
                      <td>Registered Date</td>
                      <td><?php if(!empty($user[0]["users"]["created_date"])){ echo date('Y-m-d', strtotime($user[0]["users"]["created_date"]));} ?></td>
                    </tr>
                    <tr>
                      <td>Contact No.</td>
                      <td><?php if(!empty($user[0]["users"]["phone"])){ echo $user[0]["users"]["phone"]; }else{}?></td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td><?php if(!empty($user[0]["users"]["email"])){ echo $user[0]["users"]["email"]; }else{}?></td>
                    </tr>
                    <tr>
                      <td>Address</td>
                      <td>
                        <?php 
                          echo $user[0]["users"]["street_no"]." ";
                          echo $user[0]["users"]["city"].",";
                          echo $user[0]["states"]["name"].",";
                          echo $user[0]["countries"]["name"].",";
                          echo $user[0]["users"]["zipcode"];
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: none !important;">&nbsp;</td>
                      <td style="border-top: none !important;"><input type="button" class="btn btn-primary" id="cancle" value="Cancel"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
         </div>
      </div>
    </div>
  </div>




<script type="text/javascript">
$(document).ready(function(){

$("#cancle").click(function(){
  $(".view_event").html("");
});

});
</script>


