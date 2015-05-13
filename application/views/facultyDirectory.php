<?php
$this->load->view('common/header');
?>
<?php
//debug($results);
//debug($campusList);
?>
<a href="javascript:void(0)" class="add-new" onclick="createResourceModal()">Add New</a>
<table class="table table-stripped redbar" style="margin-top:20px" width="100%">
    <tr>
        <th class="tb-left">Campus</th>
        <th>Title</th>
        <th>Name</th>
        <th>Rank</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Image</th>
        <th>Web</th>
        <th class="tb-right" >Action</th>

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
            <td><?php echo $key['campus_name']; ?></td>
            <td><?php echo $key['Title']; ?></td>
            <td><?php echo $key['FirstName']." ".$key['LastName']; ?></td>
            <td><?php echo $key['Rank']; ?></td>
            <td><?php echo $key['Phone']; ?></td>
            <td><?php echo $key['Email']; ?></td>
            <td><?php echo ($key['Image'])?"<a href='".$key['Image']."' target='_black'><img class='thumbnail conf-thumbnail' src='".$key['Image']."'></a>":"Image Not Available."; ?></td>
            <td><?php echo '<div style=\'word-wrap: break-word;width:11em\'>'.$key['URL'].'</div>'; ?></td>


            <td align="center" style='width:100px;'><i class="glyphicon glyphicon-pencil btn btn-default" onclick="editFaculty('<?php echo $json_data; ?>')"></i>&nbsp;<i class="glyphicon glyphicon-trash btn btn-danger" onclick="deleteFaculty('<?php echo $key['ID']; ?>')"></i></td>
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
                    <p>Are you sure you want to delete Faculty details ?</p>

                </div>

                <input type="hidden" name="delete_faculty_id" id="delete_faculty_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()" >Close</button>
                    <input type="submit" class="btn btn-danger" name="delete_faculty" id="delete_faculty" value="Delete" />
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

                    <label>Campus</label>
                    <select name="Campus" id="Campus" class="form-control">
                        <option value="">--Select--</option>
                        <?php
                        foreach($campusList as $key):
                            echo "<option  value='{$key['ID']}'>{$key['Name']}</option>";
                        endforeach;
                        ?>
                    </select>
                    <label>Title</label>
                    <input type="text"  name="Title"  id="Title" class="form-control">
                    <label>First Name</label>
                    <input type="text" name="FirstName"  id="FirstName" class="form-control">
                    <label>Last Name</label>
                    <input type="text" name="LastName"  id="LastName"  class="form-control">
                    <label>Rank</label>
                    <input type="text" name="Rank"  id='Rank' class="form-control">
                    <label>Phone</label>
                    <input type="text"  name="Phone"  id="Phone" class="form-control">
                    <label>Email</label>
                    <input type="text"  name="Email"  id="Email" class="form-control">
                    <label>Image</label>
                    <input type="file" name="ImageLocal" id="ImageLocal" class="form-control">
                    <div style='text-align:center'><strong>OR</strong></div>
                    <input type='text' name='Image' id='Image' class='form-control'>
                    <label>URL</label>
                    <input type="text"  name="URL" id="URL"  class="form-control">

                </div>

                <input type="hidden" name="edit_faculty_id" id="edit_faculty_id" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()">Close</button>
                    <input type="submit" class="btn btn-info" name="edit_faculty" id="edit_faculty" value="Update" />
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

                    <label>Campus</label>
                    <select name="Campus"  class="form-control">
                        <option value="">--Select--</option>
                        <?php
                        foreach($campusList as $key):
                            echo "<option  value='{$key['ID']}'>{$key['Name']}</option>";
                        endforeach;
                        ?>
                    </select>
                    <label>Title</label>
                    <input type="text"  name="Title"   class="form-control">
                    <label>First Name</label>
                    <input type="text" name="FirstName"   class="form-control">
                    <label>Last Name</label>
                    <input type="text" name="LastName"   class="form-control">
                    <label>Rank</label>
                    <input type="text" name="Rank"   class="form-control">
                    <label>Phone</label>
                    <input type="text"  name="Phone"   class="form-control">
                    <label>Email</label>
                    <input type="text"  name="Email"   class="form-control">
                    <label>Image</label>
                    <input type="file" name="ImageLocal"  class="form-control">
                    <div style='text-align:center'><strong> OR </strong></div>
                    <input type='text' name='Image' class='form-control'>
                    <label>URL</label>
                    <input type="text"  name="URL"   class="form-control">


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()" >Close</button>
                    <input type="submit" class="btn btn-info" name="create_faculty" id="create_faculty" value="Save" />
                </div>
        </form>

    </div>
</div>
</div>


<script>

    function deleteFaculty(did){

        var options = {
            "backdrop" : "static"
        };
        $('#delete_faculty_id').val(did);
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

    function editFaculty(data){

        var options = {
            "backdrop" : "static"
        };
        data=JSON.parse(data);

        $('#Campus').val(data.campus_id);
        $('#Title').val(data.Title);
        $('#FirstName').val(data.FirstName);
        $('#LastName').val(data.LastName);
        $('#Rank').val(data.Rank);
        $('#Phone').val(data.Phone);
        $('#Email').val(data.Email);
        $('#Image').val(data.Image);
        $('#URL').val(data.URL);
        $('#edit_faculty_id').val(data.ID);
        $('#editModal').modal(options);
    }


    function flushAll(){
        $("#editContactForm input[type='text'], input[type='hidden']").val('');

    }


</script>
