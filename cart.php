<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
  $user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Your Cart</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<a href="indexx.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>

<a href="/come_back/sell.php" class="button" style = "margin-left: 8%;">Want to sell your own items?</a>
<a href="/come_back/index.html" class="button" style = "margin-left: 20%;">Homepage</a>
<a href="/come_back/cart.php" class="button" style = "margin-left: 30%;">Cart</a><br>
<?php 
include('server.php');
$result = mysqli_query($db,"SELECT id FROM users where username = '$user'");
while($row = mysqli_fetch_assoc($result))
{
	$userid = $row['id'];
}
$result = mysqli_query($db,"select productid from cart where userid = '$userid'");
$k = 0;
$ctr = 0;
while($rows = mysqli_fetch_array($result)){
	$k++; 
	//echo $rows['productid'];
	$temp = $rows['productid'];
	$res = mysqli_query($db,"select * from product where product_id = '$temp'");
	while($r = mysqli_fetch_assoc($res))
	{
		echo '<img src="data:image/jpeg;base64,'.base64_encode( $r['image'] ).'" width = "10%" height = "5%" style = "padding-left: 5%;padding-top: 5%"/>';
		$ctr += $r['price'];
	}
	$str = "/come_back/remove.php?id=";?>
	<a href = "<?php echo $str.$temp; ?>">Remove</a><?php
}
echo '<br><p style = "padding-left : 40%;padding-top:4%">Total items in your cart = ';
echo $k;
echo '<br><p style = "padding-left : 40%;">Total price = ';
echo $ctr;
echo "<br><a href = '#'>Checkout</a>";
?>
</body>
</html>