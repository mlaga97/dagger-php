window.scoring.duke = {};

window.scoring.duke.score = function(response, flags) {
	var r = {};
  var result = {};

	// Some preprocessing
  Object.keys(response).forEach(function(key) {
    var val = parseInt(response[key]);

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
  result.physical = (r[8] + r[9] + r[10] + r[11] + r[12]) * 10;
	result.mental = (r[1] + r[4] + r[5] + r[13] + r[14]) * 10;
	result.social = (r[2] + r[6] + r[7] + r[15] + r[16]) * 10;
	result.general = (result.physical + result.mental + result.social) / 3;
	result.perceived = r[3] * 50;
	result.esteem = (r[1] + r[2] + r[4] + r[6] + r[7]) * 10;
	result.anxiety = (r[2] + r[5] + r[7] + r[10] + r[12] + r[14]) * 8.333;
	result.depression = (r[4] + r[5] + r[7] + r[10] + r[12] + r[13] + r[14]) * 7.143;
	result.pain = r[11] * 50;
	result.disability = r[17] * 50;

  return {
    result,
    flags,
  }
}

window.scoring.duke.render = function(result) {
  var html = '<div>';

  html += '<center><h1>Duke Health Profile (The Duke)</h1></center>';
  html += '<center>Copyright &#169; 1989-2005 by the Department of Community and Family Medicine.</center>';
  html += '<center>Duke University Medical Center, Durham, NC, USA </center><br/>';

	if(!result) {
		html += '<br><br>The assessment was not scored due to incomplete responses.<br>';
	} else {
		html += 'Physical Health Score: ' + result.physical + '<br/>';
		html += 'Mental Health Score: ' + result.mental + '<br/>';
		html += 'Social Health Score: ' + result.social + '<br/>';
		html += 'Social Health Score: ' + result.social + '<br/>';
		html += 'General Health Score: ' + result.general + '<br/>';
		html += 'Perceived Health Score: ' + result.perceived + '<br/>';
		html += 'Self-Esteem Score: ' + result.esteem + '<br/>';
		html += 'Anxiety Score: ' + result.anxiety + '<br/>';
		html += 'Depression Score: ' + result.depression + '<br/>';
		html += 'Pain Score: ' + result.pain + '<br/>';
		html += 'Disablity Score: ' + result.disability + '<br/>';
  }

  html += '</div>';

	return html;
}
