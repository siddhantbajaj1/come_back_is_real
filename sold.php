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
<?php 

if (isset($_POST['submit'])) {
	$image = $_FILES['image']['tmp_name'];
	$imgContent = addslashes(file_get_contents($image));
	$dbHost     = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName     = 'come_back';
	$a = $_POST['price'];
	$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
	if($db->connect_error){
        die("Connection failed: " . $db->connect_error);
    }
	$insert = $db->query("INSERT INTO `product` (`product_id`, `price`, `verified`, `winner`, `image`) VALUES (NULL, '$a', '0', '0', '$imgContent')");
	if($insert){
        echo '<br><p style = "padding-left : 40%;padding-top : 4%;">File uploaded successfully !!</p>';
    }else{
        echo "File upload failed, please try again.";
    } 
}
?>
</body>
</html>