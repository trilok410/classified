<div class="all_cat_list">
	<a href="javascript:void(0)" class="main_category" main="<?php echo $maincat[0]["classified_maincategories"]["m_id"]; ?>"><h4><?php echo $maincat[0]["classified_maincategories"]["maincategory"]; ?></h4></a>
	<ul class="category_list">
		<?php foreach($category as $cat){ ?>
		<li>
			<a href="javascript:void(0)" class="category" m_id="<?php echo $maincat[0]["classified_maincategories"]["m_id"]; ?>" main="<?php echo $cat["classified_category"]["c_id"]; ?>"><?php echo $cat["classified_category"]["category"]; ?>(<?php echo $cat[0]["ccount"]; ?>)</a>
		</li>
		<?php } ?>
	</ul>
</div>
<div class="ad_list">
	<div class="table-responsive" id="manage_table">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>Ad Id.</th>
                    <th></th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>User</th>
                    <th>User type</th>
                    <th>Hits</th>
                    <th>Ad Type</th>
                    <th>Price</th>
                    <th>Added Date</th>
                    <th>Promotion Plan</th>
                    <th>Payment Date</th>
                    <th>Expiration Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($add_data as $add): ?>
                <tr class="odd gradeX">
                    <td><?php echo $add["classifieds"]["id"]; ?></td>
                    <td><img src="<?php echo $this->webroot.$add["files"]["base_url"]; ?>"></td>
                    <td><?php echo substr($add["classifieds"]["title"], 0,15); ?></td>
                    <td><?php echo $add["classified_category"]["category"]; ?></td>
                    <td><?php echo $add["users"]["name"]; ?></td>
                    <td><?php echo $add["classifieds"]["provider"]; ?></td>
                    <td><?php echo $add["classifieds"]["view"]; ?></td>
                    <td><?php echo ($add["classifieds"]["post_type"] == 2)? "L" : "O"; ?></td>
                    <td><?php echo ($add["classifieds"]["price"] > 0)? $add["classifieds"]["price"] : ""; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($add["classifieds"]["create_date"])); ?></td>
                    <?php 
                            if($add["classifieds"]["urgent"] == 1)
                            {
                                echo "<td>urgent</td>";
                                echo "<td>".date('d-m-Y', strtotime($add["classifieds"]["create_date"]))."</td>";
                                echo "<td>".date('d-m-Y', strtotime($add["classifieds"]["urgent_date"]))."</td>";
                            }else if($add["classifieds"]["featured"] == 1)
                            {
                                echo "<td>featured</td>";
                                echo "<td>".date('d-m-Y', strtotime($add["classifieds"]["create_date"]))."</td>";
                                echo "<td>".date('d-m-Y', strtotime($add["classifieds"]["featured_date"]))."</td>";
                            }else if($add["classifieds"]["gallery"] == 1)
                            {
                                echo "<td>gallery</td>";
                                echo "<td>".date('d-m-Y', strtotime($add["classifieds"]["create_date"]))."</td>";
                                echo "<td>".date('d-m-Y', strtotime($add["classifieds"]["gallery_date"]))."</td>";
                            }else 
                            {
                                echo "<td>no</td>";
                                echo "<td>null</td>";
                                echo "<td>null</td>";
                            }
                        ?>
                    <td>
                         <span class="btn btn-success">Active</span>
                    </td>
                    <td class="center">
                      <span class="event_detail point" main="<?php echo $add["classifieds"]["id"]; ?>"><i class="glyphicon glyphicon-eye-open"></i></span> |
                      <span class="block_event point" main="<?php echo $add["classifieds"]["id"];?>"><i class="glyphicon glyphicon-remove-circle"></i></span> | 
                      <a href="<?php echo $this->webroot ?>classifiedadmins/editad?id=<?php echo $add["classifieds"]["id"];?>" target="_blank"><i class="glyphicon glyphicon-pencil"></i></a>|
                      <span class="delete_ad point" main="<?php echo $add["classifieds"]["id"];?>"><i class="fa fa-trash"></i></span>
                    </td>
                </tr>
            <?php endforeach; ?>   
            </tbody>
        </table>
        <div class="event"></div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable({"columnDefs": [ { "targets": 0, "orderable": false } ] });
    });
</script>