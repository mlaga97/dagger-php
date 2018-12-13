window.scoring.gse = {};

window.scoring.gse.score = function(response, flags) {
  result = {
    valid: false,
    answered: 0,
    score: 0,
    tempScore: 0,
    recommendation: "N/A",
    severity: "N/A"
  };
  
  Object.keys(response).forEach(function(key) {
    response[key] = parseInt(response[key]);
    result.tempScore += response[key];
    if(response[key] >= 0) {
      ++result.answered;
    }
    if(result.answered >= 7)
      result.valid = true;
  });


	if(result.valid) {
    result.score = result.tempScore;
	}

  return {
    result,
    flags,
  };
}
