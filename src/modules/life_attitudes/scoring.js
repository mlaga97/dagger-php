window.scoring.life_attitudes = {};

window.scoring.life_attitudes.score = function(response, flags) {
  result = {
    valid: false,
    score: "N/A",
    recommendation: "N/A"
  };
    
  response.life_2 = parseInt(response.life_2);
  response.life_3 = parseInt(response.life_3);
  if(response.life_2 >= 0 || response.life_3 >= 0) {
    result.valid = true;
  }


	if(result.valid) {
    if(response.life_2 && response.life_3) {
      result.severity = "The client noted a desire to hurt him or herself and that they have hurt themselves before";
      if(response.life_4 && response.life_5) {
        result.severity = result.severity.concat(". The client documented the following two responses: 1. ",
        response.life_4, ", 2. ", response.life_5);
      } else if(response.life_4) {
        result.severity = result.severity.concat(". The client documented the following: ",response.life_4);
      } else if(response.life_5) {
        result.severity = result.severity.concat(". The client documented the following: ",response.life_5);
      }
    } else if(response.life_2) {
      result.severity = "The client noted that they have thoughts of harming or killing themselves";
      if(response.life_4) {
        result.severity = result.severity.concat(". The client documented the following: ",response.life_4);
      }
    } else if(response.life_3) {
      result.severity = "The client noted that they have harmed themselves before";
      if(response.life_5) {
        result.severity = result.severity.concat(". The client documented the following: ",response.life_5);
      }
    }
	}

  return {
    result,
    flags,
  };
}
