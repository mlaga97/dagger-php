window.scoring.cage = {};

window.scoring.cage.score = function(response, flags) {
  result = {};

  Object.keys(response).forEach(function(key) {
    response[key] = parseInt(response[key]);
  });

	result.valid = (response.cage_1 >= 0) && (response.cage_2 >= 0) && (response.cage_3 >= 0) && (response.cage_4 >= 0);

	if(result.valid) {
		result.score = response.cage_1 + response.cage_2 + response.cage_3 + response.cage_4;


    // TODO: Verify case
		var scoringThreshold = 2;

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
