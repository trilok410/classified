<?php $lang = $this->Session->read('lang');
  $data = $this->Session->read('data'); ?>
<div class="left_box_list">
   <div class="left_heading">
       <h2><?php echo $lang["Ad type"]; ?></h2>
       <div class="panel_list">
          <div class="panel_filter"> 
            <div class="checkbox">
                <label class="radio-inline"><input type="radio" name="post_type" value="1" class="post_type" <?php echo (isset($data["adt"]) && !empty($data["adt"]) && $data["adt"] == 1)? "checked" : ""; ?> ><?php echo $lang["I want to Sell"]; ?></label>
                <label class="radio-inline"><input type="radio" name="post_type" value="2" class="post_type" <?php echo (isset($data["adt"]) && !empty($data["adt"]) && $data["adt"] == 2)? "checked" : ""; ?>><?php echo $lang["I want to Buy"]; ?></label>
            </div>
          </div>
       </div>
   </div>
</div>

<div class="left_box_list">
   <div class="left_heading">
       <h2><?php echo $lang["Condition"]; ?></h2>
       <div class="panel_list">
        <div class="panel_filter"> 
          <div class="checkbox">
              <label class="radio-inline">
                  <input type="radio" name="condition_type" id="inlineRadio1" class="condition_type" value="1" <?php echo (isset($data["cond_type"]) && !empty($data["cond_type"]) && $data["cond_type"] == 1)? "checked" : ""; ?>> <?php echo $lang["New"]; ?>
              </label>
              <label class="radio-inline">
                <input type="radio" name="condition_type" id="inlineRadio2" class="condition_type" value="2" <?php echo (isset($data["cond_type"]) && !empty($data["cond_type"]) && $data["cond_type"] == 2)? "checked" : ""; ?>> <?php echo $lang["Used"]; ?>
              </label>
          </div>
        </div>
      </div>
   </div>
</div>