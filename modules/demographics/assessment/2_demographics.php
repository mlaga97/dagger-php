<?php if ($_SESSION['grouping'] != 10) { ?>

<!-- Gender -->
<h3>Gender</h3>

<label><input type="radio" name="demographics_gender" value="male"/>Male</label><br/>
<label><input type="radio" name="demographics_gender" value="female"/>Female</label><br/>
<label><input type="radio" name="demographics_gender" value="transgender"/>Transgender</label><br/>
<label><input type="radio" name="demographics_gender" value="other"/>Other</label><br/>

<br/><br/><hr/>

<!-- Ethnicity -->
<h3>Ethnicity</h3>

<label><input type="radio" name="demographics_ethnicity" value="white"/>White / Caucasian</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="latino"/>Hispanic / Latino</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="asian"/>Asian</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="pacific islander"/>Native Hawaiian / Pacific Islander</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="middle eastern"/>Middle Eastern</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="black"/>Black</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="american indian"/>American Indian</label><br/>
<label><input type="radio" name="demographics_ethnicity" value="other"/>Other</label><br/>

<br/><br/><hr/>

<!-- Marital Status -->
<!-- TODO: Check if age > 15 -->
<h3>Marital Status</h3>

<label><input type="radio" name="demographics_maritalStatus" value="currently married"/>Currently Married</label><br/>
<label><input type="radio" name="demographics_maritalStatus" value="separated"/>Separated</label><br/>
<label><input type="radio" name="demographics_maritalStatus" value="divorced"/>Divorced</label><br/>
<label><input type="radio" name="demographics_maritalStatus" value="widowed"/>Widowed</label><br/>
<label><input type="radio" name="demographics_maritalStatus" value="never married"/>Never Married</label><br/>

<br/><br/><hr/>

<!-- Living Arrangements -->
<h3>Living Arrangements</h3>

<label><input type="radio" name="demographics_maritalStatus" value="parents"/>with Parents</label><br/>
<label><input type="radio" name="demographics_maritalStatus" value="family"/>with Family / Relatives</label><br/>
<label><input type="radio" name="demographics_maritalStatus" value="friends"/>with Friends</label><br/>
<label><input type="radio" name="demographics_maritalStatus" value="foster"/>Foster Care</label><br/>
<label><input type="radio" name="demographics_maritalStatus" value="shelter"/>Shelter</label><br/>
<label><input type="radio" name="demographics_maritalStatus" value="alone"/>Alone</label><br/>

<br/><br/><hr/>

<!-- Zip Code -->
<h3>Zip Code</h3>
<label><input type="text" name="demographics_zipCode"/></label>

<br/><br/><hr/>

<!-- Education -->
<!-- TODO: Single Field Possibly? -->
<!-- TODO: VALUES! -->
<h3>Education</h3>

<label><input type="radio" name="demographics_education" value="no school" onclick="document.getElementById('edu.usm.dagger.module.demographics.highestGradeCompleted').style.display = 'none';"/>No school</label><br/>
<label><input type="radio" name="demographics_education" value="elementary or junior high" onclick="document.getElementById('edu.usm.dagger.module.demographics.highestGradeCompleted').style.display = 'block';"/>Elementary / Jr. High School</label><br/>
<label><input type="radio" name="demographics_education" value="some high school" onclick="document.getElementById('edu.usm.dagger.module.demographics.highestGradeCompleted').style.display = 'block';"/>Some High School</label><br/>
<label><input type="radio" name="demographics_education" value="diploma or GED" onclick="document.getElementById('edu.usm.dagger.module.demographics.highestGradeCompleted').style.display = 'none';"/>High School Diploma or GED</label><br/>
<label><input type="radio" name="demographics_education" value="some college" onclick="document.getElementById('edu.usm.dagger.module.demographics.highestGradeCompleted').style.display = 'none';"/>Some College</label><br/>
<label><input type="radio" name="demographics_education" value="2-year degree" onclick="document.getElementById('edu.usm.dagger.module.demographics.highestGradeCompleted').style.display = 'none';"/>2-year degree</label><br/>
<label><input type="radio" name="demographics_education" value="4-year degree" onclick="document.getElementById('edu.usm.dagger.module.demographics.highestGradeCompleted').style.display = 'none';"/>4-year degree</label><br/>
<label><input type="radio" name="demographics_education" value="higher degree" onclick="document.getElementById('edu.usm.dagger.module.demographics.highestGradeCompleted').style.display = 'none';"/>More than 4 years college</label><br/>

<div id='edu.usm.dagger.module.demographics.highestGradeCompleted' style='display: none;'>
	<br/>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="1">1</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="2">2</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="3">3</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="4">4</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="5">5</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="6">6</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="7">7</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="8">8</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="9">9</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="10">10</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="11">11</label>
	<label><input type="radio" name="demographics_highestGradeCompleted" value="12">12</label>
</div>

<br/><br/><hr/>

<?php } ?>
