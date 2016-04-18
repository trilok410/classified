<?php
$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='soravgarg123-facilitator@gmail.com'; // Business email ID
$site_url = Configure::read('site_url');
?>

<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
            	<div class="account_info">
                     <div class="row ">
                       <div class="col-md-8 col-sm-8">
                            <div class="check_name">
                                <h3><?php echo $data["name"]; ?></h3>
                                <p><?php echo $data["title"]; ?></p>
                            </div>
                       </div>
                       <div class="col-md-4 col-sm-4">
                        <div class="checkout_amnt text-right">
                            <h2>Amount:<?php echo $u_amt["totalamt"]; ?></h2>
                        </div>
                       </div>
                     </div>
                </div>
                <div class="checkout_tab">
                    <h3>Select Payment Option</h3>
                    
                     <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation"><a href="#Paypal" aria-controls="Paypal" role="tab" data-toggle="tab"><i class="fa fa-paypal"></i>Paypal</a></li>
                        <li role="presentation"><a href="#sofort" aria-controls="Paypal" role="tab" data-toggle="tab">Sofort</a></li>                        
                        <li role="presentation" class="active"><a href="#Card" aria-controls="Card" role="tab" data-toggle="tab"><i class="fa fa-credit-card-alt"></i>Credit / Debit Card. </a></li>
                      </ul>
                    
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane paypal_form" id="Paypal">
                            <form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1">
                                <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="custom" id="custome_field" value="<?php echo $add_id; ?>">
                                <input type="hidden" id="item_name" name="item_name" value="<?php echo $data["title"]; ?>">
                                <!-- <input type="hidden" name="item_number" value="1"> -->
                                <input type="hidden" id="paypal_amount" name="amount" value="<?php echo $u_amt["totalamt"]; ?>">
                                <!-- <input type="hidden" name="no_shipping" value="1"> -->
                                <input type="hidden" name="currency_code" value="EUR">
                                <!-- <input type="hidden" name="handling" value="0"> -->
                                <input type="hidden" name="cancel_return" value="<?php echo $site_url; ?>classifiedadmins/confirm_pay">
                                <input type="hidden" name="return" value="<?php echo $site_url; ?>classifiedadmins/confirm_pay">
                                <input type="hidden" name="bn" value="Business_BuyNow_WPS_SE" />
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default payment_submit"><span class="fa fa-paypal"></span>Paypal</button>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane paypal_form" id="sofort">
                            <form method="post" action="<?php echo $this->webroot; ?>classifiedadmins/dosofort">
                                <input type="hidden" value="<?php echo $add_id; ?>" name="ad_id">
                                <input type="hidden" value="<?php echo $u_amt["totalamt"]; ?>" name="amount">
                                <input type="hidden" value="<?php echo $data["title"]; ?>" name="title">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default payment_submit">Sofort</button>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="Card">
                            <form class="credit_card" role="form" method="post" action="<?php echo $this->webroot; ?>classifiedadmins/payment">
                              <div class="form-group">
                                <label for="">Credit / Debit Card No.</label>
                                <div class="input-group">
                                  <input type="text" name="no_card" class="form-control" required>
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button"><i class="fa fa-credit-card-alt"></i></button>
                                  </span>
                                </div><!-- /input-group -->
                              </div>
                              <div class="form-group form-inline">
                                    <div class="row">
                                        <div class="col-md-6 col-md-6">
                                            <label for="">Card Expiration Date</label>
                                            <select class="form-control" name="card_month" required>
                                                <option value="">Month</option>
                                                <option value="01">01</option>  
                                                <option value="02">02</option>  
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                            <select class="form-control" name="card_year" required>
                                                <option value="">Year</option>
                                                <?php 
                                                    $date = date('Y');
                                                    for($i = $date; $i <= ($date + 40); $i++)
                                                    {
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                    } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6 cvv_number">
                                            <label for="">Card CVV No.</label>
                                            <div class="input-group">
                                              <input type="text" name="card_cvv" class="form-control" required >
                                              <span class="input-group-btn cvv_img">
                                                <img src="<?php echo $this->webroot; ?>images/Checkout_icn.png">
                                              </span>
                                            </div><!-- /input-group -->
                                        </div>
                                    </div>
                              </div>
                              <div class="credit_btn">
                                <input type="hidden" name="add_id" id="add_id" value="<?php echo $add_id; ?>">
                                <input type="hidden" id="amount" name="amount" value="<?php echo $u_amt["totalamt"]; ?>">
                                <input type="hidden" name="title" value="<?php echo $data['title']; ?>">
                                <button type="submit" class="btn btn-primary">Pay Now</button>
                              </div>
                            </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>