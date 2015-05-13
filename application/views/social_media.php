<?php
$this->load->view('common/header');
?>
<?php
//debug($results);
?>
<a href="javascript:void(0)" class="add-new" onclick="createContact()">Add New</a>
<table class="table table-stripped redbar" style="margin-top:20px" width="100%">
    <tr>
<!--        <th class="tb-left">Sl NO.</th>-->
        <th class="tb-left">Logo</th>
        <th>Title</th>
        <th>Url</th>
        <th class="tb-right" width="30%" >Action</th>

    </tr>

    <?php

    $i=1;
    foreach($results as $key):
        ?>
        <?php
        $key1=array_map('addslashes',$key);
        //$key=array_map('htmlspecialchars',$key);
        $json_data=htmlentities(json_encode($key1));
		$json_data = str_replace('\\\\', '\\', $json_data);

		
        ?>
        <tr>
<!--            <td>--><?php //echo $i; ?><!--</td>-->
			<td><?php if($key['Logo']){ $contactImage=site_url().$key['Logo']; ?><a href="<?php echo $contactImage; ?>" target="_blank"><img class='thumbnail conf-thumbnail' src="<?php echo $contactImage; ?>"></a> <br><?php }  ?></td>			
            <td><?php echo $key['Title']; ?></td>
            <td ><?php echo $key['URL']; ?></td>

            <td align="center"><i class="glyphicon glyphicon-pencil btn btn-default" onclick="editContact('<?php echo $json_data; ?>')"></i>&nbsp;<i class="glyphicon glyphicon-trash btn btn-danger" onclick="deleteContact('<?php echo $key['ID']; ?>')"></i></td>
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

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="document.getElementById('delete_social_media_id').value=''" ><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this social media?</p>

                </div>

                <input type="hidden" name="delete_social_media_id" id="delete_social_media_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="document.getElementById('delete_social_media_id').value=''">Close</button>
                    <input type="submit" class="btn btn-danger" name="delete_social_media" id="delete_social_media" value="Delete" />
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="document.getElementById('delete_social_media_id').value=''" ><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Edit Social Media</h4>
                </div>

                <div class="modal-body">
                    <label>Title</label>
                    <input type="text" id="Title" name="Title" class="form-control">
                    <label>Url</label>
                    <input type="text" id="URL" name="URL" class="form-control">
                    <label>Logo</label>
                    <input type="file" id="Image" name="Image" class="form-control">

                </div>

                <input type="hidden" name="edit_social_media_id" id="edit_social_media_id" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()">Close</button>
                    <input type="submit" class="btn btn-info" name="edit_social_media" id="edit_social_media" value="Update" />
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="document.getElementById('delete_splash_id').value=''" ><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Add Social Media</h4>
                </div>

                <div class="modal-body">
                    <label>Title</label>
                    <input type="text"  name="Title" class="form-control">
                    <label>Url</label>
                    <input type="text" ame="URL" class="form-control">
                    <label>Logo</label>
                    <input type="file"  name="Image" class="form-control">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-info" name="create_social_media" id="create_social_media" value="Save" />
                </div>
        </form>

    </div>
</div>
</div>


<script>



    function deleteContact(did){

        var options = {
            "backdrop" : "static"
        };
        $('#delete_social_media_id').val(did);
        $('#myModal').modal(options);
    }

    function createContact(){
        var options = {
            "backdrop" : "static"
        };
        $('#createModal').modal(options);
    }

</script>

<script>

    function editContact(data){

        var options = {
            "backdrop" : "static"
        };
        data=JSON.parse(data);

        $('#Title').val(data.Title);
        $('#URL').val(data.URL);
        $('#edit_social_media_id').val(data.ID);
        $('#editModal').modal(options);
    }


    function flushAll(){
        $("#editContactForm input[type='text']").val('');

    }
</script>