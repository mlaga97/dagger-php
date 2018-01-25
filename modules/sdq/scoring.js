// TODO: Subscore validity instead of overall validity
scoring.sdq = function(r) {
	result = {
		'emotional': {},
		'conduct': {},
		'hyperactivity': {},
		'peerProblems': {},
		'prosocial': {},
		'impact': {},
		'total': {}
	};

	_(r).each(function(val, key) {
		r[key] = parseInt(val);
	});

	result.valid = (r.sdq_1 >= 0) && (r.sdq_2 >= 0) && (r.sdq_3 >= 0) && (r.sdq_4 >= 0) && (r.sdq_5 >= 0) && (r.sdq_6 >= 0) && (r.sdq_7 >= 0) && (r.sdq_8 >= 0) && (r.sdq_9 >= 0) && (r.sdq_10 >= 0) && (r.sdq_11 >= 0) && (r.sdq_12 >= 0) && (r.sdq_13 >= 0) && (r.sdq_14 >= 0) && (r.sdq_15 >= 0) && (r.sdq_16 >= 0) && (r.sdq_17 >= 0) && (r.sdq_18 >= 0) && (r.sdq_19 >= 0) && (r.sdq_20 >= 0) && (r.sdq_21 >= 0) && (r.sdq_22 >= 0) && (r.sdq_23 >= 0) && (r.sdq_24 >= 0) && (r.sdq_25 >= 0);

	if(result.valid) {
		// Emotional
		result.emotional.score = r.sdq_3 + r.sdq_8 + r.sdq_13 + r.sdq_16 + r.sdq_24;
		if(result.emotional.score < 14) {
			result.emotional.severity = 'Normal';
		} else if(result.emotional.score < 17) {
			result.emotional.severity = 'Borderline';
		} else {
			result.emotional.severity = 'Abnormal';
		}

		// Conduct
		result.conduct.score = r.sdq_5 + r.sdq_7 + r.sdq_12 + r.sdq_18 + r.sdq_22;
		if(result.conduct.score < 3) {
			result.conduct.severity = 'Normal';
		} else if(result.conduct.score < 4) {
			result.conduct.severity = 'Borderline';
		} else {
			result.conduct.severity = 'Abnormal';
		}

		// Hyperactivity
		result.hyperactivity.score = r.sdq_2 + r.sdq_10 + r.sdq_15 + r.sdq_21 + r.sdq_25;
		if(result.hyperactivity.score < 6) {
			result.hyperactivity.severity = 'Normal';
		} else if(result.hyperactivity.score < 7) {
			result.hyperactivity.severity = 'Borderline';
		} else {
			result.hyperactivity.severity = 'Abnormal';
		}

		// Peer Problems
		result.peerProblems.score = r.sdq_6 + r.sdq_11 + r.sdq_14 + r.sdq_19 + r.sdq_23;
		if(result.peerProblems.score < 3) {
			result.peerProblems.severity = 'Normal';
		} else if(result.peerProblems.score < 4) {
			result.peerProblems.severity = 'Borderline';
		} else {
			result.peerProblems.severity = 'Abnormal';
		}

		// Prosocial
		result.prosocial.score = r.sdq_1 + r.sdq_4 + r.sdq_9 + r.sdq_17 + r.sdq_20;
		if(result.prosocial.score < 5) {
			result.prosocial.severity = 'Abnormal';
		} else if(result.prosocial.score < 6) {
			result.prosocial.severity = 'Borderline';
		} else {
			result.prosocial.severity = 'Normal';
		}

		// Impact Supplement
		result.impact.score = r.sdq_28 + r.sdq_29 + r.sdq_30 + r.sdq_31 + r.sdq_32;
		if(result.impact.score < 1) {
			result.impact.severity = 'Normal';
		} else if(result.impact.score < 2) {
			result.impact.severity = 'Borderline';
		} else {
			result.impact.severity = 'Abnormal';
		}

		// Total
		result.total.score = result.emotional.score + result.conduct.score + result.hyperactivity.score + result.peerProblems.score;
		if(result.total.score < 14) {
			result.total.severity = 'Normal';
		} else if(result.total.score < 17) {
			result.total.severity = 'Borderline';
		} else {
			result.total.severity = 'Abnormal';
		}
	}

	return result;
}
