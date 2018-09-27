window.scoring.duke = {};

window.scoring.duke.score = function(response) {
	var r = {};
  var scores = {};

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

window.scoring.duke.render = function(scores) {
  var html = '<div>';

  html += '<center><h1>Duke Health Profile (The Duke)</h1></center>';
  html += '<center>Copyright &#169; 1989-2005 by the Department of Community and Family Medicine.</center>';
  html += '<center>Duke University Medical Center, Durham, NC, USA </center><br/>';

	if(!scores) {
		html += '<br><br>The assessment was not scored due to incomplete responses.<br>';
	} else {
		html += 'Physical Health Score: ' + scores.physical + '<br/>';
		html += 'Mental Health Score: ' + scores.mental + '<br/>';
		html += 'Social Health Score: ' + scores.social + '<br/>';
		html += 'Social Health Score: ' + scores.social + '<br/>';
		html += 'General Health Score: ' + scores.general + '<br/>';
		html += 'Perceived Health Score: ' + scores.perceived + '<br/>';
		html += 'Self-Esteem Score: ' + scores.esteem + '<br/>';
		html += 'Anxiety Score: ' + scores.anxiety + '<br/>';
		html += 'Depression Score: ' + scores.depression + '<br/>';
		html += 'Pain Score: ' + scores.pain + '<br/>';
		html += 'Disablity Score: ' + scores.disability + '<br/>';
  }

  html += '</div>';

	return html;
}
