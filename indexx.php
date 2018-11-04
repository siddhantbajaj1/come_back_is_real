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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  

	
</head>
<body>







<div class="header">
	<h2>MerchInstruo</h2>
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
<div style = "padding-top: 5%;">
<?php 

include('server.php');

$result = mysqli_query($db,"SELECT * FROM product");
while($rows = mysqli_fetch_array($result))
{
	//header("Content-type: image/jpg"); 
    //echo $rows['image'];
	echo '<img src="data:image/jpeg;base64,'.base64_encode( $rows['image'] ).'" width = "10%" height = "5%" style = "padding-left: 5%;"/>';
	//echo '<br>';
	echo 'Price = ';
	echo $rows['price'];
	if($rows['winner'] == 1){
		$cazz = "(WINNER)";
	}
	else
		$cazz = "";
	$temp = $rows['product_id'];
	$str = "/come_back/add_to_cart.php?id=";
	?>
	<a href = "<?php echo $str.$temp; ?>">Add to cart<?php echo $cazz ?></a>
	<?php
	?>

<?php }
?>
<br>
</div>

</body>
</html>