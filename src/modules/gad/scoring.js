window.scoring.gad = {};

window.scoring.gad.score = function(response, flags) {
  result = {};
    result.valid = true;

  Object.keys(response).forEach(function(key) {
    response[key] = parseInt(response[key]);
    if(!(response[key] >= 0)) {
        result.valid = false;
    }
  });


	if(result.valid) {
		result.score = 0;
        Object.keys(response).forEach(function(key) {
            result.score += response[key];
        }); 

		
        if(result.score <= 4) {
            result.severity = 'Minimal anxiety';
            result.recommendation = 'N/A';
        } else if(result.score <= 9) {
            result.severity = 'Mild anxiety';
            result.recommendation = 'N/A';
        } else if(result.score <= 14) {
            result.severity = 'Moderate anxiety';
            result.recommendation = 'N/A';
        } else if(result.score <= 21) {
            result.severity = 'Severe anxiety';
            result.recommendation = 'N/A';
        }
	}

  return {
    result,
    flags,
  };
}
