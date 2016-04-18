<div class="col-md-12">
      <div class="table-responsive clearfix">
        <table class="table table-bordered table-hover" id="u">
          <thead>
            <tr>
              <th>S.No.</th>   
              <th>Language Name</th>
              <th>Text(Eng)</th>
              <th>Text</th>
              <th>Action</th>
              </tr>
          </thead>
          <tbody>
          <?php  $count=1; foreach($text_data as $text): ?>
            <tr>
              <td><?php echo $count ?></td>
              <td><?php if($text["WebText"]["lang_id"] == 1){
                      echo "English";
                    }else{
                        echo "German";
                      } ?>
              </td>
              <td><?php echo $text["WebText"]["text_eng"]; ?></td>
              <td><?php echo utf8_encode($text["WebText"]["text_lang"]); ?></td>
              <td class="center">
                <span class="edit_text point" main="<?php echo $text["WebText"]["id"]; ?>"><i class="glyphicon glyphicon-pencil"></i></span> 
              </td>
            </tr>
         <?php $count++; endforeach; ?>
          </tbody>
        </table>
      </div>
   </div>
 <script>
  $(document).ready(function () {
      $('#u').dataTable();
  });
</script>