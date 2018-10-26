window.scoring.ces_d = {};

window.scoring.ces_d.score = function(response, flags) {
  result = {};

  Object.keys(response).forEach(function(key) {
    response[key] = parseInt(response[key]);
  });

  let score = 0;
  let answered = 0;
	Object.keys(response).forEach(function(key) {
    if(response[key] >= 0) {
      answered += 1;
      score += response[key];
    }
  });

  if(answered > 15) {
    result.valid = true;
  }
	if(result.valid) {
		result.score = score;


    // TODO: Verify case
		var scoringThreshold = 16;

		if(result.score < scoringThreshold) {
			result.severity = 'As scored by the CES-D, the patient DOES NOT show signs of Depression.';
      result.recommendation = 'N/A';
		} else {
			result.severity = 'As scored by the CES-D, the patient shows signs of Depression.';
      result.recommendation = 'N/A';
		}
	}

  return {
    result,
    flags,
  };
}
