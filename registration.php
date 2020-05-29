<?php 
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
$statusMsg = $sessData['status']['msg'];
$statusMsgType = $sessData['status']['type'];
unset($_SESSION['sessData']['status']);
}
?>
<!DOCTYPE html>

<?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
<div class="regisFrm">









<form action="mainAcc.php" method="post">
<input type="text" name="first_name" placeholder="FIRST NAME" required="">
<input type="text" name="last_name" placeholder="Last name" required="">
<input type="email" name="email" placeholder="email" required="">
<input type="text" name="phone" placeholder="Phone" required="">
<input type="password" name="password" placeholder="Password" required="">
<input type="password" name="confirm_password" placeholder="Confirm Pass" required="">
<div class="send-button">
<input type="submit" name="signup1" value="Create my Acc">
</div>
</form>
</div>
</div>
</body>
</html>