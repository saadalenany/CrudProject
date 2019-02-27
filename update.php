<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $priceError = null;
        $dateError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $price = $_POST['price'];
        $date = $_POST['date'];
         
        // validate input
        $valid = true;
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter the Product Name';
            $valid = false;
        }
         
        if (empty($price)) {
            $priceError = 'Please enter the Product Price';
            $valid = false;
        }
         
        if (empty($date)) {
            $dateError = 'Please enter the Product Date';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE products  set name = ?, price = ?, date =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$price,$date,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM products where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['name'];
        $price = $data['price'];
        $date = $data['date'];
        Database::disconnect();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <link   href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
</head>
 
<body>
	<br/>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update a Product</h3>
                    </div>
					<br/>

                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Product Name</label>
                        <div class="form-group">
                            <input class="form-control" name="name" type="text"  placeholder="Product Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
                        <label class="control-label">Product Price</label>
                        <div class="form-group">
                            <input class="form-control" min="1" name="price" type="number" placeholder="Product Price" value="<?php echo !empty($price)?$price:'';?>">
                            <?php if (!empty($priceError)): ?>
                                <span class="help-inline"><?php echo $priceError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
                        <label class="control-label">Product Date</label>
                        <div class="form-group">
							<div class="input-group date form_datetime" data-date="1979-09-16T05:25:07Z" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="dtp_input1">
								<input name="date" type='text' placeholder="Product Date" class="form-control" value="<?php echo !empty($date)?$date:'';?>" />
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
							</div>
							<input type="hidden" id="dtp_input1" value="" /><br/>
                            <?php if (!empty($dateError)): ?>
                                <span class="help-inline"><?php echo $dateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  <br/>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn btn-info" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
		</div> <!-- /container -->

		<script type="text/javascript">
			$('.form_datetime').datetimepicker({
				//language:  'en',
				weekStart: 1,
				todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				forceParse: 0,
				showMeridian: 1
			});
		</script>

  </body>
</html>
