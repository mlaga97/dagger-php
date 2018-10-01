window.scoring.audit = {};

window.scoring.audit.score = function(response, flags) {
  result = {};
  var gender = '';

  Object.keys(response).forEach(function(key) {
    response[key] = parseInt(response[key]);
  });

	result.valid = (response.audit_1 >= 0) && (response.audit_2 >= 0) && (response.audit_3 >= 0);

	if(result.valid) {
		result.score = response.audit_1 + response.audit_2 + response.audit_3;

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
