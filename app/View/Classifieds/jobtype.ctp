<?php $lang = $this->Session->read('lang'); ?>
<div class="form-group">
	<label class="control-label col-sm-3" for="add_type"><?php echo $lang["Type of ad"]; ?>*</label>
    <div class="col-sm-6">
    <select class="form-control" name="job_type" id="add_type" required>
    	<option selected disabled><?php echo $lang["Choose"]; ?></option>
    	<option value="1"><?php echo $lang["Offering job"]; ?></option>
    	<option value="2"><?php echo $lang["Seeking job"]; ?></option>
    </select>
    </div>
</div>

<div id="show_off_data" style="display:none">
	<div class="form-group">
		<label class="control-label col-sm-3" for="salary_period"><?php echo $lang["Salary period"]; ?>*</label>
	    <div class="col-sm-6">
	    <select class="form-control" name="salary_period" id="salary_period">
	    	<option value=""><?php echo $lang["Choose"]; ?></option>
	    	<option value="hourly"><?php echo $lang["Hourly"]; ?></option>
	    	<option value="weekly"><?php echo $lang["Weekly"]; ?></option>
	    	<option value="monthly"><?php echo $lang["Monthly"]; ?></option>
	    	<option value="yearly"><?php echo $lang["Yearly"]; ?></option>
	    </select>
	    </div>
	</div>
	<div class="form-group">
	    <label for="salary_range" class="control-label col-sm-3">
	        <?php echo $lang["Salary range"]; ?>*
	    </label>
	    <div class="col-sm-3">
	        <input type="text" class="form-control" name="salary_from" id="salary_range" placeholder="<?php echo $lang["From"]; ?>">
	    </div>
	    <div class="col-sm-3">
	        <input type="text" class="form-control" name="salary_to" id="salary_range1" placeholder="<?php echo $lang["To"]; ?>">
	    </div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3" for="position_type"><?php echo $lang["Position type"]; ?>*</label>
	    <div class="col-sm-6">
	    <select class="form-control" name="position_type" id="position_type">
	    	<option value=""><?php echo $lang["Choose"]; ?></option>
	    	<option value="fulltime"><?php echo $lang["Full-time"]; ?></option>
	    	<option value="parttime"><?php echo $lang["Part-time"]; ?></option>
	    	<option value="contract"><?php echo $lang["Contract"]; ?></option>
	    	<option value="temporary"><?php echo $lang["Temporary"]; ?></option>
	    </select>
	    </div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $("body").on("change", "#add_type", function(){
        if($("option:selected",this).val() == 1)
        {
            $("#show_off_data").show();
            $("#show_off_data select, #show_off_data input").attr("required", true);

        }else{
            $("#show_off_data").hide();
            $("#show_off_data select, #show_off_data input").attr("required", false);
        }
    });
});
</script>