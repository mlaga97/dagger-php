window.scoring.adhd = {};

window.scoring.adhd.score = function(response, flags) {
  result = {};
  

  Object.keys(response).forEach(function(key) {
    response[key] = parseInt(response[key]);
  });



    let result.valid = false;
    

	if(result.valid) {
		result.score = response.adhd_1 + response.adhd_2 + response.adhd_3;

    if (!flags.gender) {
      console.warn('Could not determine gender');
    } else {
      gender = flags.gender;
    }

    // TODO: Verify case
		var scoringThreshold = gender == 'male' ? 4 : 3;

		if(result.score < scoringThreshold) {
			result.severity = 'The patient DOES NOT show signs of substance abuse.';
      result.recommendation = 'N/A';
		} else {
			result.severity = 'The patient shows signs of substance abuse.';
      result.recommendation = 'Refer to a qualified substance abuse professional.';
      flags.substanceAbuse = true;
		}
	}

  return {
    result,
    flags,
  };
}
