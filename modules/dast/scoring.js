// TODO: Substance abuse flag?
scoring.dast = function(r) {
	result = {};

	_(r).each(function(val, key) {
		r[key] = parseInt(val);
	});

	result.valid = (r.dast_1 >= 0) && (r.dast_2 >= 0) && (r.dast_3 >= 0) && (r.dast_4 >= 0) && (r.dast_5 >= 0) && (r.dast_6 >= 0) && (r.dast_7 >= 0) && (r.dast_8 >= 0) && (r.dast_9 >= 0) && (r.dast_10 >= 0);

	if(result.valid) {
		result.score = r.dast_1 + r.dast_2 + r.dast_3 + r.dast_4 + r.dast_5 + r.dast_6 + r.dast_7 + r.dast_8 + r.dast_9 + r.dast_10;

		if(result.score < 2) {
			result.severity = 'No Problems (0-1)';
			result.recommendation = 'Patient DOES NOT show signs of substance abuse.';
		} else if(result.score < 3) {
			result.severity = 'Low Level (1-2)';
			result.recommendation = 'Patient shows signs of substance abuse.';
		} else if(result.score < 6) {
			result.severity = 'Moderate (3-5)';
			result.recommendation = 'Patient shows signs of substance abuse.';
		} else if(result.score < 9) {
			result.severity = 'Substantial (6-8)';
			result.recommendation = 'Patient shows signs of substance abuse.';
		} else {
			result.severity = 'Severe (9-10)';
			result.recommendation = 'Patient shows signs of substance abuse.';
		}

		// TODO: Determine actual cutoff here.
		if(result.score >= 3) {
			result.recommendation = 'Patient shows signs of substance abuse. Refer to a qualified substance abuse professional.';
		}
	}

	return result;
}
