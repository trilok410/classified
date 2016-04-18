    <style>
    .pagination {
          margin:0 ! important;
  }
  </style>
<div id="page-wrapper" >
  <div id="page-inner">
    
    <!-- Page Heading -->
    <div class="col-lg-12"> 
      <h3 class="page-header"> Language Text </h3>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-2">
          <label class="">Select Language</label>
            <select class="form-control" id="lang_name">
                <option value="1" checked>English</option>
                <option value="2">German</option>
            </select>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
          <div id="load_tab">
            
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="margin-top: 20px;" id="edit_contant">
              
        </div>
    </div>
    <!-- /.row --> 
      
  </div>
</div>
  <!-- /#page-wrapper --> 

<script>
    $(document).ready(function(){

      var lang = btoa(1);
      $('#load_tab').load("<?php echo $this->webroot; ?>classifiedadmins/textlist?lang="+lang);


      $('#lang_name').change(function(){
           var lang = btoa($('#lang_name').val());
           $('#load_tab').load("<?php echo $this->webroot; ?>classifiedadmins/textlist?lang="+lang);
      });

      $('#load_tab').on('click','.edit_text', function(){
          var t_id = btoa($(this).attr("main"));
          $('#edit_contant').load("<?php echo $this->webroot; ?>classifiedadmins/edittext?t_id="+t_id);
          $('html, body').animate({ scrollTop: $("#edit_contant").offset().top }, 1000);
      });
    });
</script>