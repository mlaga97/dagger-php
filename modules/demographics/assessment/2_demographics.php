<?php if ($_SESSION['grouping'] != 10) { ?>

<!-- Gender -->
<h3>Gender</h3>

<label><input type="radio" name="demographics_gender" value="Male" required autofocus />Male</label><br/>
<label><input type="radio" name="demographics_gender" value="Female"/>Female</label><br/>
<label><input type="radio" name="demographics_gender" value="Transgender"/>Transgender</label><br/>
<label><input type="radio" name="demographics_gender" value="Other"/>Other</label><br/>
<label><input type="radio" name="demographics_gender" value="No Response"/><i>No Response</i></label><br/>

<br/><br/><hr/>

<!-- Ethnicity -->
<h3>Ethnicity</h3>

<label><input type="radio" name="demographics_ethnicity" value="White" required />White / Caucasian</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="Latino"/>Hispanic / Latino</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="Asian"/>Asian</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="Pacific Islander"/>Native Hawaiian / Pacific Islander</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="Middle Eastern"/>Middle Eastern</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="Black"/>Black</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="American Indian"/>American Indian</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="Other"/>Other</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="No Response" /><i>No Response</i></label><br/>

<br/><br/><hr/>

<!-- Marital Status -->
<!-- TODO: Check if age > 15 -->
<h3>Marital Status</h3>

<label><input type="radio" name="demographics_maritalStatus" value="Currently Married" required />Currently Married</label><br/>
<label><input type="radio" name="demographics_maritalStatus" value="Separated"/>Separated</label><br/>
<label><input type="radio" name="demographics_maritalStatus" value="Divorced"/>Divorced</label><br/>
<label><input type="radio" name="demographics_maritalStatus" value="Widowed"/>Widowed</label><br/>
<label><input type="radio" name="demographics_maritalStatus" value="Never Married"/>Never Married</label><br/>
<label><input type="radio" name="demographics_maritalStatus" value="No Response"/><i>No Response</i></label><br/>

<br/><br/><hr/>

<!-- Living Arrangements -->
<h3>Living Arrangements</h3>

<label><input type="radio" name="demographics_livingArrangements" value="with Parents" required />with Parents</label><br/>
<label><input type="radio" name="demographics_livingArrangements" value="with Family or Relatives"/>with Family or Relatives</label><br/>
<label><input type="radio" name="demographics_livingArrangements" value="with Friends"/>with Friends</label><br/>
<label><input type="radio" name="demographics_livingArrangements" value="Foster Care"/>Foster Care</label><br/>
<label><input type="radio" name="demographics_livingArrangements" value="Shelter"/>Shelter</label><br/>
<label><input type="radio" name="demographics_livingArrangements" value="Alone"/>Alone</label><br/>
<label><input type="radio" name="demographics_livingArrangements" value="No Response"/><i>No Response</i></label><br/>

<br/><br/><hr/>

<!-- Zip Code -->
<h3>Zip Code</h3>
<!-- Override form default autocomplete off for zip -->
<input type="text" id="dagger.module.demographics.demographics_zipCode" name="demographics_zipCode" maxlength="5" pattern="[0-9]{5}" placeholder="5-digit zip" autocomplete required />
<label><input type="checkbox" onchange="cb_noResponse(this, 'dagger.module.demographics.demographics_zipCode', 'dagger.module.demographics.demographics_zipCode_noResponse');" /><i>No Response</i></label>
<!-- hidden field for zip No Response, enabled/disabled by checkbox onchange event fxn call -->
<input type="hidden" id="dagger.module.demographics.demographics_zipCode_noResponse" name="demographics_zipCode" value="No Response" disabled />

<br/><br/><hr/>

<!-- Education -->
<!-- TODO: Single Field Possibly? -->
<!-- TODO: VALUES! -->
<h3>Education</h3>

<label><input type="radio" name="demographics_education" value="No School" onclick="toggleDisplay('dagger.module.demographics.highestGradeCompleted', false, false);clearFields('dagger.module.demographics.highestGradeCompleted');" required />No school</label><br/>
<label><input type="radio" name="demographics_education" value="Elementary or Junior High" onclick="toggleDisplay('dagger.module.demographics.highestGradeCompleted', true, true);sendFocus('dagger.module.demographics.demographics_highestGradeCompleted_1');"/>Elementary / Jr. High School</label><br/>
<label><input type="radio" name="demographics_education" value="Some High School" onclick="toggleDisplay('dagger.module.demographics.highestGradeCompleted', true, true);sendFocus('dagger.module.demographics.demographics_highestGradeCompleted_9');"/>Some High School</label><br/>
<label><input type="radio" name="demographics_education" value="Diploma or GED" onclick="toggleDisplay('dagger.module.demographics.highestGradeCompleted', false, false)clearFields('dagger.module.demographics.highestGradeCompleted');;"/>High School Diploma or GED</label><br/>
<label><input type="radio" name="demographics_education" value="Some College" onclick="toggleDisplay('dagger.module.demographics.highestGradeCompleted', false, false);clearFields('dagger.module.demographics.highestGradeCompleted');"/>Some College</label><br/>
<label><input type="radio" name="demographics_education" value="2-year Degree" onclick="toggleDisplay('dagger.module.demographics.highestGradeCompleted', false, false);clearFields('dagger.module.demographics.highestGradeCompleted');"/>2-year degree</label><br/>
<label><input type="radio" name="demographics_education" value="4-year Degree" onclick="toggleDisplay('dagger.module.demographics.highestGradeCompleted', false, false);clearFields('dagger.module.demographics.highestGradeCompleted');"/>4-year degree</label><br/>
<label><input type="radio" name="demographics_education" value="Higher Degree" onclick="toggleDisplay('dagger.module.demographics.highestGradeCompleted', false, false);clearFields('dagger.module.demographics.highestGradeCompleted');"/>More than 4 years college</label><br/>
<label><input type="radio" name="demographics_education" value="No Response" onclick="toggleDisplay('dagger.module.demographics.highestGradeCompleted', false, false);clearFields('dagger.module.demographics.highestGradeCompleted');"/><i>No Response</i></label><br/>

<div id='dagger.module.demographics.highestGradeCompleted' style='display: none;'>
	<br/>
	Highest Grade Completed<br/>
	<label><input type="radio" name="demographics_highestGradeCompleted" id="dagger.module.demographics.demographics_highestGradeCompleted_1" value="1">1</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="2">2</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="3">3</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="4">4</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="5">5</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="6">6</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="7">7</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="8">8</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" id="dagger.module.demographics.demographics_highestGradeCompleted_9" value="9">9</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="10">10</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="11">11</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="12">12</label>
</div>

<br/><br/><hr/>

<?php } ?>
