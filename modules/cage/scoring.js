// TODO: Substance abuse flag?
scoring.cage = function(r) {
	result = {};

	_(r).each(function(val, key) {
		r[key] = parseInt(val);
	});

	result.valid = (r.cage_1 >= 0) && (r.cage_2 >= 0) && (r.cage_3 >= 0) && (r.cage_4 >= 0);

	if(result.valid) {
		result.score = r.cage_1 + r.cage_2 + r.cage_3 + r.cage_4;

		if(result.score < 3) {
			result.severity = 'FIXME (0-2)';
			result.recommendation = 'Patient DOES NOT show signs of substance abuse.';
		} else {
			result.severity = 'FIXME (2-4)';
			result.recommendation = 'Patient shows signs of substance abuse.';
		}
	}

	return result;
}
