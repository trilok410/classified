<?php $lang = $this->Session->read('lang'); ?>
<div class="form-group">
    <label class="control-label col-sm-3" for="fuel"><?php echo $lang["Model"]; ?>*</label>
    <div class="col-sm-4">
    <select class="form-control" name="model" id="model" required>
        <option selected disabled><?php echo $lang["Select"]." ".$lang["Model"]; ?></option>
        <?php foreach($model as $mod){ ?>
        <option value="<?php echo $mod["Models"]["model"]; ?>"><?php echo $mod["Models"]["model"]; ?></option>
        <?php } ?>
    </select>
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-sm-3 control-label"><?php echo $lang["Ad type"]; ?><span>*</span></label>
    <div class="col-sm-9">
      <div class="radio_box">
          <label class="radio-inline"><input type="radio" name="post_type" value="1" checked><?php echo $lang["I want to Sell"]; ?></label>
          <label class="radio-inline"><input type="radio" name="post_type" value="2"><?php echo $lang["I want to Buy"]; ?></label>
      </div>
    </div>
</div>

<div class="form-group">
  <div class="price_main">
      <label for="price" class="col-sm-3 control-label"><?php echo $lang["Price"]; ?><span>*</span></label>
      <div class="col-sm-9">
          <input type="text" class="form-control price" name="price" id="price" required>
          <div class="price_short">, 00 EUR</div>
      </div>
      <div class="price_list">
        <ul>
            <!-- <li>00 EUR</li> -->
            <li><label class="radio-inline"><input type="radio" name="price_type" value="fixed" checked><?php echo $lang["Fixed price"]; ?></label></li>
            <li><label class="radio-inline"><input type="radio" name="price_type" value="negotiable"><?php echo $lang["Negotiable"]; ?></label></li>
            <li><label class="radio-inline"><input type="radio" name="price_type" value="to give away"><?php echo $lang["To give away"]; ?></label></li>
            <div class="clearfix"></div>
        </ul>
      </div>
  </div>
</div>

<div class="form-group">
    <label for="year" class="control-label col-sm-3">
        <?php echo $lang["Year"]; ?>*
    </label>
    <div class="col-sm-3">
        <input type="text" class="form-control year" name="year" id="year" maxlength="4" required>
    </div>
</div>

<div class="form-group">
	<label class="control-label col-sm-3" for="fuel"><?php echo $lang["Fuel"]; ?>*</label>
    <div class="col-sm-4">
    <select class="form-control" name="fuel" id="fuel" required>
    	<option selected disabled><?php echo $lang["Select"]." ".$lang["Fuel"]; ?></option>
    	<option value="<?php echo $lang["Petrol"]; ?>"><?php echo $lang["Petrol"]; ?></option>
    	<option value="<?php echo $lang["Diesel"]; ?>"><?php echo $lang["Diesel"]; ?></option>
    	<option value="<?php echo $lang["LPG"]; ?>"><?php echo $lang["LPG"]; ?></option>
    	<option value="<?php echo $lang["CNG"]; ?>"><?php echo $lang["CNG"]; ?></option>
    </select>
    </div>
</div>

<!-- <div class="form-group">
    <label class="control-label col-sm-3" for="gearbox"><?php echo $lang["Gearbox"]; ?>*</label>
    <div class="col-sm-6">
    <select class="form-control" name="gearbox" id="gearbox" required>
        <option value=""><?php echo $lang["All"]." ".$lang["Transmissions"]; ?></option>
        <option value="manual"><?php echo $lang["Manual"]; ?></option>
        <option value="automatic"><?php echo $lang["Automatic"]; ?></option>
        <option value="semi-automatic"><?php echo $lang["Semi-automatic"]; ?></option>
    </select>
    </div>
</div> -->

<!-- <div class="form-group">
    <label for="power" class="control-label col-sm-3">
        <?php echo $lang["Power"]; ?>*
    </label>
    <div class="col-sm-3">
        <input type="text" class="form-control" name="power" id="power" required>
    </div>
    <div class="col-sm-3">
        <select class="form-control" name="power_unit" id="p_unit" required>
            <option value="ps">PS</option>
            <option value="kw">KW</option>
        </select>
    </div>
</div> -->

<div class="form-group">
    <label for="kilometer" class="control-label col-sm-3">
        <?php echo $lang["KM's driven"]; ?>*
    </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="kilometer" id="kilometer" required>
    </div>
</div>

<div class="form-group">
	<label for="condition_type" class="control-label col-sm-3">
    	<?php echo $lang["Condition"]; ?>
    </label>
    <div class="col-sm-6">
    	<div class="radio_sec">
        <label class="radio-inline">
			<input type="radio" name="condition_type" id="inlineRadio1" value="1" checked> <?php echo $lang["New"]; ?>
		</label>
        <label class="radio-inline">
            <input type="radio" name="condition_type" id="inlineRadio2" value="2"> <?php echo $lang["Used"]; ?>
        </label>
        </div>
    </div>
</div>