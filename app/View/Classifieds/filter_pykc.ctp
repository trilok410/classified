<?php $lang = $this->Session->read('lang'); 
$data = $this->Session->read('data'); ?>

<div class="left_box_list">
    <div class="left_heading">
        <h2><?php echo $lang["Model"]; ?></h2>
        <div class="col-sm-12">  
          <div class="panel_filter"> 
           <div class="select_icon"><i class="fa fa-caret-down"></i></div>     
            <select class="form-control model" name="model" id="model">
                <option value=""><?php echo $lang["Select"]." ".$lang["Model"]; ?></option>
                <?php foreach($model as $mod){ ?>
                <option value="<?php echo $mod["Models"]["model"]; ?>" <?php echo (isset($data["model"]) && !empty($data["model"]) && $data["model"] == $mod["Models"]["model"])? "selected" : ""; ?>><?php echo $mod["Models"]["model"]; ?></option>
                <?php } ?>
            </select>
          </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

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


<div class="left_box_list">
    <div class="left_heading">
        <h2><?php echo $lang["Year"]; ?></h2>
        <div class="panel_filter"> 
          <div class="col-sm-6">        
              <select id="select_year1" class="form-control">
                  <option value=""><?php echo $lang["From"]; ?></option>
                  <?php
                  $date = date("Y");
                  for($i = 1998; $i <= $date; $i++){ ?>
                      <option <?php echo (isset($data["year1"]) && !empty($data["year1"]) && $data["year1"] == $i)? "selected" : ""; ?> ><?php echo $i; ?></option>
                  <?php } ?>
              </select>
          </div>
          <div class="col-sm-6">
             <select id="select_year2" class="form-control">
                  <option value=""><?php echo $lang["To"]; ?></option>
                  <?php
                  $date = date("Y");
                  for($i = 1998; $i <= $date; $i++){ ?>
                      <option <?php echo (isset($data["year2"]) && !empty($data["year2"]) && $data["year2"] == $i)? "selected" : ""; ?>><?php echo $i; ?></option>
                  <?php } ?>
              </select>
          </div>
          <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="left_box_list">
    <div class="left_heading">
        <h2><?php echo $lang["KM's driven"]; ?></h2>
        <div class="panel_filter"> 
          <div class="col-sm-6">        
              <select id="select_km1" class="form-control">
                  <option value=""><?php echo $lang["From"]; ?></option>
                  <option <?php echo (isset($data["km1"]) && !empty($data["km1"]) && $data["km1"] == 1000)? "selected" : ""; ?>>1000</option>
                  <option  <?php echo (isset($data["km1"]) && !empty($data["km1"]) && $data["km1"] == 5000)? "selected" : ""; ?>>5000</option>
                  <option <?php echo (isset($data["km1"]) && !empty($data["km1"]) && $data["km1"] == 10000)? "selected" : ""; ?>>10000</option>
                  <option <?php echo (isset($data["km1"]) && !empty($data["km1"]) && $data["km1"] == 50000)? "selected" : ""; ?>>50000</option>
                  <option <?php echo (isset($data["km1"]) && !empty($data["km1"]) && $data["km1"] == 100000)? "selected" : ""; ?>>100000</option>
                  <option <?php echo (isset($data["km1"]) && !empty($data["km1"]) && $data["km1"] == 150000)? "selected" : ""; ?>>150000</option>
                  <option <?php echo (isset($data["km1"]) && !empty($data["km1"]) && $data["km1"] == 200000)? "selected" : ""; ?>>200000</option>
              </select>
          </div>
          <div class="col-sm-6">
              <select id="select_km2" class="form-control">
                  <option value=""><?php echo $lang["To"]; ?></option>
                  <option <?php echo (isset($data["km2"]) && !empty($data["km2"]) && $data["km2"] == 1000)? "selected" : ""; ?>>1000</option>
                  <option  <?php echo (isset($data["km2"]) && !empty($data["km2"]) && $data["km2"] == 5000)? "selected" : ""; ?>>5000</option>
                  <option <?php echo (isset($data["km2"]) && !empty($data["km2"]) && $data["km2"] == 10000)? "selected" : ""; ?>>10000</option>
                  <option <?php echo (isset($data["km2"]) && !empty($data["km2"]) && $data["km2"] == 50000)? "selected" : ""; ?>>50000</option>
                  <option <?php echo (isset($data["km2"]) && !empty($data["km2"]) && $data["km2"] == 100000)? "selected" : ""; ?>>100000</option>
                  <option <?php echo (isset($data["km2"]) && !empty($data["km2"]) && $data["km2"] == 150000)? "selected" : ""; ?>>150000</option>
                  <option <?php echo (isset($data["km2"]) && !empty($data["km2"]) && $data["km2"] == 200000)? "selected" : ""; ?>>200000</option>
              </select>
          </div>
          <div class="clearfix"></div>
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