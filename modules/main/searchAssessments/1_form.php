<br/><br/>

<form id="form1" method="post" action="">
	<h4>Please enter the patient ID here to search by.</h4>
	<i>Please note that if there is no record of the patient by ID,</i><br>
	<i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;then
	nothing will be returned.</i><br> <br>
	<!--%nbsp; provides a single space.-->
	<label for="pt_id">Patient ID:</label> <input type="text"
			autofocus="autofocus" name="pt_id" />
	<button action="/searchResponses.php" style="height: 25px; width: 100px">Search</button>
</form>
