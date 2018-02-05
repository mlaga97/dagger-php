// TODO: Why do scores differ?
scoring.duke = function(r) {
	result = {};

	_(r).each(function(val, key) {
		r[key] = parseInt(val);
	});

	result.valid = (r.duke_1 >= 0) && (r.duke_2 >= 0) && (r.duke_3 >= 0) && (r.duke_4 >= 0) && (r.duke_5 >= 0) && (r.duke_6 >= 0) && (r.duke_7 >= 0) && (r.duke_8 >= 0) && (r.duke_9 >= 0) && (r.duke_10 >= 0) && (r.duke_11 >= 0) && (r.duke_12 >= 0) && (r.duke_13 >= 0) && (r.duke_14 >= 0) && (r.duke_15 >= 0) && (r.duke_16 >= 0) && (r.duke_17 >= 0);

	if(result.valid) {
		// TODO: Don't rely on outside function for this
		result.scores = scoreDuke(r);
	}

	return result;
}

function scoreDuke(response) {
	var r = {};
	var scores = {};
	
	// Some preprocessing
	_(response).each(function(val, key) {
		if(key.match("duke_[0-9]+")) {
			val = parseInt(val);

			// Check if we can even score it
			if([0, 1, 2].includes(val)) {
				r[parseInt(key.replace("duke_", ""))] = val;
			} else {
				return false;
			}
		}
	});

	// Calculate scores
	scores.physical = (r[8] + r[9] + r[10] + r[11] + r[12]) * 10;
	scores.mental = (r[1] + r[4] + r[5] + r[13] + r[14]) * 10;
	scores.social = (r[2] + r[6] + r[7] + r[15] + r[16]) * 10;
	scores.general = (scores.physical + scores.mental + scores.social) / 3;
	scores.perceived = r[3] * 50;
	scores.esteem = (r[1] + r[2] + r[4] + r[6] + r[7]) * 10;
	scores.anxiety = (r[2] + r[5] + r[7] + r[10] + r[12] + r[14]) * 8.333;
	scores.depression = (r[4] + r[5] + r[7] + r[10] + r[12] + r[13] + r[14]) * 7.143;
	scores.pain = r[11] * 50;
	scores.disability = r[17] * 50;

	return scores
}

function renderDuke(scores) {
	var $container = $('<div/>');

	// TODO: Do better
	$container.append("<center><h1>Duke Health Profile (The Duke)</h1></center>");
	$container.append("<center>Copyright &#169; 1989-2005 by the Department of Community and Family Medicine.</center>");
	$container.append("<center>Duke University Medical Center, Durham, NC, USA </center><br/>");

	if(!scores) {
		$container.append('<br><br>The assessment was not scored due to incomplete responses.<br>');
	} else {
		$container.append('Physical Health Score: ' + scores.physical + '<br/>');
		$container.append('Mental Health Score: ' + scores.mental + '<br/>');
		$container.append('Social Health Score: ' + scores.social + '<br/>');
		$container.append('Social Health Score: ' + scores.social + '<br/>');
		$container.append('General Health Score: ' + scores.general + '<br/>');
		$container.append('Perceived Health Score: ' + scores.perceived + '<br/>');
		$container.append('Self-Esteem Score: ' + scores.esteem + '<br/>');
		$container.append('Anxiety Score: ' + scores.anxiety + '<br/>');
		$container.append('Depression Score: ' + scores.depression + '<br/>');
		$container.append('Pain Score: ' + scores.pain + '<br/>');
		$container.append('Disablity Score: ' + scores.disability + '<br/>');
	}

	return $container;
}
