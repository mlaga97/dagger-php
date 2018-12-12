window.scoring.adhd = {};

window.scoring.adhd.score = function(response, flags) {
  result = {
    valid: true,
    adhd_score: 0,
    score: "N/A",
    recommendation: "N/A"
  };

  Object.keys(response).forEach(function(key) {
    response[key] = parseInt(response[key]);
    if(!(response[key] >= 0)) {
        result.valid = false;
    }
  });


	if(result.valid) {
    if(response.adhd_1 >= 2) {
      ++result.adhd_score;
    }
    if(response.adhd_2 >= 2) {
      ++result.adhd_score;
    }
    if(response.adhd_3 >= 2) {
      ++result.adhd_score;
    }
    if(response.adhd_4 >= 3) {
      ++result.adhd_score;
    }
    if(response.adhd_5 >= 3) {
      ++result.adhd_score;
    }
    if(response.adhd_6 >= 3) {
      ++result.adhd_score;
    }
    if(result.adhd_score >= 4) {
      result.severity = "According to Adult ADHD Self-Report Scale (ASRS-v1.1) Symptom Checklist, the client shows evidence of ADHD."
    } else {
      result.severity = "According to the Adult ADHD Self-Report Scale (ASRS-v1.1) Symptom Checklist, the client shows no evidence of ADHD."
    }
	}

  return {
    result,
    flags,
  };
}
