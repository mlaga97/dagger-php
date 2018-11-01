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
  var html;

  html = '<table class="table table-scoring table-vertical table-bordered">';

	if(!result) {
		html += '<tr><td>The assessment was not scored due to incomplete responses.</td></tr>';
	} else {
		html += '<tr><th>Physical Health</th><td>' + result.physical.toFixed(3) + '</td></tr>';
		html += '<tr><th>Mental Health</th><td>' + result.mental.toFixed(3) + '</td></tr>';
		html += '<tr><th>Social Health</th><td>' + result.social.toFixed(3) + '</td></tr>';
		html += '<tr><th>General Health</th><td>' + result.general.toFixed(3) + '</td></tr>';
		html += '<tr><th>Perceived Health</th><td>' + result.perceived.toFixed(3) + '</td></tr>';
		html += '<tr><th>Self-Esteem</th><td>' + result.esteem.toFixed(3) + '</td></tr>';
		html += '<tr><th>Anxiety</th><td>' + result.anxiety.toFixed(3) + '</td></tr>';
		html += '<tr><th>Depression</th><td>' + result.depression.toFixed(3) + '</td></tr>';
		html += '<tr><th>Pain</th><td>' + result.pain.toFixed(3) + '</td></tr>';
		html += '<tr><th>Disablity</th><td>' + result.disability.toFixed(3) + '</td></tr>';
  }

	html += '</table>';

	return html;
}
