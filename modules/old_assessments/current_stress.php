<?php
	function write_current_stress($type) {

		echo "<br><hr>
		<div id=\"current_stress_level\">
		<center><h1>Current Stress Level</h1></center>";

		if ($type === 'Child') {
			echo"<center><p>Taking all of these into consideration, what do you feel your child's overall stress level is right now ?</p></center>";
		} else {
			echo"<center><p>Taking all of these into consideration, what is your overall stress level right now ?</p></center>";
		}

		echo "<table id=\"table_current_stress\">";


		echo "<tr>";
		for($i = 0; $i <= 10; $i++) {
			echo '<td class="st"><center><input type="radio" name="stress"  value="' . $i . '"/></center></td>';
		}
		echo "</tr>";


		echo "<tr>";
		for($i = 0; $i <= 100; $i += 10) {
			echo '<td class="st">' . $i . '</td>';
		}
		echo "</tr>";


		echo "<tr>";
		echo "
			<td class=\"st\">No stress.</td>
			<td class=\"st\"></td>
			<td class=\"st\">Minimal stress.</td>
			<td class=\"st\"></td>
			<td class=\"st\"></td>
			<td class=\"st\">Moderate stress.</td>
			<td class=\"st\"></td>
			<td class=\"st\"></td>
			<td class=\"st\">Very much stressed.</td>
			<td class=\"st\"></td>
			<td class=\"st\">Most stress ever felt.</td>";
		echo "</tr></table></div><!-- close div current_stress_level -->";
	}

	write_current_stress('Child');
?>