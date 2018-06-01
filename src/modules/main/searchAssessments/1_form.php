<br/><br/>

<form id="form1" method="post" action="" <?php if(!$_SESSION['debug']) echo 'autocomplete="off"'?>>
	<label for="pt_id">Patient ID <input type="text"
			autofocus="autofocus" name="pt_id" /></label>
	<button action="/searchResponses.php" >Search</button>
</form>
