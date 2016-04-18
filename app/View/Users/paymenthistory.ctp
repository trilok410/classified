<?php $lang = $this->Session->read('lang'); ?>
</section>
<!--conten sec start-->
<div class="conten">
    <div class="adds_main">
        <div class="container">
        <div class="row">
           <div class="col-md-12 col-sm-12">
              <div class="adds_main_head">
                 <h1><?php echo $lang["Payment History"]; ?></h1>
              </div>
           </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
               <div class="tab_box">
                    <div>
                      <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                        	<li role="presentation"><a href="<?php echo $this->webroot; ?>users/myaccount"><?php echo $lang["ads"]; ?></a></li>
	                        <li role="presentation"><a href="<?php echo $this->webroot; ?>users/message"><?php echo $lang["Message"]; ?></a></li>
	                        <li role="presentation"><a href="<?php echo $this->webroot; ?>users/setting"><?php echo $lang["Settings"]; ?></a></li>
	                        <li role="presentation" class="active"><a href="javascript:void(0)"><?php echo $lang["Payment History"]; ?></a></li>
	                    	<li role="presentation"><a href="<?php echo $this->webroot ?>users/favoritead"><?php echo $lang["Favorite Ads"] ?></a></li>
	                    	<li role="presentation"><a href="<?php echo $this->webroot ?>users/savesearch"><?php echo $lang["Favorite searches"]; ?></a></li>
	                    	<li role="presentation"><a href="<?php echo $this->webroot ?>users/billing"><?php echo $lang["billing address"]; ?></a></li>
	                    </ul>
                    
                       <!-- Tab panes -->
                        <div class="tab-content">
	                        <div role="tabpanel" class="tab-pane active" id="home">
	                            <div class="table_main">
		                            <table class="table" id="ad_list">
		                                <thead>
		                                    <tr>
		                                    	<th><?php echo $lang["Title"]; ?></th>
		                                    	<th><?php echo $lang["Txn ID"]; ?></th>
		                                        <th><?php echo $lang["Price"]; ?></th>
		                                        <th><?php echo $lang["Type"]; ?></th>
		                                        <th><?php echo $lang["Status"]; ?></th>
		                                        <th><?php echo $lang["Date"]; ?></th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                	<?php foreach($p_history as $ph){ ?>
		                                    <tr>
		                                        <td><?php echo $ph["classifieds"]["title"]; ?></td>
		                                        <td><?php echo $ph["payment_detail"]["txn_id"]; ?></td>
		                                        <td>£ <?php echo $ph["payment_detail"]["amount"]; ?></td>
		                                        <td><?php echo $ph["payment_detail"]["payment_type"]; ?></td>
		                                        <td><?php echo $ph["payment_detail"]["mode"]; ?></td>
		                                        <td><?php echo date("d-m-Y", strtotime($ph["payment_detail"]["created_date"])); ?></td>
		                                    </tr>
		                                    <?php } ?>
		                                </tbody>
		                            </table>
	                            </div>
	                        </div>
                        </div>
                    </div>
               </div>
            </div>
         </div>
        </div>
    </div>
</div>
<!--conten sec end-->
<script type="text/javascript">
	$(document).ready(function(){
		$("#ad_list").DataTable();

		/** Deactivate Ad  **/
		$("body").on("click", ".deactivate_ad", function(){
			var id = $(this).attr("main");
			var tab = "classifieds";
			var col = "id";
			var cur = $(this).parent("li");
			$.ajax({
					url:"<?php echo $this->webroot; ?>users/blockad",
					type:"post",
					data:{id:id,tab:tab,col:col},
					dataType:"json",
					success: function(data)
					{
						if(data.message == "success")
						{
							var list = '<a href="javascript:void(0)" class="activate_ad" main="'+id+'"><i class="fa fa-times"></i>Active ad </a>';
							cur.html(list);
						}
					}
			});
		});

		/** Activate Ad  **/
		$("body").on("click", ".activate_ad", function(){
			var id = $(this).attr("main");
			var tab = "classifieds";
			var col = "id";
			var cur = $(this).parent("li");
			$.ajax({
					url:"<?php echo $this->webroot; ?>users/unblockad",
					type:"post",
					data:{id:id,tab:tab,col:col},
					dataType:"json",
					success: function(data)
					{
						if(data.message == "success")
						{
							var list = '<a href="javascript:void(0)" class="deactivate_ad" main="'+id+'"><i class="fa fa-times"></i>Deactive ad </a>';
							cur.html(list);
						}
					}
			});
		});

		$()
	});
</script>