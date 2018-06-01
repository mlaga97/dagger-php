<h3>New Assessments?</h3>

<label><input id="visit_type" type="radio" name="visit_type" value="initial" onclick="toggleDisplay('assessment_selection', true);sendFocus('assessment_selection');"/>Yes</label>
<label><input id="visit_type" type="radio" name="visit_type" value="brief" checked="checked" onclick="toggleDisplay('assessment_selection', false);clearFields('assessment_selection');"/>No</label>

<br/><br/>

<div id="assessment_selection" style="display: none;">
