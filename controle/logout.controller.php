<?php
	session_start();
	$INDEX = $_SESSION["INDEX"];
	session_unset();
	session_destroy();
	header('Location: ' .$INDEX);
?>