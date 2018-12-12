window.scoring.pcl_c = {};

window.scoring.pcl_c.score = function(response, flags) {
  result = {};
    result.valid = true;
    result.score = 0;

  Object.keys(response).forEach(function(key) {
    response[key] = parseInt(response[key]);
    result.score += response[key];
    if(!(response[key] >= 0)) {
        result.valid = false;
    }
  });


	if(result.valid) {
		
        if(result.score <= 29) {
            result.severity = 'Patient shows no signs of PTSD';
            result.recommendation = 'N/A';
        } else if(result.score <= 35) {
            result.severity = 'Patient shows mild signs of PTSD';
            result.recommendation = 'N/A';
        } else if(result.score <= 44) {
            result.severity = 'Patient shows moderate signs of PTSD';
            result.recommendation = 'N/A';
        } else {
            result.severity = 'Patient shows severe signs of PTSD';
            result.recommendation = 'N/A';
        }
	}

  return {
    result,
    flags,
  };
}
