<?php $lang = $this->Session->read('lang');
      $data = $this->Session->read('data'); ?>

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

<div class="left_box_list">
   <div class="left_heading">
       <h2><?php echo $lang["Ad type"]; ?></h2>
       <div class="panel_list">
        <div class="panel_filter"> 
          <div class="checkbox">
              <label class="radio-inline"><input type="radio" class="typeofadd" name="typeofadd" value="1" <?php echo (isset($data["at"]) && !empty($data["at"]) && $data["at"] == 1)? "checked" : ""; ?>><?php echo $lang["Rent"]; ?></label>
              <label class="radio-inline"><input type="radio" class="typeofadd" name="typeofadd" value="2"  <?php echo (isset($data["at"]) && !empty($data["at"]) && $data["at"] == 2)? "checked" : ""; ?>><?php echo $lang["Sell"]; ?></label>
          </div>
        </div>
      </div>
   </div>
</div>

<div class="left_box_list">
    <div class="left_heading">
        <h2><?php echo $lang["Square Meters"]; ?></h2>
        <div class="panel_filter"> 
          <div class="col-sm-6">        
              <select id="sort_ms1" class="form-control">
                  <option value=""><?php echo $lang["From"]; ?></option>
                  <option value="300" <?php echo (isset($data["ms1"]) && !empty($data["ms1"]) && $data["ms1"] == 300)? "selected" : ""; ?>>300 <?php echo $lang["ms"]; ?></option>
                  <option value="600" <?php echo (isset($data["ms1"]) && !empty($data["ms1"]) && $data["ms1"] == 600)? "selected" : ""; ?>>600 <?php echo $lang["ms"]; ?></option>
                  <option value="1000" <?php echo (isset($data["ms1"]) && !empty($data["ms1"]) && $data["ms1"] == 1000)? "selected" : ""; ?>>1000 <?php echo $lang["ms"]; ?></option>
                  <option value="1500" <?php echo (isset($data["ms1"]) && !empty($data["ms1"]) && $data["ms1"] == 1500)? "selected" : ""; ?>>1500 <?php echo $lang["ms"]; ?></option>
                  <option value="2000" <?php echo (isset($data["ms1"]) && !empty($data["ms1"]) && $data["ms1"] == 2000)? "selected" : ""; ?>>2000 <?php echo $lang["ms"]; ?></option>
                  <option value="2500" <?php echo (isset($data["ms1"]) && !empty($data["ms1"]) && $data["ms1"] == 2500)? "selected" : ""; ?>>2500 <?php echo $lang["ms"]; ?></option>
                  <option value="5000" <?php echo (isset($data["ms1"]) && !empty($data["ms1"]) && $data["ms1"] == 5000)? "selected" : ""; ?>>5000 <?php echo $lang["ms"]; ?></option>
                  <option value="10000" <?php echo (isset($data["ms1"]) && !empty($data["ms1"]) && $data["ms1"] == 10000)? "selected" : ""; ?>>10000 <?php echo $lang["ms"]; ?></option>
              </select>
          </div>
          <div class="col-sm-6">
              <select id="sort_ms2" class="form-control">
                  <option value=""><?php echo $lang["To"]; ?></option>
                  <option value="300" <?php echo (isset($data["ms2"]) && !empty($data["ms2"]) && $data["ms2"] == 300)? "selected" : ""; ?>>300 <?php echo $lang["ms"]; ?></option>
                  <option value="600" <?php echo (isset($data["ms2"]) && !empty($data["ms2"]) && $data["ms2"] == 600)? "selected" : ""; ?>>600 <?php echo $lang["ms"]; ?></option>
                  <option value="1000" <?php echo (isset($data["ms2"]) && !empty($data["ms2"]) && $data["ms2"] == 1000)? "selected" : ""; ?>>1000 <?php echo $lang["ms"]; ?></option>
                  <option value="1500" <?php echo (isset($data["ms2"]) && !empty($data["ms2"]) && $data["ms2"] == 1500)? "selected" : ""; ?>>1500 <?php echo $lang["ms"]; ?></option>
                  <option value="2000" <?php echo (isset($data["ms2"]) && !empty($data["ms2"]) && $data["ms2"] == 2000)? "selected" : ""; ?>>2000 <?php echo $lang["ms"]; ?></option>
                  <option value="2500" <?php echo (isset($data["ms2"]) && !empty($data["ms2"]) && $data["ms2"] == 2500)? "selected" : ""; ?>>2500 <?php echo $lang["ms"]; ?></option>
                  <option value="5000" <?php echo (isset($data["ms2"]) && !empty($data["ms2"]) && $data["ms2"] == 5000)? "selected" : ""; ?>>5000 <?php echo $lang["ms"]; ?></option>
                  <option value="10000" <?php echo (isset($data["ms2"]) && !empty($data["ms2"]) && $data["ms2"] == 10000)? "selected" : ""; ?>>10000 <?php echo $lang["ms"]; ?></option>
              </select>
          </div>
          <div class="clearfix"></div>
        </div>
    </div>
</div>