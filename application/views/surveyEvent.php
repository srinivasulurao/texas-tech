<?php
$this->load->view('common/headerEvent');
$root=site_url();
?>
<div class="container" >
    <div class="row">
    <div class='col-lg-12' style="text-align:center;padding-top:10px">
        <img src='<?php echo $root."images/logo.png"; ?>' style="height:300px;height:130px">
    </div>
    </div>

<div class="row">
<div class='col-lg-4'></div>
<div class='col-lg-4'>
    <br><br>
    <?php if(!$message): ?>
    <form method="post" action="">
        <label>First Name</label>
        <input type="text" name="first_name" id="first_name" required="required" class="form-control">
        <label>Last Name</label>
        <input type="text" name="last_name" id="last_name" required="required" class="form-control">
        <label>Email</label>
        <input type="email" name="email" id="email" required="required" class="form-control">
        <label>Role</label>
        <select class="form-control" name="role" onchange="ifStudent(this.value)">
            <option value="">--SELECT ROLE--</option>
            <?php
            foreach($roles as $role):
            echo"<option value='{$role['status_id']}'>{$role['status_type']}</option>";
            endforeach;
            ?>
        </select>
        <div class="ifStudent" style="display:none">
        <label>Programs</label>
        <select name="program" id="program" class="form-control">
            <option value="">--Select Program--</option>
            <?php
            foreach($programs as $program):
                echo"<option value='{$program['ID']}'>{$program['Title']}</option>";
            endforeach;
            ?>
        </select>
        <label>Graduation MM</label>
        <select name="graduation_mm" id="graduation_mm" class="form-control">
            <option value="">--SELECT--</option>
            <option value="spring">Spring</option>
            <option value="summer">Summer</option>
            <option value="fall">Fall</option>
        </select>
        <label>Graduation YY</label>
        <select name="graduation_yy" id="graduation_yy" class="form-control">
            <option value="">--SELECT--</option>
            <?php
            for($i=1915;$i<=2015;$i++):
                echo"<option value='$i'>$i</option>";
            endfor;
            ?>
        </select>
        </div>
        <div style="text-align: center;margin-top:20px;">
        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
        <input type="submit" style='width:100%' class="btn btn-danger" name="storeSurvey" id="storeSurvey">
        </div>
    </form>
    <?php endif; ?>
    <?php if($message): ?>
    <?php echo "<div class='bg-$messageType' style='padding:20px;text-align: center;box-shadow: 0 0 10px inset;border-radius: 10px;'><h1>$message</h1></div>"; ?>
    <?php endif; ?>
    <br><br>
</div>
    <div class='col-lg-4'></div>
</div>

</div><!-- Container Ends here-->

<footer style="width:100%;text-align:center;">
<?php
$this->load->view('common/footer.php');
?>

</footer>

<style>
body{
font-family:lucida sans unicode;
font-size:13px;
}
    label{
        margin-top:10px;
    }
</style>

<script>
    function ifStudent(value){
    if(value==1) {
        $('.ifStudent').slideDown();
    }
    else{
        $('.ifStudent').slideUp();
    }

    }
</script>