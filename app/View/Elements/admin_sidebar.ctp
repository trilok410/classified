<?php $admin = $this->Session->read('admin');
    if(!empty($admin)){ ?> 
   <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav side-nav">
          <li class=""><a class="" data-toggle="collapse" data-target="#maincategory"><i class="fa fa-user"></i> Category<i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="maincategory" class="collapse">
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/maincategory">View Main Category</a> </li>
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/category">View Category</a> </li>
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/subcategory">View Subcategory</a> </li>
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/viewmodel">View Model</a> </li>
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/browse">Browse</a> </li>
            </ul>
          </li>
          <li class=""><a class="" data-toggle="collapse" data-target="#subuser"><i class="fa fa-user"></i> Users<i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="subuser" class="collapse">
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/user">View Users</a> </li>
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/adduser">Add Users</a> </li>
            </ul>
          </li>
          <li class=""><a class="" data-toggle="collapse" data-target="#user_adds"><i class="fa fa-user"></i> User Ads<i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="user_adds" class="collapse">
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/useradds">Manage User Ad's</a></li>
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/pendingadds">Manage Pending Ad's</a></li>
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/addad">Create Ad</a></li>
            </ul>
          </li>
          
          <li class=""><a class="" data-toggle="collapse" data-target="#country"><i class="fa fa-user"></i> Country <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="country" class="collapse">
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/country">Country</a></li>
            </ul>
          </li>
          <li class=""><a class="" data-toggle="collapse" data-target="#state"><i class="fa fa-user"></i> State <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="state" class="collapse">
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/state">State</a></li>
            </ul>
          </li>
          <li class=""><a class="" data-toggle="collapse" data-target="#city"><i class="fa fa-user"></i> City <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="city" class="collapse">
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/city">City</a></li>
            </ul>
          </li>
          <li class=""><a class="" data-toggle="collapse" data-target="#languge"><i class="fa fa-user"></i> Languge <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="languge" class="collapse">
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/webtext">Text</a></li>
            </ul>
          </li>
          <li class=""><a class="" data-toggle="collapse" data-target="#payment"><i class="fa fa-user"></i> Payment <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="payment" class="collapse">
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/paymentmode">Payment Mode</a></li>
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/paymenthistory">Payment History</a></li>
            </ul>
          </li>

          <li class=""><a class="" data-toggle="collapse" data-target="#report"><i class="fa fa-user"></i> Report<i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="report" class="collapse">
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/report">View Report</a></li>
            </ul>
          </li>
          <li class=""><a class="" data-toggle="collapse" data-target="#web"><i class="fa fa-user"></i> Website<i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="web" class="collapse">
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/websetting">Website Settings</a></li>
            </ul>
          </li>
          <li class=""><a class="" data-toggle="collapse" data-target="#tool"><i class="fa fa-user"></i> ToolTip<i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="tool" class="collapse">
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/tooltip">ToolTip Settings</a></li>
            </ul>
          </li> 
          <li class=""><a class="" data-toggle="collapse" data-target="#email_template"><i class="fa fa-user"></i> Email Template<i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="email_template" class="collapse">
              <li> <a href="<?php echo $this->webroot; ?>classifiedadmins/emailtemplate">Email Template</a> </li>
            </ul>
          </li>
          <li class=""><a class="" data-toggle="collapse" data-target="#page"><i class="fa fa-user"></i>Page<i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="page" class="collapse">
              <li><a href="<?php echo $this->webroot; ?>classifiedadmins/terms">Terms</a> </li>
              <li><a href="<?php echo $this->webroot; ?>classifiedadmins/privacy">Privacy</a> </li>
              <li><a href="<?php echo $this->webroot; ?>classifiedadmins/contactus">Contact Us</a> </li>
            </ul>
          </li>                   
      </ul>
  </div>
</nav>
<div id="page-wrapper">
<?php } ?>
