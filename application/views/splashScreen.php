<?php
$this->load->view('common/header');
?>
<?php
//debug($results);
?>
<a href="javascript:void(0)" class="add-new" onclick="createResourceModal()">Add New</a>
<table class="table table-stripped redbar" style="margin-top:20px" width="'100%">
    <tr>
        <th class="tb-left">Device Type</th>
        <th>Splash</th>
        <th>Icon Background </th>
        <th>Sub-background </th>
        <th>Back Button</th>
        <th>Title Bar</th>
        <th>Text Bar Color</th>
        <th class="tb-right" >Action</th>

    </tr>
    <?php foreach($results as $key):  ?>
    <?php $key=array_map('addslashes',$key); $json_data=htmlentities(json_encode($key)); ?>
     <tr>
         <td><?php echo stripslashes($key['device_type']); ?><br><?php echo $key['resolution']; ?></td>
         <td><a href="<?php echo site_url().$key['icon']; ?>" target="_blank"><img alt='Image Not Available' src="<?php echo site_url().$key['icon']; ?>" class="thumbnail conf-thumbnail"></a></td>
         <td><a href="<?php echo site_url().$key['background1']; ?>" target="_blank"><img alt='Image Not Available' src="<?php echo site_url().$key['background1']; ?>" class="thumbnail conf-thumbnail"></a></td>
         <td><a href="<?php echo site_url().$key['background2']; ?>" target="_blank"><img alt='Image Not Available' src="<?php echo site_url().$key['background2']; ?>" class="thumbnail conf-thumbnail"></a></td>
         <td><a href="<?php echo site_url().$key['backbutton']; ?>" target="_blank"><img alt='Image Not Available' src="<?php echo site_url().$key['backbutton']; ?>" class="thumbnail conf-thumbnail"></a></td>
         <td><a href="<?php echo site_url().$key['titlebar']; ?>" target="_blank"><img alt='Image Not Available' src="<?php echo site_url().$key['titlebar']; ?>" class="thumbnail conf-thumbnail"></a></td>
         <td><?php echo $key['titlebartextcolor']; ?></td>
         <td align="center"><i class="glyphicon glyphicon-pencil btn btn-default" onclick="editSplashScreen('<?php echo $json_data; ?>')"></i>&nbsp;<i class="glyphicon glyphicon-trash btn btn-danger" onclick="deleteSplashScreen('<?php echo $key['splashScreenId']; ?>')"></i></td>
     </tr>
    <?php endforeach; ?>
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

           <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="document.getElementById('delete_splash_id').value=''" ><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this splash screen ?</p>

            </div>

                <input type="hidden" name="delete_splash_id" id="delete_splash_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="document.getElementById('delete_splash_id').value=''">Close</button>
                    <input type="submit" class="btn btn-danger" name="delete_splash_screen" id="delete_splash_screen" value="Delete" />
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Edit the SplashScreen -->
<div class="modal fade" id='editModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="document.getElementById('delete_splash_id').value=''" ><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Edit Splash Screen</h4>
                </div>

                <div class="modal-body">
                    <label>Device Type</label>
                    <select class="form-control" required="" name="deviceType" id="deviceType">
                    <option value="">--SELECT--</option>
                        <?php
                        foreach($deviceTypes as $key):
                            echo"<option value='{$key['id']}'>{$key['device_type']}</option>";
                        endforeach;
                        ?>
                    </select><br>

                    <label>Device Resolution</label>
                    <select class="form-control" required="" name="deviceResolution" id="deviceResolution">
                        <option value="">--SELECT--</option>
                        <?php
                        foreach($deviceResolutions as $key):
                            echo"<option value='{$key['id']}'>{$key['resolution']}</option>";
                        endforeach;
                        ?>
                    </select><br>

                    <label>Splash Screen :</label><br>
                    <span class="file_bound"><input type="file" class='form-control' name="icon" id="icon"></span>
                    <input type="checkbox" name="remove_icon" value="1">Remove
                    <br>
                    <label>Icon Background Screen :</label><br>
                    <span class="file_bound"><input type="file" class='form-control' name="background1" id="background1"></span>
                    <input type="checkbox" name="remove_background1" value="1">Remove
                    <br>
                    <label>Sub-Background Screen :</label><br>
                    <span class="file_bound"><input type="file" class='form-control' name="background2" id="background2"></span>
                    <input type="checkbox" name="remove_background2" value="1">Remove
                    <br>
                    <label>Back Button :</label><br>
                    <span class="file_bound"><input type="file" class="form-control" name="backbutton" id="backbutton"></span>
                    <input type="checkbox" name="remove_backbutton" value="1"> Remove
                    <br>
                    <label>Title Bar :</label><br>
                    <span class="file_bound"><input type="file" class='form-control' name="titlebar" id="titlebar"></span>
                    <input type="checkbox" name="remove_titlebar" value="1">Remove
                    <br>
                    <label>Text Bar Color :</label>
                    <input type="text" class='form-control' name="titlebartextcolor" id="titlebartextcolor">
                </div>

                <input type="hidden" name="edit_splash_id" id="edit_splash_id" value="213123">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()">Close</button>
                    <input type="submit" class="btn btn-info" name="edit_splash_screen" id="edit_splash_screen" value="Update" />
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
                    <h4 class="modal-title" id="exampleModalLabel">Add Splash Screen Details</h4>
                </div>

                <div class="modal-body">

                    <label>Device Type</label>
                    <select class="form-control" required="" name="deviceType" >
                        <option value="">--SELECT--</option>
                        <?php
                        foreach($deviceTypes as $key):
                            echo"<option value='{$key['id']}'>{$key['device_type']}</option>";
                        endforeach;
                        ?>
                    </select><br>

                    <label>Device Resolution</label>
                    <select class="form-control" required="" name="deviceResolution" >
                        <option value="">--SELECT--</option>
                        <?php
                        foreach($deviceResolutions as $key):
                            echo"<option value='{$key['id']}'>{$key['resolution']}</option>";
                        endforeach;
                        ?>
                    </select><br>

                    <label>Splash Screen :</label><br>
                    <span class="file_bound"><input type="file" class='form-control' name="icon" ></span>
                    <input type="checkbox" name="remove_icon" value="1">Remove
                    <br>
                    <label>Icon Background Screen :</label><br>
                    <span class="file_bound"><input type="file" class='form-control' name="background1" ></span>
                    <input type="checkbox" name="remove_background1" value="1">Remove
                    <br>
                    <label>Sub-Background Screen :</label><br>
                    <span class="file_bound"><input type="file" class='form-control' name="background2" ></span>
                    <input type="checkbox" name="remove_background2" value="1">Remove
                    <br>
                    <label>Back Button :</label><br>
                    <span class="file_bound"><input type="file" class="form-control" name="backbutton" ></span>
                    <input type="checkbox" name="remove_backbutton" value="1"> Remove
                    <br>
                    <label>Title Bar :</label><br>
                    <span class="file_bound"><input type="file" class='form-control' name="titlebar" ></span>
                    <input type="checkbox" name="remove_titlebar" value="1">Remove
                    <br>
                    <label>Text Bar Color :</label>
                    <input type="text" class='form-control' name="titlebartextcolor" >

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()" >Close</button>
                    <input type="submit" class="btn btn-info" name="create_splashscreen" id="create_splashscreen" value="Save" />
                </div>
        </form>

    </div>
</div>
</div>



<script>

    function createResourceModal(){
        var options = {
            "backdrop" : "static"
        };
        $('#createModal').modal(options);
    }

    function deleteSplashScreen(did){

        var options = {
            "backdrop" : "static"
        };
        $('#delete_splash_id').val(did);
        $('#myModal').modal(options);
    }


</script>

<script>

    function editSplashScreen(data){

        var options = {
            "backdrop" : "static"
        };
        data=JSON.parse(data);
        $('#titlebartextcolor').val(data.titlebartextcolor);
        $('#deviceType').val(data.deviceType);
        $('#deviceResolution').val(data.deviceResolution);
        $('#edit_splash_id').val(data.splashScreenId);
        $('#editModal').modal(options);
    }


    function flushAll(){
        $("form input[type='hidden'],select").val('');

    }
</script>