<?php
	// Do the other side of pediatric.php
	// TODO: Much of this could be moved into the bitmask library.
	if(array_key_exists('pediatric_check', $_SESSION) && $_SESSION['pediatric_check']) {
		$pediatric_bitmask_fields = array("HLS_FH_Diab", "HLS_FH_HBP", "HLS_FH_HD", "HLS_FH_Overwt");
		foreach($pediatric_bitmask_fields as $field_name) {
			$sum = 0;

			$sum += $_SESSION[$field_name . '-1'];
			$sum += $_SESSION[$field_name . '-2'];
			$sum += $_SESSION[$field_name . '-3'];
			$sum += $_SESSION[$field_name . '-4'];
			$sum += $_SESSION[$field_name . '-5'];
			$sum += $_SESSION[$field_name . '-6'];

			$_SESSION[$field_name] = $sum;
		}
	}
?>
