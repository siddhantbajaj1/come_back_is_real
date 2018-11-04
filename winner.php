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
	<h2>Cart</h2>
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
<a href="/come_back/cart.php" class="button" style = "margin-left: 30%;">Cart</a>
<?php 
include('server.php');
$result = mysqli_query($db,"SELECT id FROM users where username = '$user'");
while($row = mysqli_fetch_assoc($result))
{
	$userid = $row['id'];
}
$productid = $_GET['id'];
if (isset($_POST['submit'])){
	$code = $_POST['code'];
	//echo $code;
	//echo $productid;
}
$result = mysqli_query($db,"SELECT * FROM code where verify = '$code'");
$rowcount=mysqli_num_rows($result);
if($rowcount > 0){
	$flag = 0;
	$arr = array();
	$res = mysqli_query($db,"Select * from product where winner = 1");
	while($rows = mysqli_fetch_array($res)){
		$tmp = $rows['product_id'];
		array_push($arr,$tmp);
	}
	$res = mysqli_query($db,"Select * from cart where userid = '$userid'");
	while($rows = mysqli_fetch_array($res)){
		$tmp = $rows['productid'];
		if(in_array($tmp,$arr))
			$flag = 1;
	}
	if($flag == 1)
		echo '<br><p style = "padding-left : 40%;padding-top : 4%;">You already have a winner\'s TShirt !!</p>';
	else{
		$result = mysqli_query($db,"INSERT INTO `cart` (`userid`, `productid`) VALUES ('$userid', '$productid')");
		if($result){
			echo '<br><p style = "padding-left : 40%;padding-top:4%">Added to cart !!</p>';
		}
	}
}
else{
	echo '<br><p style = "padding-left : 40%;padding-top : 4%;">Incorrect Verification code !!</p>';
}
?>
</body>
</html>