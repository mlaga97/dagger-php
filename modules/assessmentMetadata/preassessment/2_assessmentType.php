<?php
if ($_SESSION['grouping'] === 2 || $_SESSION['grouping'] === 6 || $_SESSION['grouping'] === 10) { //ms grhop and coastal's employees
	echo
	"<table border=\"1\" width = \"800\" id=\"table_select_assessment\"><td>
                    <h3> Please select an assessment type.</h3>
                    <br>
                    <div title=\"Ages 19+ years of age.\">
                    <label><input  id=\"_type\" input type=\"radio\" name=\"assessment_type\" value=\"Adult\" /> Adult </label>
                    </div>
                    <div title=\"Ages 4-13 years of age.\" >
                    <label><input id=\"_type\" input type=\"radio\" name=\"assessment_type\" value=\"Child\" /> Child </label>
                    </div>
                    <br>
                    </td></table>";
} else {
	echo
	"<table border=\"1\" width = \"800\" id=\"table_select_assessment\"><td>
                    <h3> Please select an assessment type.</h3>
                    <br>
                    <div title=\"Ages 19+ years of age.\">
                    <label><input  id=\"_type\" input type=\"radio\" name=\"assessment_type\" value=\"Adult\" /> Adult </label>
                    </div>

                    <div title=\"Ages 14-18 years of age.\" >
                    <label><input id=\"_type\" input type=\"radio\" name=\"assessment_type\" value=\"Adolescent\" /> Adolescent </label>
                    </div>

                    <div title=\"Ages 4-13 years of age.\" >
                    <label><input id=\"_type\" input type=\"radio\" name=\"assessment_type\" value=\"Child\" /> Child </label>
                    </div>
                    <br>
            </td></table>";
}
?>

<br/>
