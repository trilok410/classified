<?php  //$per = $this->Session->read('permission'); ?>
<div id="page-wrapper" >
	<div id="page-inner">
    
    <!-- Page Heading -->
     <div class="row">
	    <div class="col-lg-12">
	      <h3 class="page-header">Welcome Admin</h3>
	      <div class="bs-example" style="margin-bottom: 25px;">
  	      <ul class="nav nav-pills">
  	        <li><a>User<span  class="badge" style="background-color: #428bca;" ><?php echo $all_count["user"]; ?>  </span></a></li>
  	        <li><a>Ad's<span class="badge" style="background-color: #428bca;"><?php echo $all_count["ads"]; ?> </span></a></li>
  	        <li><a>Maincategories<span class="badge" style="background-color: #428bca;"> <?php echo $all_count["ad_main_cat"]; ?></span></a></li>
  	        <li><a>Categories<span class="badge" style="background-color: #428bca;"><?php echo $all_count["ad_cat"]; ?> </span> </a></li>
  	        <li><a>Subcategories<span class="badge" style="background-color: #428bca;"><?php echo $all_count["ad_sub_cat"]; ?></span> </a></li>
  	      </ul>
        </div>
	    </div>
	 </div>
    <div class="row">
    
    <div class="col-lg-12 col-md-12">
      <div class="col-lg-4 col-md-4">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="in_head">Last Added User</div>
            </div>
          </div>
          <div class="in_list">
              <ul>
                <?php foreach($topusers as $special): ?>
                   <li style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;color: #428bca;"><span><?php echo $special["User"]["name"]; ?></span></li>
                <?php endforeach; ?>
             </ul>
          </div>
          
          <div class="panel-footer">
            <a href="<?php echo $this->webroot; ?>classifiedadmins/user" id="special_event">
                <span class="pull-left">View All</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            </a> 
            <div class="clearfix"></div>
          </div>
          
        </div>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="panel panel-green">
          <div class="panel-heading">
            <div class="row">
              <div class="in_head">Latest Ad</div>
            </div>
          </div>
          <div class="in_list">
              <ul>
                <?php foreach($topad as $top): ?>
                   <li ><span><?php echo $top["Classified"]["title"];?></span></li>
                <?php endforeach; ?>
             </ul>
          </div>
          
          <div class="panel-footer">
            <a href="<?php echo $this->webroot; ?>classifiedadmins/useradds" id="top_club">
              <span class="pull-left">View All</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="in_head">Latest Issus</div>
            </div>
          </div>
          <div class="in_list">
              <ul>
                <?php foreach($topissue as $issues): ?>
                   <li ><span><?php echo $issues["Report"]["name"]; ?></span></li>
                <?php  endforeach; ?>
             </ul>
          </div>
          
          <div class="panel-footer">
            <a href="<?php echo $this->webroot; ?>classifiedadmins/report" id="latest_issues">
              <span class="pull-left">View All</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            </a>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div> 
  </div>
    <!-- /.row 
</div>
  <!-- /#page-wrapper -->
</div> 

<script type="text/javascript">
	// $(document).ready(function(){ 
	// 	$("#special_event").click(function(){
	// 		window.location.href = "/eventadmins/specialsevent";
	// 	});

	// 	$("#top_club").click(function(){
	// 		window.location.href = "/eventadmins/topclubs";       
	// 	});

	// 	$("#latest_issues").click(function(){
	// 		window.location.href = "/eventadmins/poblemsofuser";
	// 	});

	// });
</script


 