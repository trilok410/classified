<?php $lang = $this->Session->read('lang'); ?>
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
