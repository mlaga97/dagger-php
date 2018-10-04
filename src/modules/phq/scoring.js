window.scoring.phq = {};

window.scoring.phq.score = function(response, flags) {
  result = {};

  Object.keys(response).forEach(function(key) {
    response[key] = parseInt(response[key]);
  });

	result.valid = (response.phq_1 >= 0) && (response.phq_2 >= 0) && (response.phq_3 >= 0) && (response.phq_4 >= 0) && (response.phq_5 >= 0)
  && (response.phq_6 >= 0) && (response.phq_7 >= 0) && (response.phq_8 >= 0) && (response.phq_9 >= 0);

	if(result.valid) {
		result.score = response.phq_9 + response.phq_8 + response.phq_7 + response.phq_6 + response.phq_5 + response.phq_4 + response.phq_3
    +response.phq_2 + response.phq_1;

    if (response.phq_9 > 0) {
      flags.suicide = true;
    }

    // TODO: Verify case


    // TODO: Add functionality to consider major or other disorders based on the color of the boxes they check
    // or the number value returned by response.phq
    if(result.score == 0) {
      result.severity = 'none';
      result.recommendation = 'N/A';
    } else if (result.score < 5) {
      result.severity = 'Minimal Depression';
      result.recommendation = 'Support, educate to call if worse, return in one month.';
    } else if (result.score < 10) {
      result.severity = 'Mild Depression';
      result.recommendation = 'Support, educate to call if worse, return in one month.';
    } else if (result.score < 15) {
      result.severity = 'Moderate Depression';
      result.recommendation = 'Support, watchful waiting. Antidepressant or psychotherapy.';
    } else if (result.score < 20) {
      result.severity = 'Moderately severe depression';
      result.recommendation = 'Antidepressant and psychotherapy.';
    } else {
      result.severity = 'Severe Depression';
      result.recommendation = 'Antidepressant and psychotherapy(especially if not improved on monotherapy)';
    }
  }

  return {
    result,
    flags,
  };
}