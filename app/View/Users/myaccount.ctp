<?php $lang = $this->Session->read('lang'); ?>
</section>
<!--conten sec start-->
<div class="conten">
    <div class="adds_main">
        <div class="container">
        <div class="row">
           <div class="col-md-12 col-sm-12">
              <div class="adds_main_head">
                 <h1><?php echo $lang["You can manage your Active & Inactive Ads"]; ?></h1>
                 <?php 
                 $msg = $this->Session->flash('good');
                 if(!empty($msg)){ ?>
                 <div class="alert alert-warning alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <strong><?php echo $msg; ?></strong>
				</div>
				<?php } ?>
              </div>
           </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
               <div class="tab_box">
                    <div>
                      <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
	                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo $lang["ads"]; ?></a></li>
	                        <li role="presentation"><a href="<?php echo $this->webroot; ?>users/message"><?php echo $lang["Message"]; ?></a></li>
	                        <li role="presentation"><a href="<?php echo $this->webroot; ?>users/setting"><?php echo $lang["Settings"]; ?></a></li>
	                        <li role="presentation"><a href="<?php echo $this->webroot; ?>users/paymenthistory"><?php echo $lang["Payment History"]; ?></a></li>
	                        <li role="presentation"><a href="<?php echo $this->webroot ?>users/favoritead"><?php echo $lang["Favorite Ads"] ?></a></li>
	                    	<li role="presentation"><a href="<?php echo $this->webroot ?>users/savesearch"><?php echo $lang["Favorite searches"]; ?></a></li>
	                    	<li role="presentation"><a href="<?php echo $this->webroot ?>users/billing"><?php echo $lang["billing address"]; ?></a></li>
	                    </ul>
                    
                       <!-- Tab panes -->
                        <div class="tab-content">
	                        <div role="tabpanel" class="tab-pane active" id="home">
	                           <div class="tab_head">
	                              <div class="tab_head_left">
	                                  <?php echo $lang["Active ADS"]; ?>
	                              </div>
	                           </div>
	                            <div class="table_main">
		                            <table class="table" id="ad_list">
		                                <thead>
		                                    <tr>
		                                    	<th><?php echo $lang["Date"]; ?></th>
		                                        <th><?php echo $lang["Title"]; ?></th>
		                                        <th><?php echo $lang["Price"]; ?></th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                	<?php foreach($myadd as $add){ ?>
		                                    <tr>
		                                        <td>
		                                        	<?php echo date("d M Y",strtotime($add["Classified"]["create_date"])); ?>
		                                        </td>													                                        
		                                        <td>
		                                          <div class="list_box">
		                                           <p><?php echo $add["Classified"]["title"]; ?></p>
		                                           <ul class="list_table">
		                                             <li>
		                                             	<?php if($add["Classified"]["status"] == 0){ ?>
		                                             	<img src="<?php echo $this->webroot; ?>images/comingsoon.jpg" class="coming_ad" alt="">
		                                             	<?php }else{ ?>
		                                             	<a href="<?php echo $this->webroot; ?>ad/<?php echo $add['Classified']['id']; ?>/<?php echo $this->Link->changetitle($add["Classified"]["title"]); ?>"><i class="fa fa-qrcode"></i><?php echo $lang["Preview"]; ?>  </a>
		                                             	<?php } ?>
		                                             </li>
		                                             <li><a href="<?php echo $this->webroot; ?>classifieds/editadd?id=<?php echo base64_encode($add["Classified"]["id"]); ?>"><i class="fa fa-pencil"></i><?php echo $lang["Edit"]; ?> </a></li>
		                                             <li>
		                                             	<?php if($add["Classified"]["status"] == 2){ ?>
		                                             		<a href="javascript:void(0)" class="deactivate_ad" main="<?php echo $add["Classified"]["id"]; ?>"><i class="fa fa-times"></i><?php echo $lang["Deactivate ad"]; ?></a>
		                                             	<?php }elseif($add["Classified"]["status"] == 1){ ?>
		                                           		  	<a href="javascript:void(0)" class="activate_ad" main="<?php echo $add["Classified"]["id"]; ?>"><i class="fa fa-times"></i><?php echo $lang["Active ad"]; ?> </a>
		                                             	<?php }elseif($add["Classified"]["status"] == 0){ ?>
		                                             		<a href="javascript:void(0)" class="" main="<?php echo $add["Classified"]["id"]; ?>"><i class="fa fa-times"></i><?php echo $lang["Deactivate ad"]; ?></a>
		                                             	<?php } ?>
		                                             </li>
		                                           </ul>
		                                          </div>
		                                        </td>
		                                        <td>£ <?php echo $add["Classified"]["price"]; ?></td>
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
	});
</script>