window.scoring.sf36 = {};

window.scoring.sf36.score = function(response, flags) {
  var r = {};
  var result = {
    valid: true,
  };

  Object.keys(response).forEach(function(key) {
    var val = parseInt(response[key]);
    if(key.match("SF36_[0-9]+")) {
			val = parseInt(val);
			r[parseInt(key.replace("SF36_", ""))] = val;
    }
  });
  
  // Calculate scores
  result.physical = (r[3] + r[4] + r[5] + r[6] + r[7] + r[8] + r[9] + r[10] + r[11] + r[12]) / 10;
	result.rlp = (r[13] + r[14] + r[15] + r[16]) / 4;
	result.rle = (r[17] + r[18] + r[19]) / 3;
	result.energy = (r[23] + r[27] + r[29] + r[31]) / 4;
	result.ewb = (r[24] + r[25] + r[26] + r[28] + r[30]) / 5;
	result.social = (r[20] + r[32]) / 2;
	result.pain = (r[21] + r[22]) / 2;
	result.general = (r[1] + r[33] + r[34] + r[35] + r[36]) / 5;
  
  return {
    result,
    flags,
  }
}

window.scoring.sf36.render = function(result) {
  var html;

  html = '<table class="table table-scoring table-vertical table-bordered">';

	if(!result) {
		html += '<tr><td>The assessment was not scored due to incomplete responses.</td></tr>';
	} else {
		html += '<tr><th>Physical functioning</th><td>' + result.physical.toFixed(3) + '</td></tr>';
		html += '<tr><th>Role limitations due to physical health</th><td>' + result.rlp.toFixed(3) + '</td></tr>';
		html += '<tr><th>Role limitations due to emotional health</th><td>' + result.rle.toFixed(3) + '</td></tr>';
		html += '<tr><th>Energy/fatigue</th><td>' + result.energy.toFixed(3) + '</td></tr>';
		html += '<tr><th>Emotional well-being</th><td>' + result.ewb.toFixed(3) + '</td></tr>';
		html += '<tr><th>Social functioning</th><td>' + result.social.toFixed(3) + '</td></tr>';
		html += '<tr><th>Pain</th><td>' + result.pain.toFixed(3) + '</td></tr>';
		html += '<tr><th>General Health</th><td>' + result.general.toFixed(3) + '</td></tr>';
  }

	html += '</table>';
	return html;
}
