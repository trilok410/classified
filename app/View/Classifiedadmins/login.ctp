<?php 
if(!empty($message))
{
?>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <div class="login_error_sec">
                            <h4>Error Message</h4>
                            <p><?php echo $message; ?></p>
                         </div>
                       <?php echo $this->Form->create('Classifiedadmin', array('action' => 'login')); ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="email" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">
                            </fieldset>
                        <?php echo $this->Form->end(); ?>  
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }else{
    
} ?>