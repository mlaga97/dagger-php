<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>

	<head>
		<title>
			Brief Adolescent Assessment
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Brief Adolescent Assessment">
		<link rel="stylesheet" href="mystyle.css" type="text/css">
	</head>
	<script type="text/javascript">

	function clearForm()
	{	
		document.getElementById('form1').reset();
	}
	</script>
	<body onload="clearForm();"><form id="form1" action="submit.php" method="post" >
		<div id="container">
			<div id="top">
				<div id="logo">
					<a href="https://www.usm.edu/social-work"><img src="images/swk.png" style="border:none;max-width:100%;" width="150" alt="University of Southern Mississippi, School of Social Work"></a>
				</div><!-- div logo end -->
				<div id="header">
					<div id="title">
						<center>
							<h1>Brief Adolescent Clinical Screening Revision</h1>
						</center>
					</div><!-- div title end -->
					<center>						
						<?php date_default_timezone_set('America/Chicago');$today = date('l jS \of F Y h:i:s A');print_r($today);?>
					</center>
				</div><!-- div header end -->
			</div><!-- end div top -->			
			<br>
			<br>
			<br>
			<h1><center>Personal Information</center></h1>
			<div id="personal">
				<table id="tblPersonal">
					<tr><td class="personal"><label for="name">Name:</label></td><td class="personal"><input type="text" name="name"></td>
					<td class="personal"><label for="phone">Gender:</label></td><td class="personal"><input type="text" name="phone"></td></tr>
					<tr><td></td><td></td></tr>
					<tr><td></td><td>MM/DD/YYYY</tr>
						<tr><td class="personal"><label for="dob">Date of birth:</label></td><td class="personal"><input id="dob" type="text" name="dob"></td>
						<td class="personal"><label for="p_id">Patient ID:</label></td><td class="personal"><input type="text" name="pt_id"></td></tr>
				</table>
			</div><!-- end div personal -->
			<br>
			<br><hr>
			<?php
				include 'stressors.php';
				include 'db.php'; //database connection.
				write_stressors("adolescent");
			?>
			
			<br><hr>
			<div id="current_stress_level">
				<center><h1>Current Stress Level</h1></center>
				<center><p>Taking all of these into consideration, what is your overall stress level right now ?</p></center>
				<table id="table_current_stress">
					<tr><td class="st"><center><input type="radio" name="stress"  value="0"/></center></td>
						<td class="st"><center><input type="radio" name="stress"  value="1"/></center></td>
						<td class="st"><center><input type="radio" name="stress"  value="2"/></center></td>
						<td class="st"><center><input type="radio" name="stress"  value="3"/></center></td>
						<td class="st"><center><input type="radio" name="stress"  value="4"/></center></td>
						<td class="st"><center><input type="radio" name="stress"  value="5"/></center></td>
						<td class="st"><center><input type="radio" name="stress"  value="6"/></center></td>
						<td class="st"><center><input type="radio" name="stress"  value="7"/></center></td>
						<td class="st"><center><input type="radio" name="stress"  value="8"/></center></td>
						<td class="st"><center><input type="radio" name="stress"  value="9"/></center></td>
						<td class="st"><center><input type="radio" name="stress"  value="10"/></center></td></tr>
					<tr><td class="st">0</td><td class="st">10</td><td class="st">20</td><td class="st">30</td><td class="st">40</td><td class="st">50</td><td class="st">60</td><td class="st">70</td><td class="st">80</td><td class="st">90</td><td class="st">100</td></tr>
					<tr><td class="st">No stress.</td><td class="st"></td><td class="st">Minimal stress.</td><td class="st"></td><td class="st"></td><td class="st">Moderate stress.</td><td class="st"></td><td class="st"></td><td class="st">Very much stressed.</td><td class="st"></td><td class="st">Most stress ever felt.</td></tr>
				</table>
			</div><!-- closse div current_stress_level -->
			
			<?php		
				include 'include/gad.php';
				include 'include/phq.php';
				include 'include/cd.php';
				include 'include/audit.php';
				include 'include/crafft.php';	
				include 'include/kmhb.php';	
				include 'include/psc.php';
				include 'include/life.php';	
				include 'include/pcl.php';
				$i = 0; //global used to number the items on the screener.
				echo "<hr><br><div id=\"gen_header\"><h2>Below is a list of questions regarding your problems, complaints, feelings and self-confidence. 
						Please read each question carefully and select the response that best represents your situation.</h2></div><!--end div gen_header --><br>";				
				write_gad("adolescent");					
				echo "<div class=\"page-break\"></div><!--force page break here. good for 8.5X11 pages -->";//these are manual page breaks for printing. May need to move them if you print the instruments in different order!					
				write_phq("adolescent"); 
				write_audit("adolescent");
				echo "<div class=\"page-break\"></div><!--force page break here. good for 8.5X11 pages -->";//these are manual page breaks for printing. May need to move them if you print the instruments in different order!						
				write_crafft("adolescent");
				write_cd("adolescent");	
				write_kmhb("adolescent");				
				echo "<br><hr>\n";
				write_psc("adolescent");
				echo "<br><hr>\n";
				write_life("adolescent");	
				write_pcl("adolescent");				
				mysql_close($link);				
			?>									
		<br>
		<p id="error_notice">There were errors on the form, please make sure all fields are fill out correctly.</p>
		<br>
		<br>
		<center>
		<input id="submit" type="submit" value="Submit" />
		<input id="reset_button" type="reset" value="Reset" />
		</center>
		<br>
		<br>
	</div><!-- div container end -->
		</form>
		<footer><center><p> &copy; 2012 Gulf Regions Health Outreach Program</p></center></footer>
		
	

		</body>
		</html>
	</body>
</html>
