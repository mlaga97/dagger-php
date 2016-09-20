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
 $query = "SELECT id, date, ces_d_1+ces_d_2+ces_d_3+ces_d_4+ces_d_5+ces_d_6+ces_d_7+ces_d_8+ces_d_9+ces_d_10+ces_d_11+ces_d_12+ces_d_13+ces_d_14+ces_d_15+ces_d_16+ces_d_17+ces_d_18+ces_d_19+ces_d_20 as ces_d_score, ces_d_1, ces_d_2, ces_d_3, ces_d_4, ces_d_5, ces_d_6, ces_d_7 , ces_d_8, ces_d_9, ces_d_10, ces_d_11, ces_d_12, ces_d_13, ces_d_14, ces_d_15, ces_d_16, ces_d_17 , ces_d_18, ces_d_19, ces_d_20 FROM msihdp.response where pt_id = '". $info_store ."'and ces_check = 1 and clinic_id in (select clinic_id from groups where user_id = '" . $id_store ."')";
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
			if (
				$row['ces_d_1']  >= 0 	&& $row['ces_d_2'] >= 0  &&
				$row['ces_d_3']  >= 0 	&& $row['ces_d_4'] >= 0  &&
				$row['ces_d_5']  >= 0 	&& $row['ces_d_6'] >= 0  &&
				$row['ces_d_7']  >= 0 	&& $row['ces_d_8'] >= 0  &&
				$row['ces_d_9']  >= 0 	&& $row['ces_d_10'] >= 0 &&
				$row['ces_d_11'] >= 0 	&& $row['ces_d_12'] >= 0 &&
				$row['ces_d_13'] >= 0 	&& $row['ces_d_14'] >= 0 &&
				$row['ces_d_15'] >= 0 	&& $row['ces_d_16'] >= 0 &&
				$row['ces_d_17'] >= 0 	&& $row['ces_d_18'] >= 0 &&
				$row['ces_d_19'] >= 0 	&& $row['ces_d_20'] >= 0 &&
				$row['ces_d_1']  != "" 	&& $row['ces_d_2'] != "" &&
				$row['ces_d_3']  != "" 	&& $row['ces_d_4'] != "" &&
				$row['ces_d_5']  != "" 	&& $row['ces_d_6'] != "" &&
				$row['ces_d_7']  != "" 	&& $row['ces_d_8'] != "" &&
				$row['ces_d_9']  != "" 	&& $row['ces_d_10']!= "" &&
				$row['ces_d_11'] != "" 	&& $row['ces_d_12']!= "" &&
				$row['ces_d_13'] != "" 	&& $row['ces_d_14']!= "" &&
				$row['ces_d_15'] != "" 	&& $row['ces_d_16']!= "" &&
				$row['ces_d_17'] != "" 	&& $row['ces_d_18']!= "" &&
				$row['ces_d_19'] != "" 	&& $row['ces_d_20']!= ""){
					$scores[$row['id']] = $row['ces_d_score'];
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
	$myPicture = new pImage($width,$vHeight+25,$MyData);
	//$myPicture->drawGradientArea(0,0,$width,$vHeight,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
 	$myPicture->drawGradientArea(0,0,$width,$vHeight,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
 	$myPicture->setFontProperties(array("FontName"=>"../fonts/pf_arma_five.ttf","FontSize"=>6));
	$myPicture->drawText(10,16,"Trend of CES-D Scores for Client ID " . $id_store, array("FontSize"=>11,"Align"=>TEXT_ALIGN_BOTTOMLEFT));

	 /* Draw the scale */
	$AxisBoundaries = array(0=>array("Min"=>0,"Max"=>61));
	$myPicture->setGraphArea(50,30,$width,$vHeight);
 	$myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10, "Mode"=>SCALE_MODE_MANUAL, "ManualScale"=>$AxisBoundaries));

 	/* Turn on shadow computing */ 
 	$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 	/* Add cutoff data */
	$myPicture->drawThreshold(60,array("Alpha"=>255,"Ticks"=>2,"R"=>255,"G"=>0,"B"=>0, "WriteCaption"=>true, "Caption"=>Maximum, "CaptionR"=>255, "CaptionB"=>255,"CaptionG"=>255, "CaptionOffset"=>TRUE));

 	/* Draw the chart */
 	$settings = array("Gradient"=>TRUE,"GradientMode"=>GRADIENT_EFFECT_CAN,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
 	$myPicture->drawLineChart($settings);
 	$myPicture->drawPlotChart(array("DisplayValues"=>TRUE,"PlotBorder"=>TRUE,"BorderSize"=>2,"Surrounding"=>-60,"BorderAlpha"=>80));

 	/* Write the chart legend */
 	$myPicture->drawLegend($width/2,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

	/* Render the picture (choose the best way) */
	$myPicture->autoOutput();
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
		<link rel="stylesheet" href="mystyle.css" type="text/css">
	</head>
	<body>
		<center><h1>Sorry, insufficient data to trend!</h1></center>
	</body>
	<footer><center><p> &copy; The University of Southern Mississippi <br> Funded by the Gulf Region Health Outreach Program, 2012</p></center></footer>
	<center><a href="http://www.lphi.org/home2/section/3-416/primary-care-capacity-project-" target="_blank"><img src="../../images/GRHOP.png" style="border:solid; border-color:black;" width="100" height="100" alt="G.R.H.O.P"></a></center>
</html>';

}

?>