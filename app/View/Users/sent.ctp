<?php $lang = $this->Session->read('lang'); ?>
</section>
	
<!--conten sec start-->
<div class="conten">
   <div class="adds_main">
       <div class="container">
         <div class="row">
           <div class="col-md-12 col-sm-12">
              <div class="adds_main_head">
                 <!-- <h1>You can manage your Active & Inactive Ads</h1> -->
              </div>
           </div>
         </div>
         <div class="row">
           <div class="col-md-12 col-sm-12">
               <div class="tab_box">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation"><a href="<?php echo $this->webroot; ?>users/myaccount"><?php echo $lang["ads"]; ?></a></li>
                      <li role="presentation" class="active"><a href="javascript:void(0)"><?php echo $lang["Message"]; ?></a></li>
                      <li role="presentation"><a href="<?php echo $this->webroot; ?>users/setting"><?php echo $lang["Settings"]; ?></a></li>
                      <li role="presentation"><a href="<?php echo $this->webroot; ?>users/paymenthistory"><?php echo $lang["Payment History"]; ?></a></li>
                      <li role="presentation"><a href="<?php echo $this->webroot ?>users/favoritead"><?php echo $lang["Favorite Ads"] ?></a></li>
                      <li role="presentation"><a href="<?php echo $this->webroot ?>users/savesearch"><?php echo $lang["Favorite searches"]; ?></a></li>
                      <li role="presentation"><a href="<?php echo $this->webroot ?>users/billing"><?php echo $lang["billing address"]; ?></a></li>
                    </ul>
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="profile">
                        <div class="tab_head">
                            <div class="tab_head_left">
                                <ul class="list_inbox">
                                   <li><a href="<?php echo $this->webroot; ?>users/message"><?php echo $lang["inbox"]; ?></a></li>
                                   <li class="active"><a href="javascript:void(0)"><?php echo $lang["sent"]; ?></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="message_main_box">
                          <div class="message_main_box_content">
                             <div class="head_message">
                               <div class="checkbox">
                                    <label>
                                      <input type="checkbox" class="mark_all_msg"><?php echo $lang["mark all"]; ?> 
                                    </label>
                                  </div>
                                  <div class="delete_box">
                                  <a href="javascript:void(0)" class="delete_mark_msg"> <i class="fa fa-trash"></i> <?php echo $lang["delete selected"]; ?></a>
                                  </div>
                                  <div class="clearfix"></div>
                             </div>
                             <?php foreach($msg as $ms){ ?>
                             <div class="messege_content">
                                <div class="top_message_content">
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox" class="select_msg" main="<?php echo $ms["messages"]["to_id"]; ?>"> <?php echo $ms["users"]["name"]; ?>
                                    </label>
                                  </div>
                                  <div class="date_message">
                                    <?php echo date("d/m/Y", strtotime($ms["messages"]["created_date"])); ?>
                                  </div>
                                  <div class="clearfix"></div>
                                </div>
                                <div class="para_img user_all_msg" main="<?php echo $ms["messages"]["to_id"]; ?>">
                                   <div class="txt_content">
                                     <p><?php echo nl2br($ms["messages"]["message"]); ?></p>
                                   </div>
                                </div>
                             </div>
                             <?php } ?>  
                          </div>
                        </div>
                        <div class="message_main_box sub_message" style="display:none;">
                           <div class="sub_message_content clearfix">
                           
                           </div>
                      </div>
                    </div>
               </div>
           </div>
         </div>
       </div>
   </div>
</div>
<!--conten sec end-->

<script type="text/javascript">
  $(document).ready(function(){
      /* Show user msg */
      $("body").on("click",".user_all_msg", function(){
          var to_id = $(this).attr("main");
          $(".messege_content").removeClass("active");
          $(this).parent().addClass("active");
          $("#to_id").val(to_id);
          $.ajax({
                  url:"<?php echo $this->webroot; ?>users/getusersentmsg",
                  type:"post",
                  data:{ to_id : to_id },
                  dataType:"json",
                  success: function(data)
                  {
                      $(".sub_message").show();
                      $(".sub_message_content").html("");
                      if(data.chat.length > 0)
                      {
                          $.each(data.chat, function(i,k){
                              var list = "";
                              if(k["messages"]["from_id"] == to_id)
                              {
                                  list +=  '<div class="messege_content">';
                                  list +=  '    <div class="top_message_content">';
                                  list +=  '      <div class="checkbox">';
                                  list +=  '        <a href="javascript:void(0)">'+k["users"]["name"]+'</a>';
                                  list +=  '      </div>';
                                  list +=  '      <div class="date_message">';
                                  list +=           k["messages"]["created_date"];
                                  list +=  '      </div>';
                                  list +=  '      <div class="clearfix"></div>';
                                  list +=  '    </div>';
                                  list +=  '    <div class="para_img">';
                                  list +=  '       <div class="txt_content">';
                                  list +=  '         <p>'+k["messages"]["message"]+'</p>';
                                  list +=  '       </div>';
                                  list +=  '    </div>';
                                  list +=  '  </div>';
                              }else{
                                   list +=  '<div class="messege_content2">';
                                   list +=  '   <div class="top_message_content">';
                                   list +=  '     <div class="checkbox">';
                                   list +=  '        <a href="javascript:void(0)">'+k["users"]["name"]+'</a>';
                                   list +=  '     </div>';
                                   list +=  '     <div class="date_message">';
                                   list +=           k["messages"]["created_date"];
                                   list +=  '     </div>';
                                   list +=  '     <div class="clearfix"></div>';
                                   list +=  '   </div>';
                                   list +=  '   <div class="para_img">';
                                   list +=  '      <div class="txt_content">';
                                   list +=  '         <p>'+k["messages"]["message"]+'</p>';
                                   list +=  '      </div>';
                                   list +=  '   </div>';
                                   list +=  '</div>';
                              }
                              $(".sub_message_content").append(list);
                          });
                      }
                  }
          });
      });
      
      /* mark all msg */
      $("body").on("change",".mark_all_msg", function(){
          if(this.checked)
          {
              $(".select_msg").each(function(){
                  $(this).prop("checked",true);
              });
          }else
          {
              $(".select_msg").each(function(){
                  $(this).prop("checked",false);
              });
          }
      });

      /* Delete User msg */
      $("body").on("click",".delete_mark_msg", function(){
          var tid = "";
          var cur = $(this);
          $(".select_msg:checked").each(function(){
              tid += $(this).attr("main")+",";
          });
          if(tid != "")
          {
              $.ajax({
                      url:"<?php echo $this->webroot; ?>users/deleteusersentmsg",
                      type:"post",
                      data:{tid:tid},
                      dataType:"json",
                      success: function(data)
                      {
                        window.location.reload();
                      }
              });
          }
      });  

  });
</script>