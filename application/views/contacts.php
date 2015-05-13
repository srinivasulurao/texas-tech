<?php
$this->load->view('common/header');
?>
<?php
//debug($results);
?>
<a href="javascript:void(0)" class="add-new" onclick="createCampus()">Add Campus</a>
<a href="javascript:void(0)" class="add-new" onclick="createContact()">Add Contact</a>
<table class="table table-stripped redbar" style="margin-top:20px" width="100%">
    <tr>
<!--        <th class="tb-left">Sl NO.</th>-->
        <th class="tb-left">Campus</th>
        <th>Department</th>
        <th>Title</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Url</th>

        <th class="tb-right" width="30%" >Action</th>

    </tr>

    <?php

    $i=1;
    foreach($results as $key):
        ?>
        <?php
        $key=array_map('addslashes',$key);
        //$key=array_map('htmlspecialchars',$key);
        $json_data=htmlentities(json_encode($key));
        ?>
        <tr>
<!--            <td>--><?php //echo $i; ?><!--</td>-->
            <td><?php echo $key['campus_name']; ?></td>
            <td><?php echo $key['Department']; ?></td>
            <td><?php echo $key['Title']; ?></td>
            <td><?php echo $key['Name'];  if($key['Image']): $contactImage=site_url().$key['Image']; ?><br> <img class='thumbnail conf-thumbnail' src="<?php echo $contactImage; ?>"> <br><?php endif;  ?></td>
            <td><?php echo $key['Phone']; ?></td>
            <td><?php echo $key['Email']; ?></td>
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

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="document.getElementById('delete_contact_id').value=''" ><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this contact details ?</p>

                </div>

                <input type="hidden" name="delete_contact_id" id="delete_contact_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="document.getElementById('delete_contact_id').value=''">Close</button>
                    <input type="submit" class="btn btn-danger" name="delete_contact" id="delete_contact" value="Delete" />
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="document.getElementById('delete_contact_id').value=''" ><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Edit Contact Details</h4>
                </div>

                <div class="modal-body">
                    <label>Campus</label>
                     <select name="Campus" id="Campus" class="form-control">
                        <option value="">--Select--</option>
                        <?php
                        foreach($campusList as $key):
                            echo "<option  value='{$key['ID']}'>{$key['Name']}</option>";
                        endforeach;
                        ?>
                    </select>
                    <label>Department</label>
                    <input type="text" id="Department" name="Department" class="form-control">
                    <label>Title</label>
                    <input type="text" id="Title" name="Title" class="form-control">
                    <label>Name</label>
                    <input type="text" id="Name" name="Name" class="form-control">
                    <label>Phone</label>
                    <input type="text" id="Phone" name="Phone" class="form-control">
                    <label>Email</label>
                    <input type="text" id="Email" name="Email" class="form-control">
                    <label>Url</label>
                    <input type="text" id="URL" name="URL" class="form-control">
                    <label>Image</label>
                    <input type="file" id="Image" name="Image" class="form-control">

                </div>

                <input type="hidden" name="edit_contact_id" id="edit_contact_id" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()">Close</button>
                    <input type="submit" class="btn btn-info" name="edit_contact" id="edit_contact" value="Update" />
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
                    <h4 class="modal-title" id="exampleModalLabel">Add Contact Details</h4>
                </div>

                <div class="modal-body">
                    <label>Campus <!--<span style="cursor:pointer;color:red;" onclick="showCampusDropDown();">+</span>--></label>
                     <select name="Campus" id="Campusdropdown"  class="form-control">
                        <option value="">--Select--</option>
                        <?php
                        foreach($campusList as $key):
                            echo "<option  value='{$key['ID']}'>{$key['Name']}</option>";
                        endforeach;
                        ?>
                    </select><br />
                    <label>Department</label>
                    <input type="text"  name="Department" class="form-control">
                    <label>Title</label>
                    <input type="text"  name="Title" class="form-control">
                    <label>Name</label>
                    <input type="text" name="Name" class="form-control">
                    <label>Phone</label>
                    <input type="text"  name="Phone" class="form-control">
                    <label>Email</label>
                    <input type="text"  name="Email" class="form-control">
                    <label>Url</label>
                    <input type="text" ame="URL" class="form-control">
                    <label>Image</label>
                    <input type="file"  name="Image" class="form-control">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-info" name="create_contact" id="create_contact" value="Save" />
                </div>
        </form>

    </div>
</div>
</div>


<!-- Create a new Campus -->
<div class="modal fade" id='createCampus' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="" enctype="multipart/form-data" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="document.getElementById('delete_splash_id').value=''" ><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Add New Campus</h4>
                </div>

                <div class="modal-body">
                    <label>Campus name</label>
                    <input type="text"  name="Name" class="form-control" >
                    <label>Address</label>
                    <input type="text"  name="Address" class="form-control" >
                    <label>State</label>
                    <input type="text"  name="State" class="form-control" >
                    <label>Zip</label>
                    <input type="text"  name="Zip" class="form-control" >
                    <label>Phone</label>
                    <input type="text"  name="Phone" class="form-control" >																											

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-info" name="create_campus" id="create_campus" value="Save" />
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
        $('#delete_contact_id').val(did);
        $('#myModal').modal(options);
    }

    function createContact(){
        var options = {
            "backdrop" : "static"
        };
        $('#createModal').modal(options);
    }
	
    function createCampus(){
        var options = {
            "backdrop" : "static"
        };
        $('#createCampus').modal(options);
    }	
	
//	function showCampusDropDown(){
//		if($('#Campusdropdown').css('display') == 'none'){ 
//		   $('#Campusdropdown').show('slow'); 
//		} else { 
//		   $('#Campusdropdown').hide('slow'); 
//		}
//	}

</script>

<script>

    function editContact(data){

        var options = {
            "backdrop" : "static"
        };
        data=JSON.parse(data);

        $('#Campus').val(data.Campus);
        $('#Department').val(data.Department);
        $('#Title').val(data.Title);
        $('#Name').val(data.Name);
        $('#Phone').val(data.Phone);
        $('#Email').val(data.Email);
        $('#URL').val(data.URL);
        $('#edit_contact_id').val(data.ID);

        $('#editModal').modal(options);
    }


    function flushAll(){
        $("#editContactForm input[type='text']").val('');

    }
</script>