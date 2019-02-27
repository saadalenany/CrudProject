<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
	<br/>
    <div class="container">
            <div class="row">
                <h3>Products CRUD</h3>
            </div>
			<br/>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success">Create New Product</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Product Price</th>
                      <th>Product Date</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM products ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['name'] . '</td>';
                            echo '<td>'. $row['price'] . '</td>';
                            echo '<td>'. $row['date'] . '</td>';
							echo '<td width=250>';
							echo '<a class="btn btn-info" href="read.php?id='.$row['id'].'">Read</a>';
							echo ' ';
							echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
							echo ' ';
							echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
							echo '</td>';
							echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
				</table>
			</div>
		</div> <!-- /container -->
	</body>
</html>
