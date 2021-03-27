<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome</title>
</head>
<body>

<div id="container">
	<h1>Welcome <?php echo $this->session->userdata('user_type') ?></h1>
	<a href="<?php echo base_url('logout'); ?>">Logout</a>
</div>

</body>
</html>