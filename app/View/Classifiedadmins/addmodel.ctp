<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
             <h2>Add Model</h2>   
            </div>
        </div>
         <!-- /. ROW  -->
        <hr />
        <?php $flash = $this->Session->flash('model');
        	if(!empty($flash)){ ?>
        <div class="row">
        	<div class="col-md-12">
        		<div class="alert alert-success alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <?php echo $flash; ?>
				</div>
        	</div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-6" style="margin-top: 20px;" id="edit_contant">
              	<div class="table-responsive clearfix">
	                <form id="add_subcategory" method="post" action="<?php echo $this->webroot; ?>classifiedadmins/addmodel">
		                <table class="table table-bordered table-hover">
		                  <thead>
		                    <tr>
		                      <th>Add New Model</th>
		                      <th></th>
		                    </tr>
		                  </thead>
		                  <tbody>
			                    <tr>
			                        <td>Category Name</td>
			                        <td>
			                            <select class="form-control" name="c_id" id="c_cat">
			                                <option selected disabled value="0">Select Category</option>
			                              <?php foreach($category as $cat): ?>
			                                <option value="<?php echo $cat["classified_category"]["c_id"]; ?>"><?php echo $cat["classified_category"]["category"]; ?></option>
			                              <?php endforeach; ?>
			                            </select>
			                        </td>
			                    </tr>
			                    <tr>
			                        <td>Sub Category Name</td>
			                        <td>
			                            <select class="form-control" name="category_id" id="category">
			                                <option selected disabled value="0">Select Sub Category</option>
			                            </select>
			                        </td>
			                    </tr>
			                    <tr>
			                    	<td>Model Name <input type="button" value="Add" id="add_model" class="btn btn-primary"></td>
			                      	<td class="new_model">
			                          <input type="text" name="m_name[]" class="form-control" placeholder="Model Name">
			                      	</td>
			                    </tr>
			                    <tr>
			                      <td colspan="2">
			                      	<input type="submit" name="save_subcategory" id="save_subcategory" value="Save" class="btn btn-primary"> 
			                       <input type="reset" name="cancel" id="cancel" value="Cancel" class="btn btn-danger"></td>
			                    </tr>
		                  </tbody>
		                </table>
	                </form>
          		</div>
    		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		var count = 1;
		$("body").on("change","#c_cat", function(){
			var c_id = $(this). val();
			$.ajax({
					url:"<?php echo $this->webroot; ?>classifiedadmins/getsubcategories",
					type:"post",
					data:{c_id:c_id},
					dataType:"json",
					success: function(data)
					{
						if(data.subcat.length > 0)
						{
							var option = '<option selected disabled>Sub Category</option>';
		                    $.each(data.subcat, function(index, value) {
		                        option += '<option value="'+value.classified_subcategory.s_id+'">' + value.classified_subcategory.subcategory + '</option>';
		                    });
	                 	}
	                     
	                     $('#category').html(option);
					}
			});
		});

		$("body").on("click", "#add_model", function(){
			var j_list = "";
			j_list += '<input type="text" name="m_name[]" id="m_'+count+'" class="form-control" placeholder="Model Name">';
			j_list += '<input type="button" value="Remove" class="btn btn-danger remove_model" main="m_'+count+'">';
			$(".new_model").append(j_list);
			count++;
		});

		$("body").on("click", ".remove_model", function(){
			var id = $(this).attr("main");
			$("#"+id).remove();
			$(this).remove();
		});

	});
</script>