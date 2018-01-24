/*

Minimal Symptoms (0-4) | Support, educate to call if worse, return in one month
Mild Symptoms (5-9)    | Support, educate to call if worse, return in one month
Moderate Depression, Dysthymia, Major Depression (mild) (10-14) | Support, watchful waiting, Antidepressant or psychotherapy, Antidepressant or psychotherapy
Moderately Severe (15-19) | Antidepressant and psychotherapy
Severe Depression (20-27) | Antidepressant and psychotherapy (especially if not improved on monotherapy)

NOTE: Any response greater than 0 on phq_9 should flag for suicide consultation needed

*/

scoring.phq = function(r) {
	result = {};

	_(r).each(function(val, key) {
		r[key] = parseInt(val);
	});

	result.valid = (r.phq_1 >= 0) && (r.phq_2 >= 0) && (r.phq_3 >= 0) && (r.phq_4 >= 0) && (r.phq_5 >= 0) && (r.phq_6 >= 0) && (r.phq_7 >= 0) && (r.phq_8 >= 0) && (r.phq_9 >= 0);

	if(result.valid) {
		result.score = r.phq_1 + r.phq_2 + r.phq_3 + r.phq_4 + r.phq_5 + r.phq_6 + r.phq_7 + r.phq_8 + r.phq_9;

		if(result.score < 5) {
			result.severity = 'Minimal Symptoms (0-4)';
			result.recommendation = 'Support, educate to call if worse, return in one month';
		} else if(result.score < 10) {
			result.severity = 'Mild Symptoms (5-9)';
			result.recommendation = 'Support, educate to call if worse, return in one month';
		} else if(result.score < 15) {
			result.severity = 'Moderate Depression, Dysthymia, Major Depression (mild) (10-14)';
			result.recommendation = 'Support, watchful waiting, Antidepressant or psychotherapy, Antidepressant or psychotherapy';
		} else if(result.score < 20) {
			result.severity = 'Moderately Severe (15-19)';
			result.recommendation = 'Antidepressant and psychotherapy';
		} else {
			result.severity = 'Severe Depression (20-27)';
			result.recommendation = 'Antidepressant and psychotherapy (especially if not improved on monotherapy)';
		}

		if(r.phq_9 > 0) {
			result.suicide = true;
		} else {
			result.suicide = false;
		}
	}

	return result;
}
