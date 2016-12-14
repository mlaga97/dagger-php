<?php
	if($_SESSION['grouping']== 10) {
		echo '<div id="personal" style="display: none;">';
	} else {
		echo ' <div id="personal">';
	}
?>

	<h1 style="align: center;">Personal Information</h1>
	<table id="tblPersonal">
		<tr>
			<td class="personal">
				<label for="first_name">First Name:</label>
			</td>
			<td class="personal">
				<input type="text" autofocus="autofocus" name="first_name">
			</td>

			<td class="personal">
				<label for="last_name">Last Name:</label>
			</td>
			<td class="personal">
				<input type="text" name="last_name">
			</td>
		</tr>
		<tr>
			<td class="personal">
				<label for="p_id">Patient ID:</label>
			</td>
			<td class="personal">
				<input id="pid" type="text" name="pt_id">
			</td>

			<td class="personal">
				<label for="assessment_date">Date of Assessment:</label>
			</td>
			<td class="personal">
				<input id ="assessment_date" name = "assessment_date" type="date" placeholder="">
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>MM/DD/YYYY</td>
		</tr>
		<tr>
			<td class="personal">
				<label for="dob">Date of birth:</label>
			</td>
			<td class="personal">
				<input id="dob" type="date" name="dob">
			</td>

			<td class="personal">
				<label for="zip">Zip:</label>
			</td>
			<td class="personal">
				<input id="zip" type="text" name="zip">
			</td>
		</tr>		
	</table>
</div>

<br/><br/>