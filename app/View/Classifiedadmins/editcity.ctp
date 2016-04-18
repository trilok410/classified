<div class="table-responsive clearfix">
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Edit City</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Country Name </td>
        <td>
            <select class="form-control" id="cont_name">
                <option selected value="">Select Country</option>
                <?php foreach($country_data as $data): ?>
                <option value="<?php echo $data["countries"]["id"]; ?>" selected><?php echo $data["countries"]["name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </td>
      </tr>
      <tr>
          <td>State Name</td>
          <td>
              <select class="form-control" id="state_name">
                  <option value="<?php echo $city_data[0]["city"]["s_id"]; ?>"><?php echo $city_data[0]["states"]["name"]; ?></option>
              </select>
          </td>
      </tr>
      <tr>
        <td>City Name </td>
        <td><input type="text" value="<?php echo $city_data[0]["city"]["name"]; ?>" id="city_name" class="form-control">
            <input type="hidden" value="<?php echo $city_data[0]["city"]["id"]; ?>" id="city_id">
        </td>
      </tr>
      <tr>
        <td colspan="2">
         <input type="button" name="update_city" id="update_city" value="Update" class="btn btn-primary"> 
         <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-danger">
        </td>
      </tr>
    </tbody>
  </table>
</div>

<script>
    $(document).ready(function(){

      $('#update_city').click(function(){
            var name = $('#city_name').val();
            var cid = $('#city_id').val();
            var s_id = $('#state_name').val();
            var c_id = $("#cont_name option:selected").val();

            if(name == "" || s_id == "" || c_id == "")
            {
              alert("Please fill all fields first");
              return false;
            }
            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/editcity",
                    type:"post",
                    data:"name="+name+"&s_id="+s_id+"&cid="+cid,
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

      $('#cancel').click(function(){
          window.location.reload();
      });

    });
</script>