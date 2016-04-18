<?php $lang = $this->Session->read('lang'); ?>

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
    <label for="typeofadd" class="control-label col-sm-3">
        <?php echo $lang["Add"]." ".$lang["Type"]; ?>
    </label>
    <div class="col-sm-6">
        <div class="radio_sec">
        <label class="radio-inline">
                <input type="radio" name="typeofadd" id="typeofadd1" value="1" checked><?php echo $lang["Rent"]; ?> 
        </label>
        <label class="radio-inline">
          <input type="radio" name="typeofadd" id="typeofadd2" value="2"><?php echo $lang["Sell"]; ?> 
        </label>
        </div>
    </div>
</div>

<div class="form-group">
	<label for="furnished" class="control-label col-sm-3">
        <?php echo $lang["Furnished"]; ?>
    </label>
    <div class="col-sm-6">
    	<div class="radio_sec">
        <label class="radio-inline">
			<input type="radio" name="furnished" id="furnished1" value="Yes" checked><?php echo $lang["Yes"]; ?> 
		</label>
        <label class="radio-inline">
            <input type="radio" name="furnished" id="furnished2" value="No"><?php echo $lang["No"]; ?> 
        </label>
        </div>
    </div>
</div>

<div class="form-group">
	<label class="control-label col-sm-3" for="rooms"><?php echo $lang["Rooms"]; ?>*</label>
    <div class="col-sm-6">
    <select class="form-control" name="rooms" id="rooms" required>
    	<option selected disabled><?php echo $lang["Select"]." ".$lang["Rooms"]; ?></option>
    	<option value="1">1 <?php echo $lang["Rooms"]; ?></option>
    	<option value="2">2 <?php echo $lang["Rooms"]; ?></option>
    	<option value="3">3 <?php echo $lang["and More"]; ?></option>
    </select>
    </div>
</div>

<div class="form-group">
    <label for="squaremeter" class="control-label col-sm-3">
        <?php echo $lang["Square Meters"]; ?>*
    </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="squaremeter" id="squaremeter" required>
    </div>
</div>