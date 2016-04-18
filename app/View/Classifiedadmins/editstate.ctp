<div class="table-responsive clearfix">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Edit State</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>State Name </td>
              <td><input type="text" value="<?php echo $state_data[0]["states"]["name"]; ?>" id="state_name" class="form-control">
              <input type="hidden" value="<?php echo $state_data[0]["states"]["id"]; ?>" id="state_id">
              </td>
            </tr>
            <tr>
              <td>Country Name </td>
              <td>
                  <select class="form-control" id="cont_name">
                        <option selected disabled>Select Country</option>
                      <?php foreach($country_data as $data): ?>
                        <?php if($state_data[0]["states"]["c_id"] == $data["countries"]["id"] ) { ?>
                        <option value="<?php echo $data["countries"]["id"]; ?>" selected><?php echo $data["countries"]["name"]; ?></option>
                        <?php }else{ ?>
                        <option value="<?php echo $data["countries"]["id"]; ?>"><?php echo $data["countries"]["name"]; ?></option>
                        <?php } ?>
                      <?php endforeach; ?>
                  </select>
              </td>
            </tr>
            <tr>
              <td colspan="2"><input type="button" name="save_state" id="save_state" value="Save" class="btn btn-primary"> 
               <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-danger"></td>
            </tr>
          </tbody>
        </table>
      </div>

<script>
    $(document).ready(function(){

      $('#save_state').click(function(){
            var name = btoa($('#state_name').val());
            var s_id = btoa($('#state_id').val());
            var c_id = btoa($("#cont_name option:selected").val());

            if(name == "")
            {
              alert("Please fill all fields first");
              return false;
            }
            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/editstate",
                    type:"post",
                    data:"name="+name+"&s_id="+s_id+"&c_id="+c_id,
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