<?php
 /* CAT:Misc */
 session_start();
//print_r($_SESSION);
 /* Include all the classes */ 
 include("../class/pDraw.class.php"); 
 include("../class/pImage.class.php"); 
 include("../class/pData.class.php");
 $info_store = strtolower($_SESSION['pt_id']);
 $info_store = hash('sha256',$info_store);
 $id_store = $_SESSION['user_id'];
 require_once '../../constants.php';
 $query = "SELECT id, date, audit_1+audit_2+audit_3 as audit_score, audit_1, audit_2, audit_3  FROM msihdp.response where pt_id = '". $info_store ."'and audit_check = 1 and clinic_id in (select clinic_id from groups where user_id = '" . $id_store ."')";
 //echo $query;	
$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);

if ($mysqli->connect_errno)
{
printf("Connect failed: %s\n", $mysqli->connect_error);
exit();
}	

$scores = array();
$dates	= array();
$cutoff = array();
$max 	= array();
if($result = $mysqli->query($query)){
	if($result->num_rows > 1 ){
		while($row = $result->fetch_assoc())  {
			//$key = $row['id'];
			//echo " " .$key;
			//$scores = $row['gad_score'];
			//echo " ". $value;
			if ($row['audit_1'] >= 0 && $row['audit_2'] >= 0 &&
				$row['audit_7'] >= 0){
					$scores[$row['id']] = $row['audit_score'];
					$dates[$row['id']] = $row['date'];
			}
		}
 	}
}	

if (count($scores)>1){
/* Create and populate the pData object */
	$MyData = new pData(); 
	$MyData->loadPalette("../palettes/blind.color",TRUE); 
	$MyData->addPoints($scores,"Scores");
	$MyData->setSerieWeight("Scores",2);
	$MyData->setAxisName(0,"Score");
	$MyData->addPoints($dates,"Labels");
	$MyData->setSerieDescription("Labels","Dates of Service");
	$MyData->setAbscissa("Labels");

	$vHeight = 350;
	$width = 850;

	 /* Create the pChart object */
	$myPicture = new pImage($width,$vHeight+50,$MyData);

	 /* Turn of Antialiasing */
	$myPicture->Antialias = FALSE;

	 /* Draw the background */
	$Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
	$myPicture->drawFilledRectangle(0,0,$width,$vHeight,$Settings);

	 /* Overlay with a gradient */
	$Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
	$myPicture->drawGradientArea(0,0,$width,$vHeight,DIRECTION_VERTICAL,$Settings);
	$myPicture->drawGradientArea(0,0,$width,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>80));

	 /* Add a border to the picture */
	$myPicture->drawRectangle(0,0,$width-1,$vHeight,array("R"=>0,"G"=>0,"B"=>0));
	 
	 /* Write the chart title */ 
	$myPicture->setFontProperties(array("FontName"=>"../fonts/Forgotte.ttf","FontSize"=>8,"R"=>255,"G"=>255,"B"=>255));
	$myPicture->drawText(10,16,"Trend of AUDIT-C Scores for Client ID " . $id_store, array("FontSize"=>11,"Align"=>TEXT_ALIGN_BOTTOMLEFT));

	 /* Set the default font */
	$myPicture->setFontProperties(array("FontName"=>"../fonts/pf_arma_five.ttf","FontSize"=>6,"R"=>0,"G"=>0,"B"=>0));

	 /* Define the chart area */
	$myPicture->setGraphArea(60,40,$width-50,$vHeight);

	 /* Draw the scale */
	$AxisBoundaries = array(0=>array("Min"=>0,"Max"=>13));
	$scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>$AxisBoundaries,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
	$myPicture->drawScale($scaleSettings);

	 /* Turn on Antialiasing */
	$myPicture->Antialias = TRUE;

	 /* Enable shadow computing */
	$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

	 /* Draw the line chart */
	$myPicture->drawLineChart();
	$myPicture->drawPlotChart(array("DisplayValues"=>TRUE,"PlotBorder"=>TRUE,"BorderSize"=>2,"Surrounding"=>-60,"BorderAlpha"=>80));

	/* Add cutoff data */
	$myPicture->drawThreshold(4,array("Alpha"=>255,"Ticks"=>2,"R"=>0,"G"=>255,"B"=>0, "WriteCaption"=>true, "Caption"=>Affirmative_Female));
	$myPicture->drawThreshold(5,array("Alpha"=>255,"Ticks"=>2,"R"=>0,"G"=>0,"B"=>255, "WriteCaption"=>true, "Caption"=>Affirmative_Male));
	$myPicture->drawThreshold(12,array("Alpha"=>255,"Ticks"=>2,"R"=>0,"G"=>0,"B"=>0, "WriteCaption"=>true, "Caption"=>Maximum));

	 /* Write the chart legend */
	$myPicture->drawLegend(590,9,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL,"FontR"=>255,"FontG"=>255,"FontB"=>255));

	 /* Render the picture (choose the best way) */
	$myPicture->stroke();
} else {
echo '<!-- HTML start -->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
	<head>
		<title>
			Error!
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="No Data">
		<link rel="stylesheet" href="dagger.css" type="text/css">
	</head>
	<body>
		<center><h1>Sorry, insufficient data to trend!</h1></center>
	</body>
	<footer><center><p> &copy; The University of Southern Mississippi <br> Funded by the Gulf Region Health Outreach Program, 2012</p></center></footer>
	<center><a href="http://www.lphi.org/home2/section/3-416/primary-care-capacity-project-" target="_blank"><img src="../../images/GRHOP.png" style="border:solid; border-color:black;" width="100" height="100" alt="G.R.H.O.P"></a></center>
</html>';

}

?>