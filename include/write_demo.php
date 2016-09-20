<?php
echo "<br>\n			
<br>\n
<h1><center>Demographic Data</center></h1>\n
<div id=\"demo_data\">	\n			
	<table id=\"demo\">\n
		<tr><td>\n
			<table border=\"1\" align=\"center\" id=\"table_sex\">\n
				<tr><th class=\"tdtopic\" colspan=\"2\">Sex</th></tr>\n
				<tr><td class=\"sf\">Male.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"sex\"  value=\"male\"/></center></td></tr>\n
				<tr><td class=\"sf\">Female.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"sex\"  value=\"female\"/></center></td></tr>\n
			</table><!-- close table sex -->\n
		</td>\n
		<td>\n
		<table border=\"1\" align=\"center\" id=\"table_marital\">\n
			<tr><th class=\"tdtopic\" colspan=\"4\">Marital Status</th></tr>\n
			<tr><td class=\"ms\">Single.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"m_status\"  value=\"single\"/></center></td>\n
				<td class=\"ms\">Married.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"m_status\"  value=\"married\"/></center></td></tr>\n
			<tr><td class=\"ms\">Divorced.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"m_status\"  value=\"divorced\"/></center></td>\n
				<td class=\"ms\">Widow(ed).</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"m_status\"  value=\"widow(ed)\"/></center></td></tr>\n
		</table>\n
		</td></tr>\n
		<tr><td colspan=\"2\">\n
		<table border=\"1\" id=\"table_education\">\n
			<tr><th class=\"tdtopic\" colspan=\"4\">Education.</th></tr>\n
			<tr><td class=\"ed\">Some high school.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"ed\"  value=\"Some high school.\"/></center></td>\n
				<td class=\"ed\">4-year degree.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"ed\"  value=\"4-year degree.\"/></center></td></tr>\n
			<tr><td class=\"ed\">High school diploma.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"ed\"  value=\"High school diploma.\"/></center></td>\n
				<td class=\"ed\">More than 4 years college.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"ed\"  value=\"More than 4 years college.\"/></center></td></tr>\n
			<tr><td class=\"ed\">2-year degree.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"ed\"  value=\"2-year degree.\"/></center></td><td class=\"ed\" border=\"0\"></td></tr>\n
		</table>			\n
		</td></tr>\n
		<tr><td colspan=\"2\">\n
		<table border=\"1\" id=\"table_ethnicity\">\n
			<tr><th class=\"tdtopic\" colspan=\"6\">Ethnicity</th></tr>\n
			<tr><td class=\"eth\">White/Caucasian.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"eth\"  value=\"White/Caucasian.\"/></center></td>\n
				<td class=\"eth\">Native Hawaiian/Pacific Islander.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"eth\"  value=\"Native Hawaiian/Pacific Islander.\"/></center></td>\n
				<td class=\"eth\">Black/African-American.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"eth\"  value=\"Black/African-American.\"/></center></td></tr>\n
			<tr><td class=\"eth\">Hispanic/Latino.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"eth\"  value=\"Hispanic/Latino.\"/></center></td>\n
				<td class=\"eth\">Middle Eastern.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"eth\"  value=\"Middle Eastern.\"/></center></td>\n
				<td class=\"eth\">American Indian.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"eth\"  value=\"American Indian.\"/></center></td></tr>\n
			<tr><td class=\"eth\">Asian.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"eth\"  value=\"Asian.\"/></center></td>\n
				<td class=\"eth\">Vietnamese.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"eth\"  value=\"Vietnamese.\"/></center></td>\n
				<td>Other.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"eth\"  value=\"Other.\"/></center></td></tr>\n
		</table>\n			
		</td></tr>\n
		<tr><td colspan=\"2\">\n
		<table border=\"1\" id=\"table_living\">\n
			<tr><th class=\"tdtopic\" colspan=\"6\">Living Arrangements</th></tr>\n
			<tr><td class=\"liv\">Alone.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"living\"  value=\"Alone.\"/></center></td>\n
				<td class=\"liv\">With Family/Relatives.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"living\"  value=\"With Family/Relatives.\"/></center></td>\n
				<td class=\"liv\">With Friends.</td><td class=\"demo_input\"><center><input type=\"radio\" name=\"living\"  value=\"With Friends.\"/></center></td></tr>\n
		</table>			\n
		</td></tr>\n
		</table><!-- end table demo -->\n
</div><!-- close div demo_data -->\n"
$_SESSION["sex"]= "-1";
$_SESSION["m_status"]= "-1";
$_SESSION["ed"]= "-1";
$_SESSION["eth"]= "-1";
$_SESSION["living"]= "-1";
?>