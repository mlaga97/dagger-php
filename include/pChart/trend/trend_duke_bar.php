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
 

//need to calculate the general_health score using (physical_health_score+mental_health_score+social_health_score)/3 as general_health_score,
 $query = "SELECT id, date, (duke_8+duke_9+duke_10+duke_11+duke_12)*10 as physical_health_score,
 (duke_1+duke_4+duke_5+duke_13+duke_14)*10 as mental_health_score,
 (duke_2+duke_6+duke_7+duke_15+duke_16)*10 as social_health_score,
 (duke_8+duke_9+duke_10+duke_11+duke_12+duke_1+duke_4+duke_5+duke_13+duke_13+duke_2+duke_6+duke_7+duke_15+duke_16)*10/3 as general_health_score,
 duke_3 * 50 as perceived_health_score,
 (duke_1+duke_2+duke_4+duke_6+duke_7)*10 as self_esteem_score,
 (duke_2+duke_5+duke_7+duke_10+duke_12+duke_14)*8.333 as anxiety_score,
 (duke_4+duke_5+duke_10+duke_12+duke_13)*10 as depression_score,
 (duke_4+duke_5+duke_7+duke_10+duke_12+duke_13+duke_14)*7.143 as anxiety_depression_score,
 duke_11 * 50 as pain_score,
 duke_17 * 50 as disability_score, duke_1, duke_2, duke_3, duke_4, duke_5, duke_6, duke_7, duke_8, duke_9, duke_10, duke_11, duke_12, duke_13, duke_14, duke_15, duke_16, duke_17 FROM msihdp.response where pt_id = '". $info_store ."'and duke_check = 1 and clinic_id in (select clinic_id from groups where user_id = '" . $id_store ."' order by id)";
 //echo $query;	
$mysqli = new mysqli(DB_SERVER, DB_USER, DB_Password, DB_NAME);

if ($mysqli->connect_errno)
{
printf("Connect failed: %s\n", $mysqli->connect_error);
exit();
}	

$physical_health_score = array();
$mental_health_score = array();
$social_health_score = array();
$general_health_score = array();
$perceived_health_score = array();
$self_esteem_score = array();
$anxiety_score = array();
$anxiety_depression_score = array();
$pain_score = array();
$disability_score = array();
$dates	= array();
$cutoff = array();
$max 	= array();
if($result = $mysqli->query($query)){
	if($result->num_rows > 1 ){
		while($row = $result->fetch_assoc())  {
			/*
			Adding scores to the data arrays is going to be more complicated. We need to consider each sub score for adding.
			*/
			//(duke_8+duke_9+duke_10+duke_11+duke_12)*10 as physical_health_score,
			if ($row['duke_8'] >= 0 && $row['duke_9'] >= 0 && $row['duke_10'] >= 0 &&
				$row['duke_11'] >= 0 && $row['duke_12'] >= 0 && $row['duke_8'] != "" &&
				$row['duke_9'] != "" && $row['duke_10'] != "" &&
				$row['duke_11'] != "" && $row['duke_12'] != "" ){
					$physical_health_score[$row['id']] = ($row['duke_8']+$row['duke_9']+$row['duke_10']+$row['duke_11']+$row['duke_12'])*10;
					$dates[$row['id']] = $row['date'];
			} else {
					$physical_health_score[$row['id']] = -1;
					$dates[$row['id']] = $row['date'];
			}
			//(duke_1+duke_4+duke_5+duke_13+duke_14)*10 as mental_health_score,
			if ($row['duke_1'] >= 0 && $row['duke_4'] >= 0 && $row['duke_5'] >= 0 &&
				$row['duke_13'] >= 0 && $row['duke_14'] >= 0 && $row['duke_1'] != "" &&
				$row['duke_4'] != "" && $row['duke_5'] != "" &&
				$row['duke_13'] != "" && $row['duke_14'] != "" ){
					$mental_health_score[$row['id']] = ($row['duke_1']+$row['duke_4']+$row['duke_5']+$row['duke_13']+$row['duke_14'])*10;
					$dates[$row['id']] = $row['date'];
			} else {
					$mental_health_score[$row['id']] = -1;
					$dates[$row['id']] = $row['date'];
			}
			//(duke_2+duke_6+duke_7+duke_15+duke_16)*10 as social_health_score,
			if ($row['duke_2'] >= 0 && $row['duke_6'] >= 0 && $row['duke_7'] >= 0 &&
				$row['duke_15'] >= 0 && $row['duke_16'] >= 0 && $row['duke_2'] != "" &&
				$row['duke_6'] != "" && $row['duke_7'] != "" &&
				$row['duke_15'] != "" && $row['duke_16'] != "" ){
					$social_health_score[$row['id']] = ($row['duke_2']+$row['duke_6']+$row['duke_7']+$row['duke_15']+$row['duke_16'])*10;
					$dates[$row['id']] = $row['date'];
			} else {
					$social_health_score[$row['id']] = -1;
					$dates[$row['id']] = $row['date'];
			}
			//(duke_8+duke_9+duke_10+duke_11+duke_12+duke_1+duke_4+duke_5+duke_13+duke_13+duke_2+duke_6+duke_7+duke_15+duke_16)*10/3 as general_health_score,
			if ($row['duke_8'] >= 0 && $row['duke_9'] >= 0 && $row['duke_10'] >= 0 &&
				$row['duke_11'] >= 0 && $row['duke_12'] >= 0 && $row['duke_8'] != "" &&
				$row['duke_9'] != "" && $row['duke_10'] != "" &&
				$row['duke_11'] != "" && $row['duke_12'] != "" && 
				$row['duke_1'] >= 0 && $row['duke_4'] >= 0 && $row['duke_5'] >= 0 &&
				$row['duke_13'] >= 0 && $row['duke_14'] >= 0 && $row['duke_1'] != "" &&
				$row['duke_4'] != "" && $row['duke_5'] != "" &&
				$row['duke_13'] != "" && $row['duke_14'] != "" &&
				$row['duke_1'] >= 0 && $row['duke_4'] >= 0 && $row['duke_5'] >= 0 &&
				$row['duke_13'] >= 0 && $row['duke_14'] >= 0 && $row['duke_1'] != "" &&
				$row['duke_4'] != "" && $row['duke_5'] != "" &&
				$row['duke_13'] != "" && $row['duke_14'] != "" ){
					$general_health_score[$row['id']] = round((($row['duke_8']+$row['duke_9']+$row['duke_10']+$row['duke_11']+$row['duke_12']+$row['duke_1']+$row['duke_4']+$row['duke_5']+$row['duke_13']+$row['duke_14']+$row['duke_2']+$row['duke_6']+$row['duke_7']+$row['duke_15']+$row['duke_16'])*10/3),2);
					$dates[$row['id']] = $row['date'];
			} else {
					$general_health_score[$row['id']] = -1;
					$dates[$row['id']] = $row['date'];
			}
			//duke_3 * 50 as perceived_health_score,
			if ($row['duke_3'] >= 0 && $row['duke_3'] != ""){
					$perceived_health_score[$row['id']] = $row['duke_3'] *50;
					$dates[$row['id']] = $row['date'];
			} else {
					$perceived_health_score[$row['id']] = -1;
					$dates[$row['id']] = $row['date'];
			}
			//(duke_1+duke_2+duke_4+duke_6+duke_7)*10 as self_esteem_score,
			if ($row['duke_1'] >= 0 && $row['duke_2'] >= 0 && $row['duke_4'] >= 0 &&
				$row['duke_6'] >= 0 && $row['duke_7'] >= 0 && $row['duke_2'] != "" &&
				$row['duke_6'] != "" && $row['duke_7'] != "" ){
					$self_esteem_score[$row['id']] = ($row['duke_1']+$row['duke_2']+$row['duke_4']+$row['duke_6']+$row['duke_7'])*10;
					$dates[$row['id']] = $row['date'];
			} else {
					$self_esteem_score[$row['id']] = -1;
					$dates[$row['id']] = $row['date'];
			}
			//(duke_2+duke_5+duke_7+duke_10+duke_12+duke_14)*8.333 as anxiety_score,
			if ($row['duke_2'] >= 0 && $row['duke_5'] >= 0 && $row['duke_7'] >= 0 &&
				$row['duke_10'] >= 0 && $row['duke_12'] >= 0 && $row['duke_14'] >= 0 && $row['duke_2'] != "" &&
				$row['duke_5'] != "" && $row['duke_7'] != "" && $row['duke_10'] != "" &&
				$row['duke_12'] != "" && $row['duke_14'] != "" ){
					$anxiety_score[$row['id']] = round((($row['duke_2']+$row['duke_5']+$row['duke_7']+$row['duke_10']+$row['duke_12']+$row['duke_14'])*8.333),2);
					$dates[$row['id']] = $row['date'];
			} else {
					$anxiety_score[$row['id']] = -1;
					$dates[$row['id']] = $row['date'];
			}
			//(duke_4+duke_5+duke_10+duke_12+duke_13)*10 as depression_score,
			if ($row['duke_4'] >= 0 && $row['duke_5'] >= 0 && $row['duke_10'] >= 0 &&
				$row['duke_12'] >= 0 && $row['duke_13'] >= 0 &&  $row['duke_4'] != "" &&
				$row['duke_5'] != "" && $row['duke_10'] != "" && $row['duke_12'] != "" &&
				$row['duke_13'] != ""){
					$depression_score[$row['id']] = ($row['duke_4']+$row['duke_5']+$row['duke_10']+$row['duke_12']+$row['duke_13'])*10;
					$dates[$row['id']] = $row['date'];
			} else {
					$depression_score[$row['id']] = -1;
					$dates[$row['id']] = $row['date'];
			}
			//(duke_4+duke_5+duke_7+duke_10+duke_12+duke_13+duke_14)*7.143 as anxiety_depression_score,
			if ($row['duke_4'] >= 0 && $row['duke_5'] >= 0 && $row['duke_7'] >= 0 &&
				$row['duke_10'] >= 0 && $row['duke_12'] >= 0 && $row['duke_13'] >= 0 && $row['duke_14'] >= 0 && $row['duke_4'] != "" &&
				$row['duke_5'] != "" && $row['duke_7'] != "" && $row['duke_10'] != "" &&
				$row['duke_12'] != "" && $row['duke_13'] != "" && $row['duke_14'] != ""){
					$anxiety_depression_score[$row['id']] = round((($row['duke_4']+$row['duke_5']+$row['duke_7']+$row['duke_10']+$row['duke_12']+$row['duke_13']+$row['duke_14'])*7.143),2);
					$dates[$row['id']] = $row['date'];
			} else {
					$anxiety_depression_score[$row['id']] = -1;
					$dates[$row['id']] = $row['date'];
			}
			//duke_11 * 50 as pain_score,
			if ($row['duke_11'] >= 0 && $row['duke_11'] != ""){
					$pain_score[$row['id']] = $row['duke_11'] * 50;
					$dates[$row['id']] = $row['date'];
			} else {
					$pain_score[$row['id']] = -1;
					$dates[$row['id']] = $row['date'];
			}
			//duke_17 * 50 as disability_score
			if ($row['duke_17'] >= 0 && $row['duke_17'] != ""){
					$disability_score[$row['id']] = $row['duke_17'] * 50;
					$dates[$row['id']] = $row['date'];
			} else {
					$disability_score[$row['id']] = -1;
					$dates[$row['id']] = $row['date'];
			}
			}
		}
}


if (count($physical_health_score)>0 || count($mental_health_score)>0 || count($social_health_score)>0 ||
	count($general_health_score)>0 || count($perceived_health_score)>0 || count($self_esteem_score)>0 ||
	count($anxiety_score)>0 || count($depression_score)>0 || count($anxiety_depression_score)>0 || 
	count($pain_score)>0 || count($disability_score)>0 ){
/* Create and populate the pData object */
	$MyData = new pData();  
	$MyData->loadPalette("../palettes/blind.color",TRUE);
	$MyData->addPoints($physical_health_score,"Physical");
	$MyData->addPoints($mental_health_score,"Mental");
	$MyData->addPoints($social_health_score,"Social");
	$MyData->addPoints($general_health_score,"General");
	$MyData->addPoints($perceived_health_score,"Perceived");
	$MyData->addPoints($self_esteem_score,"Self Esteem");
	$MyData->addPoints($anxiety_score,"Anxiety");
	$MyData->addPoints($depression_score,"Depression");
	$MyData->addPoints($anxiety_depression_score,"Anxiety/Depression");
	$MyData->addPoints($pain_score,"Pain");
	$MyData->addPoints($disability_score,"Disability");

	//Set Vertical Axis
	$MyData->setAxisName(0,"Score");
	//Set Horizontal Axis
	$MyData->addPoints($dates,"Labels");
	$MyData->setSerieDescription("Labels","Dates of Service");
	$MyData->setAbscissa("Labels");

	$vHeight = 350;
	$width = 850;

	 /* Create the pChart object */
	$myPicture = new pImage($width,$vHeight+25,$MyData);
	$myPicture->drawGradientArea(0,0,$width,$vHeight,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
 	$myPicture->drawGradientArea(0,0,$width,$vHeight,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
 	$myPicture->setFontProperties(array("FontName"=>"../fonts/pf_arma_five.ttf","FontSize"=>6));
 	$myPicture->drawText(10,16,"The DUKE scores for Client ID " . $id_store, array("FontSize"=>8,"Align"=>TEXT_ALIGN_BOTTOMLEFT));

 	/* Draw the scale  */
 	$AxisBoundaries = array(0=>array("Min"=>-10,"Max"=>100));
 	$myPicture->setGraphArea(50,30,$width,$vHeight);
 	$myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10, "Mode"=>SCALE_MODE_MANUAL, "ManualScale"=>$AxisBoundaries));

 	/* Turn on shadow computing */ 
 	$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 	/* Draw the chart */
 	$settings = array("Gradient"=>TRUE,"GradientMode"=>GRADIENT_EFFECT_CAN,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
 	$myPicture->drawBarChart($settings);

 	/* Write the chart legend */
 	$myPicture->drawLegend($width/4,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

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