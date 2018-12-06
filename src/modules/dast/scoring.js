window.scoring.dast = {};

window.scoring.dast.score = function(response, flags) {
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

    // TODO: Verify case
		
        if(result.score == 0) {
            result.severity = 'No problems reported';
            result.recommendation = 'None at this time';
        } else if(result <= 2) {
            result.severity = 'Low level';
            result.recommendation = 'Monitor, reassess at a later date';
        } else if(result <= 5) {
            result.severity = 'Moderate level';
            result.recommendation = 'Further investigation is required';
        } else if(result <= 8) {
            result.severity = 'Substantional level';
            result.recommendation = 'Assessment required';
        } else {
            result.severity = 'Severe level';
            result.recommendation = 'Assessment required';
        }
	}

  return {
    result,
    flags,
  };
}
