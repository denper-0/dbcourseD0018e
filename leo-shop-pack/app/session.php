<?php
//5 minutes session.
if (!isset($_SESSION['sessionTime'])) {
	$_SESSION['sessionTime'] = time();
	$_SESSION['loginTime'] = time();
	}
	$time = time();
	

	//new sessionID, empty Cart.
	if ($_SESSION['sessionTime'] + 60*5 < $time) {
		$sessionID = session_id();
		$query = $db->prepare("SELECT cartID FROM cart WHERE cartID = '$sessionID'");
		$query->execute();
		$row = $query->rowCount();

		if ($row != 0) {
			$query = $db->prepare("DELETE FROM cart WHERE cartID = '$sessionID'");
			$query->execute();
		
		}
		session_unset();
		session_destroy();
		session_regenerate_id();
	}


	if ($_SESSION['loginTime'] + 60 < $time) {
		header('Location: logout.html');
	}
?>