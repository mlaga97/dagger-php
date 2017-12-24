<?php
	$_SESSION['stress_check'] = 0;
	$_SESSION['c_stress_check'] = 0;
	$_SESSION['pp_check'] = 0;
	$_SESSION['health_check'] = 0;
	$_SESSION['diagnosis_check'] = 0;
	$_SESSION['diag_me_check'] = 0;

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
			<div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
				<label><input id=\"stress_check\" input type=\"checkbox\" name=\"stress_check\" value=\"1\" />Stress</label>
			</div>
			<div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
				<label><input id=\"c_stress_check\" input type=\"checkbox\" name=\"c_stress_check\" value=\"1\" />Child Stressors</label>
			</div>
			<div title=\"This section contains questions pertaining to the client's presenting problem.\">
				<label><input id=\"pp_check\" input type=\"checkbox\" name=\"pp_check\" value=\"1\" />Presenting Problem</label>
			</div>
			<div title=\"This section contains questions pertaining to the client's past and/or current medical diagnoses.\">
				<label><input id=\"diagnosis_check\" input type=\"checkbox\" name=\"diagnosis_check\" value=\"1\" />Diagnosis</label>
			</div>
			<div title=\"This section contains questions pertaining to the client's past and/or current MH diagnoses.\">
				<label><input id=\"diag_me_check\" input type=\"checkbox\" name=\"diag_me_check\" value=\"1\" />MH Diagnosis</label>
			</div>
			<div title=\"This section asks questions about the client's current health situation.\">
				<label><input id=\"health_check\" input type=\"checkbox\" name=\"health_check\" value=\"1\" />Health</label>
			</div>
		";
	} else if ($_SESSION['grouping'] == 2 || $_SESSION['grouping'] == 10) { //grouping = 2 is for the MS GRHOP
		echo "
					<h3>Mental Health</h3>

					<div class=\"childonly\" title=\"This section contains questions pertaining to the client's presenting problem.\">
						<label><input id=\"pp_check\" input type=\"checkbox\" name=\"pp_check\" value=\"1\" />Presenting Problem</label>
					</div>

					<!-- Adult and Child -->
					<div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
						<label><input id=\"stress_check\" input type=\"checkbox\" name=\"stress_check\" value=\"1\" />Stress</label>
					</div>

					<div class=\"adultonly\"  title=\"This section contains questions pertaining to the client's past and/or current MH diagnoses.\">
						<label><input id=\"diag_me_check\" input type=\"checkbox\" name=\"diag_me_check\" value=\"1\" />MH Diagnosis</label>
					</div>


					<h3>Health</h3>

					<!-- health_check -->
					<!-- Adult and Child -->
					<div title=\"This section asks questions about the client's current health situation.\">
						<label><input id=\"health_check\" input type=\"checkbox\" name=\"health_check\" value=\"1\" />Health</label>
					</div>

					<!-- diagnosis_check -->
					<div class=\"adultonly\" title=\"This section contains questions pertaining to the client's past and/or current medical diagnoses.\">
						<label><input id=\"diagnosis_check\" input type=\"checkbox\" name=\"diagnosis_check\" value=\"1\" />Diagnosis</label>
					</div>
		";
	} else if ($_SESSION['grouping'] == 6) { //grouping = 6 is for the MS GRHOP non social work students
		echo "
			<div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
				<label><input id=\"stress_check\" input type=\"checkbox\" name=\"stress_check\" value=\"1\" />Stress</label>
			</div>
			<div title=\"This section contains questions pertaining to the client's past and/or current medical diagnoses.\">
				<label><input id=\"diagnosis_check\" input type=\"checkbox\" name=\"diagnosis_check\" value=\"1\" />Diagnosis</label>
			</div>
			<div title=\"This section contains questions pertaining to the client's past and/or current MH diagnoses.\">
				<label><input id=\"diag_me_check\" input type=\"checkbox\" name=\"diag_me_check\" value=\"1\" />MH Diagnosis</label>
			</div>
		";
	} else { //default is everything
		echo "
			<div title=\"This section contains questions pertaining to the client's current stress level and specific stressors.\">
				<label><input id=\"stress_check\" input type=\"checkbox\" name=\"stress_check\" value=\"1\" />Stress</label>
			</div>
			<div title=\"This section contains questions pertaining to the client's past and/or current medical diagnoses.\">
				<label><input id=\"diagnosis_check\" input type=\"checkbox\" name=\"diagnosis_check\" value=\"1\" />Diagnosis</label>
			</div>
			<div title=\"This section contains questions pertaining to the client's past and/or current MH diagnoses.\">
				<label><input id=\"diag_me_check\" input type=\"checkbox\" name=\"diag_me_check\" value=\"1\" />MH Diagnosis</label>
			</div>
			<div title=\"This section asks questions about the client's current health situation.\">
				<label><input id=\"health_check\" input type=\"checkbox\" name=\"health_check\" value=\"1\" />Health</label>
			</div>
		";
	}
?>
