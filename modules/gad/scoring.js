/*

Minimal (0-4)            | Patient DOES NOT show signs of Anxiety.
Mild Anxiety (5-9)       | Patient shows signs of Anxiety.
Moderate Anxiety (10-14) | Patient shows signs of Anxiety.
Severe Anxiety (15-21)   | Patient shows signs of Anxiety.

*/

scoring.gad = function(r) {
	result = {};

	_(r).each(function(val, key) {
		r[key] = parseInt(val);
	});

	result.valid = (r.gad_1 >= 0) && (r.gad_2 >= 0) && (r.gad_3 >= 0) && (r.gad_4 >= 0) && (r.gad_5 >= 0) && (r.gad_6 >= 0) && (r.gad_7 >= 0);

	if(result.valid) {
		result.score = r.gad_1 + r.gad_2 + r.gad_3 + r.gad_4 + r.gad_5 + r.gad_6 + r.gad_7;

		if(result.score < 5) {
			result.severity = 'Minimal (0-4)';
			result.recommendation = 'Patient DOES NOT show signs of Anxiety.';
		} else if(result.score < 10) {
			result.severity = 'Mild Anxiety (5-9)';
			result.recommendation = 'Patient shows signs of Anxiety.';
		} else if(result.score < 15) {
			result.severity = 'Moderate Anxiety (10-14)';
			result.recommendation = 'Patient shows signs of Anxiety.';
		} else {
			result.severity = 'Severe Anxiety (15-21)';
			result.recommendation = 'Patient shows signs of Anxiety.';
		}
	}

	return result;
}
