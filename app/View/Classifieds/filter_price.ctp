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


<!-- <div class="left_box_list">
    <div class="left_heading">
        <h2><?php echo $lang["Price"]; ?></h2>
        <div class="panel_filter"> 
          <div class="col-sm-6">        
              <select id="select_price1" class="form-control">
                <option value=""><?php echo $lang["From"]; ?></option>
                <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 5000)? "selected" : ""; ?> >5000</option>
                <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 10000)? "selected" : ""; ?>>10000</option>
                <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 50000)? "selected" : ""; ?>>50000</option>
                <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 100000)? "selected" : ""; ?>>100000</option>
                <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 500000)? "selected" : ""; ?>>500000</option>
                <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 1000000)? "selected" : ""; ?>>1000000</option>
                <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 5000000)? "selected" : ""; ?>>5000000</option>
                <option <?php echo (isset($data["price1"]) && !empty($data["price1"]) && $data["price1"] == 10000000)? "selected" : ""; ?>>10000000</option>
              </select>
          </div>
          <div class="col-sm-6">
              <select id="select_price2" class="form-control">
                <option value=""><?php echo $lang["To"]; ?></option>
                <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 5000)? "selected" : ""; ?> >5000</option>
                <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 10000)? "selected" : ""; ?>>10000</option>
                <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 50000)? "selected" : ""; ?>>50000</option>
                <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 100000)? "selected" : ""; ?>>100000</option>
                <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 500000)? "selected" : ""; ?>>500000</option>
                <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 1000000)? "selected" : ""; ?>>1000000</option>
                <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 5000000)? "selected" : ""; ?>>5000000</option>
                <option <?php echo (isset($data["price2"]) && !empty($data["price2"]) && $data["price2"] == 10000000)? "selected" : ""; ?>>10000000</option>
              </select>
          </div>
          <div class="clearfix"></div>
        </div>
    </div>
</div> -->