<div class="table-responsive clearfix">
	<form id="send_mail">
		<table class="table table-bordered table-hover">
            <thead>
	            <tr>
	              <th colspan="2">Send Mail</th>
	            </tr>
            </thead>
	        <tbody>
	            <tr>
	              <td>To</td>
	              <td>
		              <input type="text" id="name" name="to_name" value="<?php echo $report["Report"]["name"]; ?>" class="form-control" placeholder="Name">
		              <input type="text" id="email" name="to_email" value="<?php echo $report["Report"]["email"]; ?>" class="form-control" placeholder="Email" required>
	              </td>
	            </tr>
	            <tr>
	              <td>Subject</td>
	              <td>
		              <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject">
		          </td>
	            </tr>
	            <tr>
	              <td>Message</td>
	              <td>
		              <textarea id="message" name="message" class="form-control" placeholder="Message"></textarea>
		          </td>
	            </tr>
	            <tr>
	              <td colspan="2"><input type="button" name="save_mail" id="save_mail" value="Send" class="btn btn-primary"> 
	               <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-danger"></td>
	            </tr>
	        </tbody>
	    </table>
	</form>
</div>

<script type="text/javascript">
 $(document).ready(function(){

 	$('#save_mail').click(function(){
 		var data = $('#send_mail').serialize();
 		$.ajax({
 				url:"<?php echo $this->webroot?>classifiedadmins/contactevents",
 				type:"post",
 				data:data,
 				dataType:"json",
 				beforeSend: function() {
			    	$('.loading').show();
			    	$('.loading_icon').show();
			 	 },
 				success: function(data)
 				{
 					if(data.message == 'success')
 					{
 						window.location.reload();
 					}
 				}
 		});
 	});

 	$('#cancel').click(function(){
       $('#edit_contant').html("");
    });

 });

</script>