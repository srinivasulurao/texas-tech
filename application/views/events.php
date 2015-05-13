<?php
$this->load->view('common/header');
?>
<?php
//debug($results);
?>
<a href="javascript:void(0)" class="add-new" onclick="createEventModal()">Add New</a>
<table class="table table-stripped redbar" style="margin-top:20px" width="100%">
    <tr>
        <!--        <th class="tb-left">Sl NO.</th>-->
        <th class="tb-left">Title</th>
        <th>Date</th>
        <th>Description</th>
        <th>Icon</th>
        <th>GPS</th>
        <th>Address</th>
        <th>Upload Url</th>
        <th>QR Code</th>
		<th>Active</th>

        <th class="tb-right" style="width:10%;">Action</th>

    </tr>

    <?php

    $i=1;
    foreach($results as $key):
        ?>
        <?php
        $key['Date']=date("m/d/Y h:i A",strtotime($key['Date']));
        $key=array_map('addslashes',$key);
        //$key=array_map('htmlspecialchars',$key);
        $json_data=htmlentities(json_encode($key));
		$json_data = str_replace('\\\\', '\\', $json_data);
        $qrcodeUrl=site_url()."event/eventsurvey/".str_replace("=","",base64_encode($key['ID']));
        ?>
        <tr>
            <!--            <td>--><?php //echo $i; ?><!--</td>-->
            <td><?php echo $key['Title']; ?></td>
            <td><?php echo date("m/d/Y h:i A",strtotime($key['Date'])); ?></td>
            <td><?php echo $key['Description']; ?></td>
            <td><?php if($key['Icon']){ $contactImage=site_url().$key['Icon']; ?><a href="<?php echo $contactImage; ?>" target="_blank"><img class='thumbnail conf-thumbnail' src="<?php echo $contactImage; ?>"> </a><br><?php } else echo "No Image Found"; ?></td>
            <td><?php echo "Latitude: ".$key['Latitude']."<br> Longitude: ".$key['Longitude']; ?></td>
            <td><?php echo $key['Address']; ?></td>
            <td><?php echo $key['UploadURL']; ?></td>
            <td><img alt='QR Code not found' src='http://qrickit.com/api/qr?d=<?php echo $qrcodeUrl; ?>' </td>
            <td><?php 
			if($key['Active'] == 1){$isactive = "Yes";}else{$isactive = "No";}
			echo $isactive; ?></td>

            <td align="center"><i class="glyphicon glyphicon-pencil btn btn-default" onclick="editEvent('<?php echo $json_data; ?>')"></i>&nbsp;<i class="glyphicon glyphicon-trash btn btn-danger" onclick="deleteEvent('<?php echo $key['ID']; ?>')"></i></td>
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
                    <p>Are you sure you want to delete event details ?</p>

                </div>

                <input type="hidden" name="delete_event_id" id="delete_event_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()" >Close</button>
                    <input type="submit" class="btn btn-danger" name="delete_event" id="delete_event" value="Delete" />
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
                    <h4 class="modal-title" id="exampleModalLabel">Edit Event Details</h4>
                </div>

                <div class="modal-body">

                    <label>Date</label>
                    <input type="text"  name="Date"  id="Date" class="form-control" autocomplete="off">
                    <label>Title</label>
                    <input type="text"  name="Title"  id="Title" class="form-control">
                    <label>Description</label>
                    <input type="text" name="Description"  id="Description" class="form-control">
                    <label>Address</label>
                    <input type="text"  name="Address"  id="Address" class="form-control">
                    <label>Latitude</label>
                    <input type="text"  name="Latitude"  id="Latitude" class="form-control">
                    <label>Longitude</label>
                    <input type="text"  name="Longitude" id="Longitude"  class="form-control">
                    <label>Upload URL</label>
                    <input type="text" name="UploadURL"  id="UploadURL" class="form-control">
                    <label>Icon</label>
                    <input type="file"  name="Icon" id="Icon" class="form-control">
                    <label>Active</label>	
                    <select class="form-control"  name="Active" id="Active" required>
                        <option value="1">Yes</option>
						<option value="0">No</option>
                    </select>						
					

                </div>

                <input type="hidden" name="edit_event_id" id="edit_event_id" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()">Close</button>
                    <input type="submit" class="btn btn-info" name="edit_event" id="edit_event" value="Update" />
                </div>
        </form>

    </div>
</div>
</div>

<!-- Create a new Contact -->
<div class="modal fade" id='createModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="" enctype="multipart/form-data" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="flushAll()" ><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Add Contact Details</h4>
                </div>

                <div class="modal-body">
                    <label>Date</label>
                    <input type="text"  name="Date" class="form-control" autocomplete="off">
                    <label>Title</label>
                    <input type="text"  name="Title" class="form-control">
                    <label>Description</label>
                    <input type="text" name="Description" class="form-control">
                    <label>Address</label>
                    <input type="text"  name="Address" class="form-control">
                    <label>Latitude</label>
                    <input type="text"  name="Latitude" class="form-control">
                    <label>Longitude</label>
                    <input type="text"  name="Longitude" class="form-control">
                    <label>Upload URL</label>
                    <input type="text" name="UploadURL" class="form-control">
                    <label>Icon</label>
                    <input type="file"  name="Icon" class="form-control">
                    <label>Active</label>
                    <select class="form-control"  name="Active" required>
                        <option value="1">Yes</option>
						<option value="0">No</option>
                    </select>						

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()" >Close</button>
                    <input type="submit" class="btn btn-info" name="create_event" id="create_event" value="Save" />
                </div>
        </form>

    </div>
</div>
</div>


<script>

    function deleteEvent(did){

        var options = {
            "backdrop" : "static"
        };
        $('#delete_event_id').val(did);
        $('#myModal').modal(options);
    }



</script>


<script>
    function createEventModal(){
        var options = {
            "backdrop" : "static"
        };
        $('#createModal').modal(options);
    }

</script>
<script>

    function editEvent(data){

        var options = {
            "backdrop" : "static"
        };
        data=JSON.parse(data);

        $('#Date').val(data.Date);
        $('#Title').val(data.Title);
        $('#Description').val(data.Description);
        $('#Address').val(data.Address);
        $('#Longitude').val(data.Longitude);
        $('#Latitude').val(data.Latitude);
		$('#Active').val(data.Active);
        $('#UploadURL').val(data.UploadURL);
        $('#edit_event_id').val(data.ID);

        $('#editModal').modal(options);
    }


    function flushAll(){
        $("#editContactForm input[type='text'], input[type='hidden']").val('');

    }


</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(function() {
        $( "[name='Date']" ).datetimepicker({format:'m/d/Y h:i A'});
    });
</script>