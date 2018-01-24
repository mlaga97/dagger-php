scoring.ces_d = function(r) {
	result = {};

	_(r).each(function(val, key) {
		r[key] = parseInt(val);
	});

	result.valid = (r.ces_d_1 >= 0) && (r.ces_d_2 >= 0) && (r.ces_d_3 >= 0) && (r.ces_d_4 >= 0) && (r.ces_d_5 >= 0) && (r.ces_d_6 >= 0) && (r.ces_d_7 >= 0) && (r.ces_d_8 >= 0) && (r.ces_d_9 >= 0) && (r.ces_d_10 >= 0) && (r.ces_d_11 >= 0) && (r.ces_d_12 >= 0) && (r.ces_d_13 >= 0) && (r.ces_d_14 >= 0) && (r.ces_d_15 >= 0) && (r.ces_d_16 >= 0) && (r.ces_d_17 >= 0) && (r.ces_d_18 >= 0) && (r.ces_d_19 >= 0) && (r.ces_d_20 >= 0);

	if(result.valid) {
		result.score = r.ces_d_1 + r.ces_d_2 + r.ces_d_3 + r.ces_d_4 + r.ces_d_5 + r.ces_d_6 + r.ces_d_7 + r.ces_d_8 + r.ces_d_9 + r.ces_d_10 + r.ces_d_11 + r.ces_d_12 + r.ces_d_13 + r.ces_d_14 + r.ces_d_15 + r.ces_d_16 + r.ces_d_17 + r.ces_d_18 + r.ces_d_19 + r.ces_d_20;

		if(result.score < 16) {
			result.severity = 'FIXME';
			result.recommendation = 'Patient DOES NOT show signs of Depression.';
		} else {
			result.severity = 'FIXME';
			result.recommendation = 'Patient shows signs of Depression.';
		}
	}

	return result;
}
