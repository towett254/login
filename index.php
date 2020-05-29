<?php error_reporting(E_ALL); ini_set('display_errors', '1');
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
$statusMsg = $sessData['status']['msg'];
$statusMsgType = $sessData['status']['type'];
unset($_SESSION['sessData']['status']);
}
?>
<!DOCTYPE html>

<?php
if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
include 'mainAcc.user.php';
$user = new User();
$conditions['where'] = array(
'id' => $sessData['userID'],
);
$conditions['return_type'] = 'single';
$userData = $user->getRows($conditions);
?>
<h2>Welcome <?php echo $userData['first_name']; ?>!</h2>
<a href="mainAcc.php?logout_me=1" class="logout">Logout</a>
<div class="regisFrm">
<p><b>Name: </b><?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
<p><b>Email: </b><?php echo $userData['email']; ?></p>
<p><b>Phone: </b><?php echo $userData['phone']; ?></p>
</div>
<?php }else{ ?>
<h2>Simple Login Logout</h2>
<?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
<div class="regisFrm">









<form action="mainAcc.php" method="post">
<input type="email" name="email" placeholder="EMAIL" required="">
<input type="password" name="password" placeholder="PASSWORD" required="">
<div class="send-button">
<input type="submit" name="login1" value="LOGIN">
</div>

</form>
<p>Don't have an account? <a href="registration.php">Register</a></p>
</div>
<?php } ?>
</div>
</body>
</html>