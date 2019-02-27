<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM products where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
	<br/>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Reading Product</h3>
                    </div>
					<br/>

					<table class="table table-striped table-bordered">
						<tbody>
						  <tr>
							<td>Product Name</td>
							<td><?php echo $data['name'];?></td>
						  </tr>
						  <tr>
							<td>Product Price</td>
							<td><?php echo $data['price'];?></td>
						  </tr>
						  <tr>
							<td>Product Date</td>
							<td><?php echo $data['date'];?></td>
						  </tr>
						</tbody>
					</table>
					<div class="form-actions">
					  <a class="btn btn-info" href="index.php">Back</a>
				    </div>
                 
    </div> <!-- /container -->
  </body>
</html>