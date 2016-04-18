<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
             <h2>City Management</h2>   
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                         City Table
                    </div>
                    <div class="panel-body">
                        <div class="ad_new_user">
                            <a href="javascript:void(0)" class="btn btn-primary add_city">Add City</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>City Name</th>
                                        <th>State Name</th>
                                        <th>Country Name</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1;  foreach($city_data as $city): ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $city["city"]["name"]; ?></td>
                                        <td><?php echo $city["states"]["name"]; ?></td>
                                        <td><?php echo $city["countries"]["name"]; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($city["city"]["create_date"])); ?></td>
                                        <td>
                                             <?php if($city["city"]["status"] == '1') {?>
                                             <span> Blocked</span>
                                             <?php }else{?>
                                             <span> Unblock</span>
                                              <?php }?>
                                        </td>
                                        <td class="center">
                                          <span class="edit_state point" main="<?php echo $city["city"]["id"]; ?>"><i class="glyphicon glyphicon-pencil"></i></span> |
                                          <?php if($city["city"]["status"] == '1') {?>
                                           <span class="unblock_state point" main="<?php echo $city["city"]["id"];?>"><i class="glyphicon glyphicon-ok-circle"></i></span>  
                                           <?php }else{?>
                                           <span class="block_state point" main="<?php echo $city["city"]["id"];?>"><i class="glyphicon glyphicon-remove-circle"></i></span>  
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php $count++; endforeach; ?>   
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
        <div class="row">
         <div class="col-md-6" style="margin-top: 20px;" id="edit_contant">
          <div class="table-responsive clearfix">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th colspan="2">Add New City</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Country Name </td>
                  <td>
                      <select class="form-control" id="cont_name">
                            <option selected value="">Select Country</option>
                          <?php foreach($country_data as $data): ?>
                            <option value="<?php echo $data["countries"]["id"]; ?>"><?php echo $data["countries"]["name"]; ?></option>
                          <?php endforeach; ?>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td>State Name</td>
                  <td>
                      <select class="form-control" id="state_name">
                          <option value="">Select State</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td>City Name </td>
                  <td><input type="text" id="city_name" class="form-control" placeholder="City Name"></td>
                </tr>
                <tr>
                  <td colspan="2"><input type="button" name="save_state" id="save_state" value="Save" class="btn btn-primary"> 
                   <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-danger"></td>
                </tr>
              </tbody>
            </table>
          </div>
         </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>

<script>
    $(document).ready(function(){
          
        $("body").on("click",".add_city", function(){
            $('html, body').animate({ scrollTop: $("#edit_contant").offset().top }, 1000);
        });

        $(".table").on('click','.block_state',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'city';
            var col = "id";
            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/blockdata",
                    type:"post",
                    data:"c_id="+c_id+"&tab="+tab+"&col="+col,
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

        $(".table").on('click','.unblock_state',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'city';
            var col = "id";
            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/unblockdata",
                    type:"post",
                    data:"c_id="+c_id+"&tab="+tab+"&col="+col,
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

        $(".table").on('click','#save_state',function(){
            var name = $('#city_name').val();
            var s_id = $('#state_name').val();
            var c_id = $("#cont_name").val();
            
            if(name == "" || s_id == "" || c_id == "")
            {
              alert("Please fill all fields first");
              return false;
            }
            
            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/addcity",
                    type:"post",
                    data:"name="+name+"&s_id="+s_id,
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

        $(".table").on('click','.edit_state',function(){
            var cid = btoa($(this).attr("main"));
            $('#edit_contant').load('<?php echo $this->webroot; ?>classifiedadmins/editcity?cid='+cid, function(){
              $('html, body').animate({ scrollTop: $("#edit_contant").offset().top }, 1000);
            });
        });

        $('#cancel').click(function(){
            window.location.reload();
        });

        /** Get State by country **/
      $("body").on("change", "#cont_name", function(){
          var c_id =  $(this).val();
          if(c_id != "")
          {
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
                             $("#state_name").html(j_list);
                          }else{
                             $("#state_name").html(j_list);
                          }
                      }
              });
          }else
          {
            var j_list = "";
            j_list = '<option value="">States</option>';
            $("#state_name").html(j_list);
          }
      });


    });
</script>
