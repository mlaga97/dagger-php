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
 $query = "SELECT id, date, pcl_1+pcl_2+pcl_3+pcl_4+pcl_5+pcl_6+pcl_7+pcl_8+pcl_9+pcl_10+pcl_11+pcl_12+pcl_13+pcl_14+pcl_15+pcl_16+pcl_17 as pcl_score, pcl_1, pcl_2, pcl_3, pcl_4, pcl_5, pcl_6, pcl_7, pcl_8, pcl_9 , pcl_10, pcl_11, pcl_12, pcl_13, pcl_14, pcl_15, pcl_16, pcl_17 FROM msihdp.response where pt_id = '". $info_store ."'and pcl_check = 1 and clinic_id in (select clinic_id from groups where user_id = '" . $id_store ."')";
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
			if ($row['pcl_1'] > 0  && $row['pcl_2'] > 0 &&
				$row['pcl_3'] > 0  && $row['pcl_4'] > 0 &&
				$row['pcl_5'] > 0  && $row['pcl_6'] > 0 &&
				$row['pcl_7'] > 0  && $row['pcl_8'] > 0 &&
				$row['pcl_9'] > 0  && $row['pcl_10'] > 0 && 
				$row['pcl_11'] > 0 && $row['pcl_12'] > 0 &&
				$row['pcl_13'] > 0 && $row['pcl_14'] > 0 &&
				$row['pcl_15'] > 0 && $row['pcl_16'] > 0 &&
				$row['pcl_17'] > 0){
					$scores[$row['id']] = $row['pcl_score'];
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
 	$myPicture->drawGradientArea(0,0,$width,$vHeight,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
 	$myPicture->setFontProperties(array("FontName"=>"../fonts/pf_arma_five.ttf","FontSize"=>6));
	$myPicture->drawText(10,16,"Trend of PCL-C Scores for Client ID " . $id_store, array("FontSize"=>11,"Align"=>TEXT_ALIGN_BOTTOMLEFT));

	 /* Draw the scale */
	$AxisBoundaries = array(0=>array("Min"=>0,"Max"=>90));
	$myPicture->setGraphArea(50,30,$width,$vHeight);
 	$myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10, "Mode"=>SCALE_MODE_MANUAL, "ManualScale"=>$AxisBoundaries));


	/* Turn on shadow computing */ 
 	$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

	 /* Draw the line chart */
	$settings = array("Gradient"=>TRUE,"GradientMode"=>GRADIENT_EFFECT_CAN,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>FALSE,"DisplayR"=>0,"DisplayG"=>0,"DisplayB"=>0,"DisplayShadow"=>TRUE,"Surrounding"=>10);
 	$myPicture->drawLineChart($settings);
	$myPicture->drawPlotChart(array("DisplayValues"=>TRUE,"PlotBorder"=>TRUE,"BorderSize"=>2,"Surrounding"=>-60,"BorderAlpha"=>80));

	$myPicture->drawThreshold(50,array("Alpha"=>70,"Ticks"=>2,"R"=>255,"G"=>0,"B"=>0, "WriteCaption"=>true, "Caption"=>Significant));
	$myPicture->drawThreshold(85,array("Alpha"=>70,"Ticks"=>2,"R"=>0,"G"=>0,"B"=>0, "WriteCaption"=>true, "Caption"=>Maximum));
	
	/* Write the chart legend */
 	$myPicture->drawLegend($width/2,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));
 	//$myPicture->writeBounds();

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