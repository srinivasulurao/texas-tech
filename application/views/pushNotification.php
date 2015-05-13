<?php
$this->load->view('common/header');
?>
<?php
//debug($results);
?>
<div class="col-md-10">

    <h2 class="modal-title" id="exampleModalLabel">Send Push Notification</h2>

<form method="post" action="" enctype="multipart/form-data" >

        <div class="modal-body">
            <label>Status</label>
            <select class="form-control" required="" name="status_id" id="status_id">
                <option value="">--SELECT--</option>
                <?php
                foreach($statusTypes as $key):
                    echo"<option value='{$key['status_id']}'>{$key['status_type']}</option>";
                endforeach;
                ?>
            </select><br>

            <label>Push Message</label>
            <textarea name="message" class='form-control' id="message" required cols="40" rows="5" ></textarea>

        </div>

        <div class="modal-footer">
            <input type="submit" class="btn btn-danger" name="sendPushNotification"  value="Push Notification" />
        </div>
</form>

    </div>

