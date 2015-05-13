<?php
$this->load->view('common/header');
?>
<?php
//debug($results);
?>
<!--<a href="javascript:void(0)" class="add-new" onclick="createLoginScreenModal()">Add New</a>-->
<!--<a href="javascript:void(0)" class="add-new" onclick="createMassPush()">Mass Push</a>-->
<table class="table table-stripped redbar" style="margin-top:20px" width="100%">
    <tr>
        <!--        <th class="tb-left">Sl NO.</th>-->
        <th class="tb-left">User Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>RN#</th>
		<th>Role</th>
		<th>Program</th>
        <th class="tb-right" >Action</th>
    </tr>

    <?php

    $i=1;
    foreach($results as $key):
        ?>

        <tr>
            <td><?php echo $key['ID']; ?></td>
            <td><?php echo $key['FirstName']; ?></td>
            <td><?php echo $key['LastName']; ?></td>
            <td><?php echo $key['Email']; ?></td> <!--echo date("Y-m-d h:i A",strtotime($key['createdDate']));-->
            <td><?php echo $key['RN_No']; ?></td>
			<td><?php echo $key['status_type']; ?></td>
			<td><?php echo $key['Program']; ?></td>
            <?php
            $key['createdDate']=date("Y-m-d h:i A",strtotime($key['createdDate']));
            $key=array_map('addslashes',$key);
            //$key=array_map('htmlspecialchars',$key);
            $json_data=htmlentities(json_encode($key));
			$json_data = str_replace('\\\\', '\\', $json_data);
            ?>
            <td align="center"><i class="glyphicon glyphicon-pencil btn btn-default" onclick="editLoginScreen('<?php echo $json_data; ?>//')"></i>&nbsp;<i class="glyphicon glyphicon-trash btn btn-danger" onclick="deleteLoginScreen('<?php echo $key['ID']; ?>')"></i><!--&nbsp <button class="btn btn-danger" onclick="createSinglePush('<?php //echo $key['ID']; ?>')">Push Notification</button>--></td>
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
                    <p>Are you sure you want to delete this Login Screen ?</p>

                </div>

                <input type="hidden" name="delete_loginscreen_id" id="delete_loginscreen_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()" >Close</button>
                    <input type="submit" class="btn btn-danger" name="delete_loginscreen" id="delete_loginscreen" value="Delete" />
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
                    <h4 class="modal-title" id="exampleModalLabel">Edit Login Screen</h4>
                </div>

                <div class="modal-body">

                    <label>GUID</label>
                    <input type="text"  name="GUID" id="GUID" class="form-control">
                    <label>Username</label>
                    <input type="text" name="username" id="username" class="form-control">
                    <label>Message</label>
                    <input type="text" name="message" id="message" class="form-control">
                    <label>Date Logged In</label>
                    <input type="text" name="createdDate" id="createdDate" class="form-control"
                    <label>Status</label>

                    <select class="form-control" required="" name="status" id="status">
                        <option value="">--SELECT--</option>
                        <?php
                        foreach($statusTypes as $key):
                            echo"<option value='{$key['status_id']}'>{$key['status_type']}</option>";
                        endforeach;
                        ?>
                    </select><br>



                </div>

                <input type="hidden" name="edit_loginscreen_id" id="edit_loginscreen_id" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()">Close</button>
                    <input type="submit" class="btn btn-info" name="edit_loginscreen" id="edit_loginscreen" value="Update" />
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
                    <h4 class="modal-title" id="exampleModalLabel">Add Login Screen Details</h4>
                </div>

                <div class="modal-body">

                    <label>GUID</label>
                    <input type="text"  name="GUID" class="form-control">
                    <label>Username</label>
                    <input type="text" name="username"  class="form-control">
                    <label>Message</label>
                    <input type="text" name="message"  class="form-control">
                    <label>Date Logged In</label>
                    <input type="text" name="createdDate"  class="form-control" />
                    <label>Status</label>

                    <select class="form-control" required="" name="status" >
                        <option value="">--SELECT--</option>
                        <?php
                        foreach($statusTypes as $key):
                            echo"<option value='{$key['status_id']}'>{$key['status_type']}</option>";
                        endforeach;
                        ?>
                    </select><br>




                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()" >Close</button>
                    <input type="submit" class="btn btn-info" name="create_loginscreen" id="create_loginscreen" value="Save" />
                </div>
        </form>

    </div>
</div>
</div>

<!--Single push pop up-->
<div class="modal fade" id='singlePush_popup' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="" enctype="multipart/form-data" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="flushAll()" ><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Write Push Notification</h4>
                </div>

                <div class="modal-body">

                    <label>Push Message</label>
					<textarea name="single_push_msg" id="single_push_msg" required cols="40" rows="5" ></textarea>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()" >Close</button>
                    <input type="button" class="btn btn-info" name="send_push"  value="Submit" onclick="sendSinglePushSubmit()"/>
                </div>
        </form>

    </div>
</div>
</div>

<!--Mass push pop up-->
<div class="modal fade" id='massPush_popup' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="" enctype="multipart/form-data" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="flushAll()" ><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Send Mass Push Notification</h4>
                </div>

                <div class="modal-body">
					<label>Status</label>
                    <select class="form-control" required="" name="mass_push_status" id="mass_push_status">
                        <option value="">--SELECT--</option>
                        <?php
                        foreach($statusTypes as $key):
                            echo"<option value='{$key['status_id']}'>{$key['status_type']}</option>";
                        endforeach;
                        ?>
                    </select><br>				

                    <label>Push Message</label>
					<textarea name="mass_push_msg" id="mass_push_msg" required cols="40" rows="5" ></textarea>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="flushAll()" >Close</button>
                    <input type="button" class="btn btn-info" name="send_push"  value="Submit" onclick="sendMassPushSubmit()"/>
                </div>
        </form>

    </div>
</div>
</div>


<form method="post" action="" name="sendPushNotificationForm">
    <input type="hidden" name="sendPushNotification" id="sendPushNotification" >
	<input type="hidden" name="pushId" id="pop_pushId" value="">
	<input type="hidden" name="message" id="pop_message" value="Hello test">
	<input type="hidden" name="status_id" id="pop_status_id" value="">
</form>

<script>

    function setSinglePushParams(did){
        $('#sendPushNotification').val(did);
		$('#pop_pushId').val(did);
    }
	
    function sendSinglePushSubmit(){
       var  message =  $('#single_push_msg').val();
	   if($.trim(message) == ''){
			alert("Write Push message");
			return false;
	   }
		 $('#pop_message').val(message);
		 $('#pop_status_id').val('');
        document.sendPushNotificationForm.submit();
    }	
	
    function sendMassPushSubmit(){
		var  mass_push_status =  $('#mass_push_status').val();
		if($.trim(mass_push_status) == ''){
			alert("Select Status Type");
			return false;
		}	
	   	
		var  message =  $('#mass_push_msg').val();
		if($.trim(message) == ''){
			alert("Write Push message");
			return false;
		}
		 
	 
		 
		 $('#sendPushNotification').val("Yes");
		 $('#pop_pushId').val('');
		 $('#pop_message').val(message);
		 $('#pop_status_id').val(mass_push_status);
        document.sendPushNotificationForm.submit();
    }		

    function deleteLoginScreen(did){

        var options = {
            "backdrop" : "static"
        };
        $('#delete_loginscreen_id').val(did);
        $('#myModal').modal(options);
    }



</script>


<script>
    function createLoginScreenModal(){
        var options = {
            "backdrop" : "static"
        };
        $('#createModal').modal(options);
    }
	
    function createSinglePush(did){
        var options = {
            "backdrop" : "static"
        };
        $('#singlePush_popup').modal(options);
		setSinglePushParams(did)
    }
	
    function createMassPush(){
        var options = {
            "backdrop" : "static"
        };
        $('#massPush_popup').modal(options);
    }			

</script>
<script>

    function editLoginScreen(data){

        var options = {
            "backdrop" : "static"
        };
        data=JSON.parse(data);

        $('#GUID').val(data.GUID);
        $('#username').val(data.username);
        $('#message').val(data.message);
        $('#status').val(data.status);
        $('#createdDate').val(data.createdDate);
        $('#edit_loginscreen_id').val(data.ID);

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
        $( "[name='createdDate']" ).datetimepicker({format :'m/d/Y h:i A'});
    });
</script>