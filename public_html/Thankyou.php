<?php
$serverLink = 'https://'.$_SERVER['HTTP_HOST'];
$action = $_GET['action'];

?>
<html>
<head>
<link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"></script>

<style>
    
    html, body {
    height: 100%;
    width: 100%;
    margin: 0;
    padding: 0;
  background: #3f93b1;
}
*{ margin: 0;
    padding: 0;}
	.wrapper {
    position: relative;
    z-index: 2;
    height: 100%;
    width: 100%;
    display: table;
    vertical-align: middle; text-align:center;
}
.middle {
    display: table-cell;
    vertical-align: middle;
    padding: 10px 10px;
}
 .box.bg-white {
    max-width: 500px;
    text-align: left;
    margin: 0 auto;
    border-radius: 4px;    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    background: #fff;
    text-align: center;
    padding: 25px;
}

</style>
</head>

<div class="wrapper">
		<div class="middle">
<div class="box bg-white">
 
  <?php if($action=='invalid'){ ?>
<p class="lead"><strong> Your request to reset your password has expired or the link has already been used.</strong></p>
 <h1 class="display-6">Try resetting your password again.</h1>
  <?php }elseif($action=='true'){
?>
 <h1 class="display-6">Thank You!</h1>
 <p class="lead"><strong>Your password has been reset successfully</strong></p>
 
 <p class="lead">
    <a class="btn btn-primary btn-sm" href="<?= $serverLink ?>" role="button">Continue to homepage</a>
  </p>
<?php	  
  } ?>
</div>
</div>
</div>
  
</html>