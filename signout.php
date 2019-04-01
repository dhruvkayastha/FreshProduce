<?php
	if (isset($_COOKIE['user_id'])) {
    	unset($_COOKIE['user_id']);
	}
	header('Location: index.php');
?>