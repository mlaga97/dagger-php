<br/><br/>

<form id="form2" action="/viewAssessment.php" method="post" target="_blank">

	<script type="text/javascript">
		function search_select(form2) {
			alert("Please enter a patient ID.");

			var checked = false;
			var radios = document.getElementsByName("search_select");
			for (var i = 0, radio; radio = radios[i]; i++) {
				if (radio.checked) {
					checked = true;
					document.getElementById("form2").submit();
				} else {
					alert("Please select an assessment to view.");
					return false;
				}
			}
		}

		function search_select_contact(form4) {
			alert("Please enter a patient ID.");

			var checked = false;
			var radios = document.getElementsByName("search_select_contact");
			for (var i = 0, radio; radio = radios[i]; i++) {
				if (radio.checked) {
					checked = true;
					document.getElementById("form4").submit();
				} else {
					alert("Please select an contact to view.");
					return false;
				}
			}
		}
	</script>