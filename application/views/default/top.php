<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">


	<link rel="stylesheet" type="text/css" href="./design/css/style.css">

	<script type="text/javascript" src="<?= PUBLIC_PATH;?>js/jquery/jquery.min.js"></script>
	
</head>
<body>
<?php

$url = "?k=eva+lovia";

	$a =  $this->fn->request_to_xvideos($url);

	echo $this->fn->get_random_video($a);
?>