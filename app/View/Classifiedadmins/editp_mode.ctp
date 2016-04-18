<div id="page-wrapper" >
  <div id="page-inner">
      <div class="row">
          <div class="col-md-12">
           <h2>Payment Modes</h2>   
          </div>
      </div>
       <!-- /. ROW  -->
       <hr />
       
      <div class="row">
          <div class="col-md-12">
              <!-- Advanced Tables -->
              <div class="panel panel-default">
                  <div class="panel-heading">
                       Edit Payment Mode
                  </div>      
                  <div class="table-responsive clearfix">
                    <form method="post" action="<?php echo $this->webroot; ?>classifiedadmins/updatep_mode" enctype="multipart/form-data">
                        <table class="table table-bordered table-hover">
                          <tbody>
                            <tr>
                              <td>Title</td>
                              <td>
                                  <input type="text" value="<?php echo $p_data[0]["payment_modes"]["title"]; ?>" name="title" id="m_name" class="form-control" required>
                              </td>
                            </tr>
                            <tr>
                              <td>Description</td>
                              <td>
                                  <input type="text" value="<?php echo $p_data[0]["payment_modes"]["description"]; ?>" name="description" class="form-control" required>
                              </td>
                            </tr>
                            <tr>
                              <td>Price</td>
                              <td>
                                  <input type="text" value="<?php echo $p_data[0]["payment_modes"]["price"]; ?>" name="price" id="m_price" class="form-control" required>
                              </td>
                            </tr>
                            <tr>
                              <td>Days </td>
                              <td>
                                  <input type="text" value="<?php echo $p_data[0]["payment_modes"]["days"]; ?>" name="days" id="m_days" class="form-control" required>
                              </td>
                            </tr>
                            <tr>
                              <td>Main Image</td>
                              <td>
                                  <img src="<?php echo $this->webroot.$p_data[0]["files"]["base_url"]; ?>">
                                  <input type="file" name="image" class="form-control">
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2">
                                <input type="hidden" value="<?php echo $p_data[0]["payment_modes"]["id"]; ?>" name="m_id" id="m_id">
                                <input type="submit" value="Save" class="btn btn-primary"> 
                                <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-danger">
                              </td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                  </div>
            </div>
          </div>
      </div>
  </div>
</div>

<script>
    $(document).ready(function(){

      $('#edit_mode').click(function(){
            var m_price = btoa($('#m_price').val());
            var m_id = btoa($('#m_id').val());

            if(m_price == "")
            {
              alert("Please fill fields first");
              return false;
            }

            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/updatep_mode",
                    type:"post",
                    data:"m_price="+m_price+"&m_id="+m_id,
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
          window.location.href="<?php echo $this->webroot; ?>classifiedadmins/paymentmode";
      });

    });
</script>