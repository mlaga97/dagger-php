<div class='footer'>

	<div style="float:right;">
	<!-- <a href="https://www.lphi.org/home2/section/3-416/primary-care-capacity-project-"> -->
		<img src="/include/images/GRHOP.png" style="width:80px;height:80px;" alt="G.R.H.O.P" />
	<!-- </a> -->
	</div>


	<div class='logo' style="float:right;">
		<?php
			// tried DB pull, but...
			// msihdp.univeristy.logo contains html with style and attibutes. Yep.  It sure does.
			//echo $_SESSION['logo'];
			// for now, since EVERYONE is USM, the USM logo
		?>
		<img src="/include/images/usm.png" style="width:80px;height:80px;" alt="USM" />
	</div>

	<div style="float:left;font-size:12px;color:gray;padding-top:<?php if($_SESSION['previous'] == '/login.php') echo 20; else echo 0; ?>px;text-align:center;width:600px;" >
		<?php
			if($_SESSION['previous'] != '/login.php') {
				echo "Dagger " . $_SESSION['versionString'] . " (" . date("Y-m-d H:m:s", $_SESSION['revisionDate']) . ")<br/>";
			}
		?>
		&copy; The University of Southern Mississippi<br>Funded by the Gulf Region Health Outreach Program, 2012
	</div>

</div>
