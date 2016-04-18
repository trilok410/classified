<div class="table-responsive clearfix">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Edit Country</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Country Name </td>
              <td><input type="text" value="<?php echo $cont_data[0]["countries"]["name"]; ?>" id="cont_name" class="form-control">
              <input type="hidden" value="<?php echo $cont_data[0]["countries"]["id"]; ?>" id="count_id">
              </td>
            </tr>
            <tr>
              <td colspan="2"><input type="button" name="save_cont" id="edit_cont" value="Save" class="btn btn-primary"> 
               <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-danger"></td>
            </tr>
          </tbody>
        </table>
      </div>

<script>
    $(document).ready(function(){

      $('#edit_cont').click(function(){
            var name = btoa($('#cont_name').val());
            var id = btoa($('#count_id').val());

            if(name == "")
            {
              alert("Please fill fields first");
              return false;
            }

            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/editcountry",
                    type:"post",
                    data:"name="+name+"&id="+id,
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