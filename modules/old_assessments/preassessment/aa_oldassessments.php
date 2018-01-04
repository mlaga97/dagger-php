<?php
	$_SESSION['pp_check'] = 0;

	// Current Grouping is as follows:
	// 1. is for MS test accounts.
	// 2. is for the MS GRHOP
	// 3. is for AL test account.
	// 4. is for FL test account.
	// 5. is for LA test account.
	// 6. is for FNP
	// 7. is for Student Life Success Program.
	//******This needs to be moved into the database.*********//
	//The various menus should be customized and read from the database and displayed based upon how the user logs in.

	if ($_SESSION['grouping'] == 1) { //groupong = 1 is for test accounts.
		echo "
			<div title=\"This section contains questions pertaining to the client's presenting problem.\">
				<label><input id=\"pp_check\" input type=\"checkbox\" name=\"pp_check\" value=\"1\" />Presenting Problem</label>
			</div>
		";
	} else if ($_SESSION['grouping'] == 2 || $_SESSION['grouping'] == 10) { //grouping = 2 is for the MS GRHOP
		echo "
					<div class=\"childonly\" title=\"This section contains questions pertaining to the client's presenting problem.\">
						<label><input id=\"pp_check\" input type=\"checkbox\" name=\"pp_check\" value=\"1\" />Presenting Problem</label>
					</div>
		";
	}
?>
