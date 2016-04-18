<?php $lang = $this->Session->read('lang');
      $data = $this->Session->read('data'); ?>

<div class="left_box_list">
   <div class="left_heading">
       <h2><?php echo $lang["Salary period"]; ?></h2>
       <div class="panel_list">
        <div class="panel_filter">
          <div class="checkbox">
               <label class="lowercase">
                  <input type="checkbox" class="salary_period" value="hourly" <?php echo (isset($data["sp"]) && !empty($data["sp"]) && in_array("hourly", $data["sp"]))? "checked" : ""; ?> > <?php echo $lang["Hourly"]; ?>
               </label>
          </div>
          <div class="checkbox">
               <label class="lowercase">
                  <input type="checkbox" class="salary_period" value="weekly" <?php echo (isset($data["sp"]) && !empty($data["sp"]) && in_array("weekly", $data["sp"]))? "checked" : ""; ?>> <?php echo $lang["Weekly"]; ?>
               </label>
          </div>
          <div class="checkbox">
               <label class="lowercase">
                  <input type="checkbox" class="salary_period" value="monthly" <?php echo (isset($data["sp"]) && !empty($data["sp"]) && in_array("monthly", $data["sp"]))? "checked" : ""; ?>> <?php echo $lang["Monthly"]; ?>
               </label>
          </div>
          <div class="checkbox">
               <label class="lowercase">
                  <input type="checkbox" class="salary_period" value="yearly" <?php echo (isset($data["sp"]) && !empty($data["sp"]) && in_array("yearly", $data["sp"]))? "checked" : ""; ?>> <?php echo $lang["Yearly"]; ?>
               </label>
          </div>
        </div>  
      </div>
   </div>
</div>

<div class="left_box_list">
    <div class="left_heading">
        <h2><?php echo $lang["Salary range"]; ?></h2>
        <div class="panel_filter">
          <div class="col-sm-6">        
              <select id="salary_range1"  class="form-control">
                <option value=""><?php echo $lang["From"]; ?></option>
                <option value="500" <?php echo (isset($data["sr1"]) && !empty($data["sr1"]) && $data["sr1"] == 500)? "selected" : ""; ?>>£ 500</option>
                <option value="1000" <?php echo (isset($data["sr1"]) && !empty($data["sr1"]) && $data["sr1"] == 1000)? "selected" : ""; ?>>£ 1,000</option>
                <option value="2000" <?php echo (isset($data["sr1"]) && !empty($data["sr1"]) && $data["sr1"] == 2000)? "selected" : ""; ?>>£ 2,000</option>
                <option value="5000" <?php echo (isset($data["sr1"]) && !empty($data["sr1"]) && $data["sr1"] == 5000)? "selected" : ""; ?>>£ 5,000</option>
                <option value="10000" <?php echo (isset($data["sr1"]) && !empty($data["sr1"]) && $data["sr1"] == 10000)? "selected" : ""; ?>>£ 10,000</option>
                <option value="20000" <?php echo (isset($data["sr1"]) && !empty($data["sr1"]) && $data["sr1"] == 20000)? "selected" : ""; ?>>£ 20,000</option>
                <option value="50000" <?php echo (isset($data["sr1"]) && !empty($data["sr1"]) && $data["sr1"] == 50000)? "selected" : ""; ?>>£ 50,000</option>
                <option value="100000" <?php echo (isset($data["sr1"]) && !empty($data["sr1"]) && $data["sr1"] == 100000)? "selected" : ""; ?>>£ 1,00,000</option>
              </select>
          </div>
          <div class="col-sm-6">
              <select id="salary_range2"  class="form-control">
                <option value=""><?php echo $lang["To"]; ?></option>
                <option value="500" <?php echo (isset($data["sr2"]) && !empty($data["sr2"]) && $data["sr2"] == 500)? "selected" : ""; ?>>£ 500</option>
                <option value="1000" <?php echo (isset($data["sr2"]) && !empty($data["sr2"]) && $data["sr2"] == 1000)? "selected" : ""; ?>>£ 1,000</option>
                <option value="2000" <?php echo (isset($data["sr2"]) && !empty($data["sr2"]) && $data["sr2"] == 2000)? "selected" : ""; ?>>£ 2,000</option>
                <option value="5000" <?php echo (isset($data["sr2"]) && !empty($data["sr2"]) && $data["sr2"] == 5000)? "selected" : ""; ?>>£ 5,000</option>
                <option value="10000" <?php echo (isset($data["sr2"]) && !empty($data["sr2"]) && $data["sr2"] == 10000)? "selected" : ""; ?>>£ 10,000</option>
                <option value="20000" <?php echo (isset($data["sr2"]) && !empty($data["sr2"]) && $data["sr2"] == 20000)? "selected" : ""; ?>>£ 20,000</option>
                <option value="50000" <?php echo (isset($data["sr2"]) && !empty($data["sr2"]) && $data["sr2"] == 50000)? "selected" : ""; ?>>£ 50,000</option>
                <option value="100000" <?php echo (isset($data["sr2"]) && !empty($data["sr2"]) && $data["sr2"] == 100000)? "selected" : ""; ?>>£ 1,00,000</option>
              </select>
          </div>
          <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="left_box_list">
    <div class="left_heading">
        <h2><?php echo $lang["Position type"]; ?></h2>
        <div class="col-sm-12"> 
          <div class="panel_filter">
            <div class="select_icon"><i class="fa fa-caret-down"></i></div>       
            <select class="form-control" name="position_type" id="position_type">
    		    	<option value=""><?php echo $lang["Choose"]; ?></option>
    		    	<option value="fulltime" <?php echo (isset($data["pt"]) && !empty($data["pt"]) && $data["pt"] == "fulltime")? "selected" : ""; ?>><?php echo $lang["Full-time"]; ?></option>
    		    	<option value="parttime" <?php echo (isset($data["pt"]) && !empty($data["pt"]) && $data["pt"] == "parttime")? "selected" : ""; ?>><?php echo $lang["Part-time"]; ?></option>
    		    	<option value="contract" <?php echo (isset($data["pt"]) && !empty($data["pt"]) && $data["pt"] == "contract")? "selected" : ""; ?>><?php echo $lang["Contract"]; ?></option>
    		    	<option value="temporary" <?php echo (isset($data["pt"]) && !empty($data["pt"]) && $data["pt"] == "temporary")? "selected" : ""; ?>><?php echo $lang["Temporary"]; ?></option>
    		    </select>
          </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

