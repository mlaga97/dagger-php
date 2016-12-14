<div id="demo_data" <?php if ($_SESSION['grouping'] == 10) { echo 'style="display: none;"'; }?>>
	<h1><center>Demographic Data</center></h1>
	<center>Complete applicable information.</center>
	<table id="demo">
	<tr>
		<!-- Gender Identity -->
		<td>
			<table border="1" align="center" id="table_sex">
				<tr><th class="tdtopic" colspan="4">Gender</th></tr>
				<tr>
					<td class="sf">Male</td><td class="demo_input"><center><input type="radio" name="sex" value="male" <?php if($_SESSION['sex'] == 'male') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="sf">Female</td><td class="demo_input"><center><input type="radio" name="sex" value="female" <?php if($_SESSION['sex'] == 'female') { echo 'checked="checked"'; } ?>/></center></td>
				</tr>
				<tr>
					<td class="sf">Transgender</td><td class="demo_input"><center><input type="radio" name="sex" value="transgender" <?php if($_SESSION['sex'] == 'transgender') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="sf">Other</td><td class="demo_input"><center><input type="radio" name="sex" value="other" <?php if($_SESSION['sex'] == 'other') { echo 'checked="checked"'; } ?>/></center></td>
				</tr>
			</table>
		</td>

		<!-- Marital Status -->
		<?php if($_SESSION['assessment_type'] == 'Adult') { ?>
				<td>
					<table border="1" align="center" id="table_marital">
						<tr><th class="tdtopic" colspan="4">Marital Status</th></tr>
						<tr>
							<td class="ms">Single.</td><td class="demo_input"><center><input type="radio" name="m_status" value="single" <?php if($_SESSION['m_status'] == 'single') { echo 'checked="checked"'; } ?>/></center></td>
							<td class="ms">Married.</td><td class="demo_input"><center><input type="radio" name="m_status" value="married" <?php if($_SESSION['m_status'] == 'married') { echo 'checked="checked"'; } ?>/></center></td>
						</tr>
						<tr>
							<td class="ms">Divorced.</td><td class="demo_input"><center><input type="radio" name="m_status" value="divorced" <?php if($_SESSION['m_status'] == 'divorced') { echo 'checked="checked"'; } ?>/></center></td>
							<td class="ms">Widow(ed).</td><td class="demo_input"><center><input type="radio" name="m_status" value="widow(ed)" <?php if($_SESSION['m_status'] == 'widow(ed)') { echo 'checked="checked"'; } ?>/></center></td>
						</tr>
					</table>
				</td>
			</tr>
		<?php } ?>

		<!-- Education -->
		<table border="1" id="table_education">
			<?php if($_SESSION['assessment_type'] == 'Adult') { ?><tr><td colspan="2">
				<tr>
					<th class="tdtopic" colspan="4">Education</th>
				</tr>
				<tr>
					<td class="ed">Elementary/Jr. high school.</td>
					<td class="demo_input">
						<center><input type="radio" name="ed" value="Elementary/Jr. high school" <?php if($_SESSION['ed'] == 'Elementary/Jr. high school') { echo 'checked="checked"'; } ?>/></center>
					</td>
					<td class="ed">2-year degree.</td>
					<td class="demo_input">
						<center><input type="radio" name="ed" value="2-year degree" <?php if($_SESSION['ed'] == '2-year degree') { echo 'checked="checked"'; } ?>/></center>
					</td>
				</tr>
				<tr>
					<td class="ed">Some high school.</td><td class="demo_input"><center><input type="radio" name="ed" value="Some high school" <?php if($_SESSION['ed'] == 'Some high school') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="ed">4-year degree.</td><td class="demo_input"><center><input type="radio" name="ed" value="4-year degree" <?php if($_SESSION['ed'] == '4-year degree') { echo 'checked="checked"'; } ?>/></center></td>
				</tr>
				<tr>
					<td class="ed">High school diploma or GED.</td><td class="demo_input"><center><input type="radio" name="ed" value="High school diploma or GED" <?php if($_SESSION['ed'] == 'High school diploma or GED') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="ed">More than 4 years college.</td><td class="demo_input"><center><input type="radio" name="ed" value="More than 4 years college" <?php if($_SESSION['ed'] == 'More than 4 years college') { echo 'checked="checked"'; } ?>/></center></td>
				</tr>
				<tr>
					<td class="ed">Some college.</td><td class="demo_input"><center><input type="radio" name="ed" value="Some college" <?php if($_SESSION['ed'] == 'Some college') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="ed" border="0"></td><td></td>
				</tr>
			<?php } else { ?>
				<tr>
					<th class="tdtopic" colspan="24">Education: Highest grade completed</th>
				</tr>
				<tr>
					<td class="c_ed" align="right">1</td><td class="demo_input"><center><input type="radio" name="ed" value="1" <?php if($_SESSION['ed'] == '1') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="c_ed" align="right">2</td><td class="demo_input"><center><input type="radio" name="ed" value="2" <?php if($_SESSION['ed'] == '2') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="c_ed" align="right">3</td><td class="demo_input"><center><input type="radio" name="ed" value="3" <?php if($_SESSION['ed'] == '3') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="c_ed" align="right">4</td><td class="demo_input"><center><input type="radio" name="ed" value="4" <?php if($_SESSION['ed'] == '4') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="c_ed" align="right">5</td><td class="demo_input"><center><input type="radio" name="ed" value="5" <?php if($_SESSION['ed'] == '5') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="c_ed" align="right">6</td><td class="demo_input"><center><input type="radio" name="ed" value="6" <?php if($_SESSION['ed'] == '6') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="c_ed" align="right">7</td><td class="demo_input"><center><input type="radio" name="ed" value="7" <?php if($_SESSION['ed'] == '7') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="c_ed" align="right">8</td><td class="demo_input"><center><input type="radio" name="ed" value="8" <?php if($_SESSION['ed'] == '8') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="c_ed" align="right">9</td><td class="demo_input"><center><input type="radio" name="ed" value="9" <?php if($_SESSION['ed'] == '9') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="c_ed" align="right">10</td><td class="demo_input"><center><input type="radio" name="ed" value="10" <?php if($_SESSION['ed'] == '10') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="c_ed" align="right">11</td><td class="demo_input"><center><input type="radio" name="ed" value="11" <?php if($_SESSION['ed'] == '11') { echo 'checked="checked"'; } ?>/></center></td>
					<td class="c_ed" align="right">12</td><td class="demo_input"><center><input type="radio" name="ed" value="12" <?php if($_SESSION['ed'] == '12') { echo 'checked="checked"'; } ?>/></center></td>
				</tr>
			<?php } ?>
		</table>
		</td></tr>

		<!-- Birth Order -->
		<?php if($_SESSION['assessment_type'] == 'Child') { ?>
			<tr>
				<td colspan="2">
					<table border="1" id="table_birth_order">
						<tr><th class="tdtopic" colspan="8">Birth Order</th></tr>
						<tr>
							<td class="bo">Oldest. </td>
							<td class="demo_input">
								<center><input type="radio" name="c_bo" value="Oldest" <?php if($_SESSION['c_bo'] == 'Oldest') { echo 'checked="checked"'; } ?>/></center>
							</td>
							<td class="bo">Youngest. </td>
							<td class="demo_input">
								<center><input type="radio" name="c_bo" value="Youngest" <?php if($_SESSION['c_bo'] == 'Youngest') { echo 'checked="checked"'; } ?>/></center>
							</td>
							<td class="bo">Middle. </td>
							<td class="demo_input">
								<center><input type="radio" name="c_bo" value="Middle" <?php if($_SESSION['c_bo'] == 'Middle') { echo 'checked="checked"'; } ?>/></center>
							</td>
							<td class="bo">Twin. </td>
							<td class="demo_input">
								<center><input type="radio" name="c_bo" value="Twin" <?php if($_SESSION['c_bo'] == 'Twin') { echo 'checked="checked"'; } ?>/></center>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<?php } ?>

		<!-- Ethnicity -->
		<tr><td colspan="2">
		<table border="1" id="table_ethnicity">
		<tr><th class="tdtopic" colspan="6">Ethnicity</th></tr>
		<tr><td class="eth">White/Caucasian.</td><td class="demo_input"><center><input type="radio" name="eth" value="White/Caucasian" <?php if($_SESSION['eth'] == 'White/Caucasian') { echo 'checked="checked"'; } ?>/></center></td>
		<td class="eth">Native Hawaiian/Pacific Islander.</td><td class="demo_input"><center><input type="radio" name="eth" value="Native Hawaiian/Pacific Islander" <?php if($_SESSION['eth'] == 'Native Hawaiian/Pacific Islander') { echo 'checked="checked"'; } ?>/></center></td>
		<td class="eth">Black/African-American.</td><td class="demo_input"><center><input type="radio" name="eth" value="Black/African-American" <?php if($_SESSION['eth'] == 'Black/African-American') { echo 'checked="checked"'; } ?>/></center></td></tr>
		<tr><td class="eth">Hispanic/Latino.</td><td class="demo_input"><center><input type="radio" name="eth" value="Hispanic/Latino" <?php if($_SESSION['eth'] == 'Hispanic/Latino') { echo 'checked="checked"'; } ?>/></center></td>
		<td class="eth">Middle Eastern.</td><td class="demo_input"><center><input type="radio" name="eth" value="Middle Eastern" <?php if($_SESSION['eth'] == 'Middle Eastern') { echo 'checked="checked"'; } ?>/></center></td>
		<td class="eth">American Indian.</td><td class="demo_input"><center><input type="radio" name="eth" value="American Indian" <?php if($_SESSION['eth'] == 'American Indian') { echo 'checked="checked"'; } ?>/></center></td></tr>
		<tr><td class="eth">Asian.</td><td class="demo_input"><center><input type="radio" name="eth" value="Asian" <?php if($_SESSION['eth'] == 'Asian') { echo 'checked="checked"'; } ?>/></center></td>
		<td class="eth">Vietnamese.</td><td class="demo_input"><center><input type="radio" name="eth" value="Vietnamese" <?php if($_SESSION['eth'] == 'Vietnamese') { echo 'checked="checked"'; } ?>/></center></td>
		<td>Other.</td><td class="demo_input"><center><input type="radio" name="eth" value="Other" <?php if($_SESSION['eth'] == 'Other') { echo 'checked="checked"'; } ?>/></center></td></tr>
		</table>
		</td></tr>

		<!-- Living Arrangements -->
		<?php if($_SESSION['assessment_type'] == 'Adult') { ?>
			<tr><td colspan="2">
			<table border="1" id="table_living">
			<tr><th class="tdtopic" colspan="6">Living Arrangements</th></tr>
			<tr><td class="liv">Alone.</td><td class="demo_input"><center><input type="radio" name="living" value="Alone" <?php if($_SESSION['living'] == 'Alone') { echo 'checked="checked"'; } ?>/></center></td>
			<td class="liv">With Family/Relatives.</td><td class="demo_input"><center><input type="radio" name="living" value="With Family/Relatives" <?php if($_SESSION['living'] == 'With Family/Relatives') { echo 'checked="checked"'; } ?>/></center></td>
			<td class="liv">With Friends.</td><td class="demo_input"><center><input type="radio" name="living" value="With Friends" <?php if($_SESSION['living'] == 'With Friends') { echo 'checked="checked"'; } ?>/></center></td></tr>
			</table>
			</td></tr>
		<?php } else { ?>
			<tr><td colspan="2">
			<table border="1" id="table_living">
			<tr><th class="tdtopic" colspan="8">Living Arrangements</th></tr>
			<tr><td class="c_liv">With Parents</td><td class="demo_input"><center><input type="radio" name="living" value="With Parents" <?php if($_SESSION['living'] == 'With Parents') { echo 'checked="checked"'; } ?>/></center></td>
			<td class="c_liv">With Family/Friend.</td><td class="demo_input"><center><input type="radio" name="living" value="With Family/Friend" <?php if($_SESSION['living'] == 'With Family/Friend') { echo 'checked="checked"'; } ?>/></center></td>
			<td class="c_liv">Foster Care.</td><td class="demo_input"><center><input type="radio" name="living" value="Foster Care" <?php if($_SESSION['living'] == 'Foster Care') { echo 'checked="checked"'; } ?>/></center></td>
			<td class="c_liv">Shelter.</td><td class="demo_input"><center><input type="radio" name="living" value="Shelter" <?php if($_SESSION['living'] == 'Shelter') { echo 'checked="checked"'; } ?>/></center></td>
			</tr>
			</table>
			</td></tr>
		<?php } ?>

		<!-- Programs -->
		<!-- Behavioural Health -->
		<!-- System Involvement -->
		<!-- Community Connections -->
		<tr><td colspan="2">
		<table border="1" id="table_program">
		<tr><th class="tdtopic" colspan="6">Programs</th></tr>
		<tr><td class="pro">Homeless</td><td class="demo_input"><center><input type="checkbox" name="homeless" value="1" <?php if($_SESSION['homeless'] == '1') { echo 'checked="checked"'; } ?>/></center></td>
		<td class="pro">Chronic Care</td><td class="demo_input"><center><input type="checkbox" name="chronic_care" value="1" <?php if($_SESSION['chronic_care'] == '1') { echo 'checked="checked"'; } ?>/></center></td>
		<tr><td class="pro">Hepatitis C</td><td class="demo_input"><center><input type="checkbox" name="hep_c" value="1" <?php if($_SESSION['hep_c'] == '1') { echo 'checked="checked"'; } ?>/></center></td>
		<td class="pro">Ryan White</td><td class="demo_input"><center><input type="checkbox" name="ryan_white" value="1" <?php if($_SESSION['ryan_white'] == '1') { echo 'checked="checked"'; } ?>/></center></td>
		<tr><td class="pro">Care Team</td><td class="demo_input"><center><input type="checkbox" name="care_team" value="1" <?php if($_SESSION['care_team'] == '1') { echo 'checked="checked"'; } ?>/></center></td><td><td>
		</tr>
		<tr><th class="tdtopic" colspan="6">Clinic Care</th></tr>
		<td class="pro">Brief</td><td class="demo_input"><center><input type="radio" name="clinic_care" value="1" <?php if($_SESSION['clinic_care'] == '1') { echo 'checked="checked"'; } ?>/></center></td>
		<td class="pro">Ongoing</td><td class="demo_input"><center><input type="radio" name="clinic_care" value="2" <?php if($_SESSION['clinic_care'] == '2') { echo 'checked="checked"'; } ?>/></center></td>
		</tr>
		<tr><th class="tdtopic" colspan="6">Behavioral Health</th></tr>
		<td class="pro"> w/ handoff</td><td class="demo_input"><center><input type="radio" name="bh_care" value="w handoff" <?php if($_SESSION['bh_care'] == 'w handoff') { echo 'checked="checked"'; } ?>/></center></td>
		<td class="pro"> w/o handoff</td><td class="demo_input"><center><input type="radio" name="bh_care" value="wo handoff" <?php if($_SESSION['bh_care'] == 'wo handoff') { echo 'checked="checked"'; } ?>/></center></td>
		</tr>
		</table>
		</td></tr>
		<table border="1" id="table_program">
		<tr><th class="tdtopic" colspan="6">System Involvement</th></tr><tr>
		<td class="eth">Singing River Svcs</td><td class="demo_input"><center><input type="checkbox" name="system_involvement_singing_river" value="1" <?php if($_SESSION['system_involvement_singing_river'] == '1') { echo 'checked="checked"'; } ?>/></center></td>
		<td class="eth">Gulf Coast MH</td><td class="demo_input"><center><input type="checkbox" name="system_involvement_gulf_coast" value="1" <?php if($_SESSION['system_involvement_gulf_coast'] == '1') { echo 'checked="checked"'; } ?>/></center></td>
		<td class="eth">Memorial Beh. Health</td><td class="demo_input"><center><input type="checkbox" name="system_involvement_memorial" value="1" <?php if($_SESSION['system_involvement_memorial'] == '1') { echo 'checked="checked"'; } ?>/></center></td></tr>
		</table>
		</td></tr>
		<tr><td colspan="2">
		<table border="1" id="table_program">
		<tr><th class="tdtopic" colspan="6">Community Connections</th></tr><tr>
		<td class="community_connections">Harrison</td><td class="demo_input"><center><input type="radio" name="community_connections" value="Harrison" <?php if($_SESSION['community_connections'] == 'Harrison') { echo 'checked="checked"'; } ?>/></center></td>
		<td class="community_connections">Hancock</td><td class="demo_input"><center><input type="radio" name="community_connections" value="Hancock" <?php if($_SESSION['community_connections'] == 'Hancock') { echo 'checked="checked"'; } ?>/></center></td>
		<td class="community_connections">Jackson</td><td class="demo_input"><center><input type="radio" name="community_connections" value="Jackson" <?php if($_SESSION['community_connections'] == 'Jackson') { echo 'checked="checked"'; } ?>/></center></td></tr>
		</table>
		</td></tr>
		</td></tr>
	</table>
</div>

<br/>
