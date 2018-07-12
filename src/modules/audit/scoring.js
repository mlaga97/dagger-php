// TODO: Substance abuse flag?
window.scoring.audit = function(r) {
  result = {};

  Object.keys(r).forEach(function(key) {
    r[key] = parseInt(r[key]);
  });

	result.valid = (r.audit_1 >= 0) && (r.audit_2 >= 0) && (r.audit_3 >= 0);

	if(result.valid) {
		result.score = r.audit_1 + r.audit_2 + r.audit_3;

		// TODO: Find some more reliable way of determining this
    //if(api.session.demographics_gender) {
    //	result.gender = api.session.demographics_gender;
    //} else if(api.session.sex) {
    //	result.gender = api.session.sex;
    //} else {
    //	throw 'Could not determine gender!';
    //}
    console.warn('Could not determine gender');

		var scoringThreshold = result.gender == 'Male' ? 4 : 3;

		if(result.score < scoringThreshold) {
			result.severity = 'FIXME';
			result.recommendation = 'The patient DOES NOT show signs of substance abuse.';
		} else {
			result.severity = 'FIXME';
			result.recommendation = 'The patient shows signs of substance abuse. Refer to a qualified substance abuse professional.';
		}
	}

	return result;
}
