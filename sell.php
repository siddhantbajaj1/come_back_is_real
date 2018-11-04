<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Sell Tshirt</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Sell your own item</h2>
  </div>
	
  <form method="post" action="/come_back/sold.php" enctype="multipart/form-data">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
	<label>Upload file</label>
	<input type="file" name="image"/>
	</div>
	<div class="input-group">
	<label>Price</label>
	<input type = "number" name = "price"/>
	</div>
  	<div class="input-group">
  	  <input type="submit" class="btn" name="submit" value = "UPLOAD"/>
  	</div>

  </form>
</body>
</html>