<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
             	<h2>Browse</h2>
             	<hr />  
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            	<div class="all_category">
            		<ul class="main_cat_list">
	            		<?php foreach($mainarray as $main){ ?>
	            		<li>
	            			<a href="javascript:void(0)" class="main_category" main="<?php echo $main["mcat"]["classified_maincategories"]["m_id"]; ?>"><?php echo $main["mcat"]["classified_maincategories"]["maincategory"]; ?>(<?php echo $main["mcat"][0]["mcount"]; ?>)</a>
	            			<ul class="cat_list">
	            				<?php foreach($main["cat"] as $cat){ ?>
	            				<li>
	            					<a href="javascript:void(0)" class="category" m_id="<?php echo $main["mcat"]["classified_maincategories"]["m_id"]; ?>" main="<?php echo $cat["classified_category"]["c_id"]; ?>"><?php echo $cat["classified_category"]["category"]; ?>,</a>
	            				</li>
	            				<?php } ?>
	            			</ul>
	            		</li>
	            		<?php } ?>
            		</ul>
            	</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            	<div id="browse_cat">
            		
            	</div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("body").on("click", ".main_category", function(){
			var mid = $(this).attr("main");
			$("#browse_cat").load("<?php echo $this->webroot; ?>classifiedadmins/adbymaincategory?mid="+mid);
		});

		$("body").on("click", ".category", function(){
			var mid = $(this).attr("m_id");
			var cid = $(this).attr("main");
			$("#browse_cat").load("<?php echo $this->webroot; ?>classifiedadmins/adbycategory?mid="+mid+"&cid="+cid);
		});

		$("body").on('click','.block_event',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'classifieds';
            var col = 'id';
            var cur = $(this);
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
                        $('.loading').hide();
                        $('.loading_icon').hide();
                        if(data.message == 'success')
                        {	
                            cur.html('<i class="glyphicon glyphicon-ok-circle"></i>')
                        }
                    }
            });
        });

        $("body").on('click','.unblock_event',function(){
            var c_id = btoa($(this).attr('main'));
            var tab = 'classifieds';
            var col = 'id';
            var cur = $(this);
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
                            cyr.html('<i class="glyphicon glyphicon-remove-circle"></i>');
                        }
                    }
            });
        });

        $("body").on('click','.event_detail',function(){
              var a_id = btoa($(this).attr("main"));
              window.open("<?php echo $this->webroot; ?>classifiedadmins/viewadddetail?a_id="+a_id, "_blank");              //$('.view_event').load("/classifiedadmins/viewadddetail?a_id="+a_id);
        });

        $("body").on("click",".delete_ad", function(){
            var id = $(this).attr("main");
            var cur = $(this);
            $.ajax({
                    url:"<?php echo $this->webroot; ?>classifiedadmins/deletead",
                    type:"post",
                    data:{id:id},
                    dataType:"json",
                    success: function(data)
                    {
                        cur.parents("tr").remove();
                    }    
            });
        });
	});
</script>