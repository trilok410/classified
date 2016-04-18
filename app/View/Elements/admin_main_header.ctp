<?php
$admin = $this->Session->read('admin');
if(!empty($admin))
{
?>   

    <div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php
            $email = "User";
            if(!empty($admin)){
                $email = $admin["Admin"]["first_name"];
                $last = $admin["Admin"]["last_name"];
               } 
            ?>
            <a class="navbar-brand" href="<?php echo $this->webroot; ?>classifiedadmins/index">Classified Admin</a>
        </div>
        <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo " ".$email." ".$last; ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="<?php echo $this->webroot; ?>classifiedadmins/profile"><i class="fa fa-fw fa-user"></i>&nbsp;Profile</a>
                </li>
                <li>
                <?php  if($email != "User"){ ?>
                    <a href="<?php echo $this->webroot; ?>classifiedadmins/logout"><i class="fa fa-fw fa-power-off"></i>&nbsp;Log Out</a>
                <?php }else{ ?>
                    <a href="<?php echo $this->webroot; ?>classifiedadmins/"><i class="fa fa-fw fa-power-off"></i>&nbsp;Log in</a>
                <?php }?>
                </li>
            </ul>
        </li>
    </ul>

<?php }?>

<script>
// $(document).ready(function(){
// $(".dropdown-toggle").click(function(){
// $(".dropdown-menu").toggle();    
// });    
// });                
</script>