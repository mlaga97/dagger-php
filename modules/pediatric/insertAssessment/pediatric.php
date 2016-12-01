<?php
if($_SESSION['pediatric_check']) {
	$pediatric_bitmask_fields = array("HLS_FH_Diab", "HLS_FH_HBP", "HLS_FH_HD", "HLS_FH_Overwt");
	foreach($pediatric_bitmask_fields as $field_name) {
		unset($_SESSION[$field_name . '-1']);
		unset($_SESSION[$field_name . '-2']);
		unset($_SESSION[$field_name . '-3']);
		unset($_SESSION[$field_name . '-4']);
		unset($_SESSION[$field_name . '-5']);
		unset($_SESSION[$field_name . '-6']);
	}
}
?>
