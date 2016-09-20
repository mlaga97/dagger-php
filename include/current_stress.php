<?php
function write_current_stress($type)
{
echo "<br><hr>
<div id=\"current_stress_level\">
	<center><h1>Current Stress Level</h1></center>";
if ($type === 'Child'){
	echo"<center><p>Taking all of these into consideration, what do you feel your child's overall stress level is right now ?</p></center>";
}
else{
	echo"<center><p>Taking all of these into consideration, what is your overall stress level right now ?</p></center>";
}
echo"	<table id=\"table_current_stress\">
		<tr><td class=\"st\"><center><input type=\"radio\" name=\"stress\"  value=\"0\"/></center></td>
			<td class=\"st\"><center><input type=\"radio\" name=\"stress\"  value=\"1\"/></center></td>
			<td class=\"st\"><center><input type=\"radio\" name=\"stress\"  value=\"2\"/></center></td>
			<td class=\"st\"><center><input type=\"radio\" name=\"stress\"  value=\"3\"/></center></td>
			<td class=\"st\"><center><input type=\"radio\" name=\"stress\"  value=\"4\"/></center></td>
			<td class=\"st\"><center><input type=\"radio\" name=\"stress\"  value=\"5\"/></center></td>
			<td class=\"st\"><center><input type=\"radio\" name=\"stress\"  value=\"6\"/></center></td>
			<td class=\"st\"><center><input type=\"radio\" name=\"stress\"  value=\"7\"/></center></td>
			<td class=\"st\"><center><input type=\"radio\" name=\"stress\"  value=\"8\"/></center></td>
			<td class=\"st\"><center><input type=\"radio\" name=\"stress\"  value=\"9\"/></center></td>
			<td class=\"st\"><center><input type=\"radio\" name=\"stress\"  value=\"10\"/></center></td></tr>
		<tr><td class=\"st\">0</td><td class=\"st\">10</td><td class=\"st\">20</td><td class=\"st\">30</td><td class=\"st\">40</td><td class=\"st\">50</td><td class=\"st\">60</td><td class=\"st\">70</td><td class=\"st\">80</td><td class=\"st\">90</td><td class=\"st\">100</td></tr>
		<tr><td class=\"st\">No stress.</td><td class=\"st\"></td><td class=\"st\">Minimal stress.</td><td class=\"st\"></td><td class=\"st\"></td><td class=\"st\">Moderate stress.</td><td class=\"st\"></td><td class=\"st\"></td><td class=\"st\">Very much stressed.</td><td class=\"st\"></td><td class=\"st\">Most stress ever felt.</td></tr>
	</table>
</div><!-- close div current_stress_level -->";

}

?>