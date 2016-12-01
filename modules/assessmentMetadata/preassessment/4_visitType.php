<script>
	function show(rad, q) {
	    var rads = document.getElementsByName(rad.name);

	    document.getElementById(q).style.display = (rads[1].checked) ? 'none' : 'block';
	    document.getElementById(q).style.display = (rads[0].checked) ? 'block' : 'none';
	    document.getElementById(q).style.display = (rads[2].checked) ? 'none' : 'block';
	}
</script>

<table border="1" style='width: 800;' id="table_visit_type"><tr><td>
	<h3>Please select a visit type.</h3>

	<div title="Comprehensive visit to include MH/BH assessments">
		<label><input id="visit_type" type="radio" name="visit_type" value="initial" onclick="show(this,'assessment_selection');uncheck('initial')"/>Initial Visit</label>
	</div>

	<div title="A follow-up visit without assessments." >
		<label><input id="visit_type" type="radio" name="visit_type" value="follow-up" onclick="show(this,'assessment_selection');uncheck('followup')"/>Follow-up w/ assessment</label>
	</div> 

	<div title="A Brief follow-up visit without assessments." >
		<label><input id="visit_type" type="radio" name="visit_type" value="brief" onclick="show(this,'assessment_selection');uncheck('brief')"/>Follow-up w/o assessment</label>
	</div>

	<br>
</td></tr></table>

<br/>
