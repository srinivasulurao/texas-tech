<?php
$this->load->view('common/header');
?>
<?php
//debug($results);
?>
<?php /*?><a href="javascript:void(0)" class="add-new" onclick="createResourceModal()">Add New</a><?php */?>
<table class="table table-stripped redbar" style="margin-top:20px" width="100%">
    <tr>
        <!--        <th class="tb-left">Sl NO.</th>-->
        <th class="tb-left">Title</th>
        <th>Icon Iphone</th>
		<th>Icon Ipad</th>
        <th>Icon Android</th>
        <th>Icon Tablet</th>
		<th>Sort Order</th>
		<th>Active</th>
        <th class="tb-right" >Action</th>
    </tr>

    <?php

    $i=1;
    foreach($results as $key):
        ?>

        <tr>
            <!--            <td>--><?php //echo $i; ?><!--</td>-->
            <td><?php echo $key['Title']; ?></td>
            <td><?php if($key['IconIphone']){ $contactImage=site_url().$key['IconIphone']; ?><a href="<?php echo $contactImage; ?>" target="_blank"><img class='thumbnail conf-thumbnail' src="<?php echo $contactImage; ?>"></a> <br><?php }  ?></td>
            <td><?php if($key['IconIpad']){ $contactImage=site_url().$key['IconIpad']; ?><a href="<?php echo $contactImage; ?>" target="_blank"><img class='thumbnail conf-thumbnail' src="<?php echo $contactImage; ?>"></a> <br><?php }  ?></td>			
            <td><?php if($key['IconAndroid']){ $contactImage=site_url().$key['IconAndroid']; ?><a href="<?php echo $contactImage; ?>" target="_blank"><img class='thumbnail conf-thumbnail' src="<?php echo $contactImage; ?>"></a> <br><?php }  ?></td>
            <td><?php if($key['IconTablet']){ $contactImage=site_url().$key['IconTablet']; ?><a href="<?php echo $contactImage; ?>" target="_blank"><img class='thumbnail conf-thumbnail' src="<?php echo $contactImage; ?>"></a> <br><?php }  ?></td>						
            <td><?php echo $key['SortOrder']; ?></td>
            <td><?php 
			if($key['Active'] == 1){$isactive = "Yes";}else{$isactive = "No";}
			echo $isactive; ?></td>
            <?php

            $key=array_map('addslashes',$key);
            //$key=array_map('htmlspecialchars',$key);
            $json_data=htmlentities(json_encode($key));
			$json_data = str_replace('\\\\', '\\', $json_data);
            ?>
            <td align="center"><i class="glyphicon glyphicon-pencil btn btn-default" onclick="editHomeScreen('<?php echo $json_data; ?>')"></i>&nbsp;<?php /*?><i class="glyphicon glyphicon-trash btn btn-danger" onclick="deleteHomeScreen('<?php echo $key['ID']; ?>')"></i><?php */?></td>
        </tr>
        <?php
        $i++;
    endforeach;

    ?>

    <?php
    if(!sizeof($results))
        echo "<tr><td colspan='8'><font color='red'>Sorry, No records found !</font></td></tr>"
    ?>
</table>
<?php
$this->load->view('common/footer.php');
?>


<!-- Delete the box -->

<div class="modal fade bs-example-modal-sm" id='myModal' tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <form method="post" action="">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="flushAll()" ><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Home Screen ?</p>

                </div>

                <input type="hidden" name="delete_homescreen_id" id="delete_homescreen_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()" >Close</button>
                    <input type="submit" class="btn btn-danger" name="delete_homescreen" id="delete_homescreen" value="Delete" />
                </div>
        </form>

    </div>
</div>
</div>

<!-- Edit the Contact -->
<div class="modal fade" id='editModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="" enctype="multipart/form-data" id="editContactForm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="flushAll()" ><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Edit Home Screen</h4>
                </div>

                <div class="modal-body">

                    <label>Title</label>
                    <input type="text"  name="Title" id="Title" class="form-control" required>
                    <label>Icon Iphone</label>
                    <input type="file" name="IconIphone" id="IconIphone" class="form-control">
                    <label>Icon Ipad</label>
                    <input type="file" name="IconIpad" id="IconIpad" class="form-control">					
                    <label>Icon Android</label>
                    <input type="file" name="IconAndroid" id="IconAndroid" class="form-control">
                    <label>Icon Tablet</label>
                    <input type="file" name="IconTablet" id="IconTablet" class="form-control">
                    <label>Sort Order</label>
                    <select class="form-control"  name="SortOrder" id="SortOrder">
						<?php for($t=1; $t<=10; $t++){?>
							<option value="<?php echo $t; ?>"><?php echo $t; ?></option>
						<?php }?>
                    </select>	
                    <label>Active</label>	
                    <select class="form-control"  name="Active" id="Active" required>
                        <option value="1">Yes</option>
						<option value="0">No</option>
                    </select>																							



                </div>

                <input type="hidden" name="edit_homescreen_id" id="edit_homescreen_id" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()">Close</button>
                    <input type="submit" class="btn btn-info" name="edit_homescreen" id="edit_homescreen" value="Update" />
                </div>
        </form>

    </div>
</div>
</div>

<!-- Create a new Resource -->
<div class="modal fade" id='createModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="" enctype="multipart/form-data" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="flushAll()" ><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Add Home Screen Details</h4>
                </div>

                <div class="modal-body">

                    <label>Title</label>
                    <input type="text"  name="Title"  class="form-control" required>
                    <label>Icon Iphone</label>
                    <input type="file" name="IconIphone"  class="form-control">
                    <label>Icon Ipad</label>
                    <input type="file" name="IconIpad" id="IconIpad" class="form-control">						
                    <label>Icon Android</label>
                    <input type="file" name="IconAndroid"  class="form-control">
                    <label>Icon Tablet</label>
                    <input type="file" name="IconTablet" class="form-control">
                    <label>Sort Order</label>
                    <select class="form-control"  name="SortOrder">
						<?php for($t=1; $t<=10; $t++){?>
							<option value="<?php echo $t; ?>"><?php echo $t; ?></option>
						<?php }?>
                    </select>	
                    <label>Active</label>
                    <select class="form-control"  name="Active" required>
                        <option value="1">Yes</option>
						<option value="0">No</option>
                    </select>	



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()" >Close</button>
                    <input type="submit" class="btn btn-info" name="create_homescreen" id="create_homescreen" value="Save" />
                </div>
        </form>

    </div>
</div>
</div>


<script>

    function deleteHomeScreen(did){

        var options = {
            "backdrop" : "static"
        };
        $('#delete_homescreen_id').val(did);
        $('#myModal').modal(options);
    }



</script>


<script>
    function createResourceModal(){
        var options = {
            "backdrop" : "static"
        };
        $('#createModal').modal(options);
    }

</script>
<script>

    function editHomeScreen(data){

        var options = {
            "backdrop" : "static"
        };
        data=JSON.parse(data);

        $('#Title').val(data.Title);
        $('#SortOrder').val(data.SortOrder);
        $('#Active').val(data.Active);
        $('#edit_homescreen_id').val(data.ID);
        $('#editModal').modal(options);
    }


    function flushAll(){
        $("#editContactForm input[type='text'], input[type='hidden']").val('');

    }


</script>

<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(function() {
        $( "[name='DateTime']" ).datetimepicker({format :'m/d/Y h:i A'});
    });
</script>-->