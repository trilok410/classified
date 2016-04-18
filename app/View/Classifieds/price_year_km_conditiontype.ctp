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
          <label class="radio-inline"><input type="radio" name="post_type" checked value="1"><?php echo $lang["I want to Sell"]; ?></label>
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
    <label for="kilometer" class="control-label col-sm-3">
        <?php echo $lang["KM's driven"]; ?>*
    </label>
    <div class="col-sm-4">
        <input type="text" class="form-control kilometer" name="kilometer" id="kilometer" required>
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