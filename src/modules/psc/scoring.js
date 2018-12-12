/*
  Look at the Duke scoring.js as a guideline
*/
window.scoring.psc = {};

window.scoring.psc.score = function(response, flags) {
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
		
	}

  return {
    result,
    flags,
  };
}
