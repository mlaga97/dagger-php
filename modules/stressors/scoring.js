scoring.stress = function(r) {
	result = {};

	_(r).each(function(val, key) {
		r[key] = parseInt(val);
	});

	result.valid = (r.stress >= 0);

	if(result.valid) {
		result.score = r.stress;

		if(result.score < 6) {
			result.severity = 'FIXME';
			result.recommendation = 'Patient DOES NOT show signs of High Stress.';
		} else {
			result.severity = 'FIXME';
			result.recommendation = 'Patient shows signs of High Stress.';
		}
	}

	return result;
}
