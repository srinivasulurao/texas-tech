<?php
$this->load->view('common/header_login');
?>

<div class="login-box">
<form method="post" action="">

<input name="username" type='text' value='<?php echo $_COOKIE['username']; ?>' id="username" required="required" class="form-control" placeholder="Enter Username" autocomplete="off"><i class="glyphicon glyphicon-user"></i><br>
<input name="password" type='password' value='<?php echo $_COOKIE['password']; ?>' id="password" required="required" class="form-control" placeholder="Enter Password" autocomplete="off"><i class="glyphicon glyphicon-wrench"></i>
<span id='remember-me'><input <?php echo $_COOKIE['remember-me']; ?> type="checkbox" name="remember-me" id="remember-me" value="1"> &nbsp <font>Remember Me</font></span>
    <br><input type="submit" value="LOGIN" name="loginTexasTech" id="loginTexasTech" class="login-button">

</form>
</div>

<?php
$this->load->view('common/footer.php');
?>