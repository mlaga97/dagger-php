<?php if ($_SESSION['grouping']== 10){ echo '<div id="confirmation" style="display: none;">';} else {echo ' <div id="confirmation">';} ?>
	<center><h1>Information Confirmation</h1>
	<p>Please confirm the patient ID below. This input must match the patient ID entered in the personal information section above.</p></center>
	<table id="tblConfirmation">
		<tr>
		<td class="personal"><label for="c_p_id">Patient ID:</label></td><td class="personal"><input type="text" name="c_p_id" id="c_p_id"></td></tr>
		<tr><td></td><td></td></tr>
	</table>
</div><!-- end div  -->