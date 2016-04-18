<?php $lang = $this->Session->read('lang'); 
      $data = $this->Session->read('data'); ?>

<div class="left_box_list">
    <div class="left_heading">
        <h2><?php echo $lang["Type of ad"]; ?></h2>
        <div class="col-sm-12"> 
            <div class="panel_filter"> 
                <div class="select_icon"><i class="fa fa-caret-down"></i></div>            
                <select class="form-control" name="post_type" id="job_type" >
    		    	<option value=""><?php echo $lang["Choose"]; ?></option>
    		    	<option value="1" <?php echo (isset($data["jt"]) && !empty($data["jt"]) && $data["jt"] == 1)? "selected" : ""; ?>><?php echo $lang["Offering job"]; ?></option>
    		    	<option value="2" <?php echo (isset($data["jt"]) && !empty($data["jt"]) && $data["jt"] == 2)? "selected" : ""; ?>><?php echo $lang["Seeking job"]; ?></option>
    		    </select>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="load_offer_Page">
</div>