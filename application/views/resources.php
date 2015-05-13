<?php
$this->load->view('common/header');
?>
<?php
//debug($results);
?>
<a href="javascript:void(0)" class="add-new" onclick="createResourceModal()">Add New</a>
<table class="table table-stripped redbar" style="margin-top:20px" width="100%">
    <tr>
        <!--        <th class="tb-left">Sl NO.</th>-->
        <th class="tb-left">Title</th>
        <th>Teaser Scentence</th>
        <th>Date/Time</th>
        <th>GPS</th>
        <th>Address</th>
        <th class="tb-right" >Action</th>

    </tr>

    <?php

    $i=1;
    foreach($results as $key):
        ?>
        <?php
        $key['DateTime']=date("m/d/Y h:i A",strtotime($key['DateTime']));
        $key=array_map('addslashes',$key);
        //$key=array_map('htmlspecialchars',$key);
        $json_data=htmlentities(json_encode($key));
        ?>
        <tr>
            <!--            <td>--><?php //echo $i; ?><!--</td>-->
            <td><?php echo $key['Title']; ?></td>

            <td><?php echo $key['TeaserSentence']; ?></td>
            <td><?php echo date("m/d/Y h:i A",strtotime($key['DateTime'])); ?></td>
            <td><?php echo "Latitude: ".$key['Latitude']."<br> Longitude: ".$key['Longitude']; ?></td>
            <td><?php echo $key['Address']; ?></td>


            <td align="center"><i class="glyphicon glyphicon-pencil btn btn-default" onclick="editResource('<?php echo $json_data; ?>')"></i>&nbsp;<i class="glyphicon glyphicon-trash btn btn-danger" onclick="deleteResource('<?php echo $key['ID']; ?>')"></i></td>
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

                <input type="hidden" name="delete_resource_id" id="delete_resource_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()" >Close</button>
                    <input type="submit" class="btn btn-danger" name="delete_resource" id="delete_resource" value="Delete" />
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
                    <input type="text"  name="DateTime"  id="DateTime" class="form-control" autocomplete="off">
                    <label>Title</label>
                    <input type="text"  name="Title"  id="Title" class="form-control">
                    <label>Teaser Sentence</label>
                    <input type="text" name="TeaserSentence"  id="TeaserSentence" class="form-control">
                    <label>Address</label>
                    <input type="text"  name="Address"  id="Address" class="form-control">
                    <label>Latitude</label>
                    <input type="text"  name="Latitude"  id="Latitude" class="form-control">
                    <label>Longitude</label>
                    <input type="text"  name="Longitude" id="Longitude"  class="form-control">
					 <label>UploadURL</label>
                    <input type="file"  name="UploadURL" class="form-control">						

                </div>

                <input type="hidden" name="edit_resource_id" id="edit_resource_id" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()">Close</button>
                    <input type="submit" class="btn btn-info" name="edit_resource" id="edit_resource" value="Update" />
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
                    <h4 class="modal-title" id="exampleModalLabel">Add Contact Details</h4>
                </div>

                <div class="modal-body">
                    <label>Date</label>
                    <input type="text"  name="DateTime" class="form-control" autocomplete="off">
                    <label>Title</label>
                    <input type="text"  name="Title" class="form-control">
                    <label>Teaser Sentence</label>
                    <input type="text" name="TeaserSentence" class="form-control">
                    <label>Address</label>
                    <input type="text"  name="Address" class="form-control">
                    <label>Latitude</label>
                    <input type="text"  name="Latitude" class="form-control">
                    <label>Longitude</label>
                    <input type="text"  name="Longitude" class="form-control">
					 <label>UploadURL</label>
                    <input type="file"  name="UploadURL" class="form-control">					


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()" >Close</button>
                    <input type="submit" class="btn btn-info" name="create_resource" id="create_resource" value="Save" />
                </div>
        </form>

    </div>
</div>
</div>


<script>

    function deleteResource(did){

        var options = {
            "backdrop" : "static"
        };
        $('#delete_resource_id').val(did);
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

    function editResource(data){

        var options = {
            "backdrop" : "static"
        };
        data=JSON.parse(data);

        $('#DateTime').val(data.DateTime);
        $('#Title').val(data.Title);
        $('#TeaserSentence').val(data.TeaserSentence);
        $('#Address').val(data.Address);
        $('#Longitude').val(data.Longitude);
        $('#Latitude').val(data.Latitude);
        $('#edit_resource_id').val(data.ID);
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
        $( "[name='DateTime']" ).datetimepicker({format :'m/d/Y h:i A'});
    });
</script>