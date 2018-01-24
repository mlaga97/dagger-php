scoring.pcl = function(r) {
	result = {};

	_(r).each(function(val, key) {
		r[key] = parseInt(val);
	});

	result.valid = (r.pcl_1 >= 0) && (r.pcl_2 >= 0) && (r.pcl_3 >= 0) && (r.pcl_4 >= 0) && (r.pcl_5 >= 0) && (r.pcl_6 >= 0) && (r.pcl_7 >= 0) && (r.pcl_8 >= 0) && (r.pcl_9 >= 0) && (r.pcl_10 >= 0) && (r.pcl_11 >= 0) && (r.pcl_12 >= 0) && (r.pcl_13 >= 0) && (r.pcl_14 >= 0) && (r.pcl_15 >= 0) && (r.pcl_16 >= 0) && (r.pcl_17 >= 0);

	if(result.valid) {
		result.score = r.pcl_1 + r.pcl_2 + r.pcl_3 + r.pcl_4 + r.pcl_5 + r.pcl_6 + r.pcl_7 + r.pcl_8 + r.pcl_9 + r.pcl_10 + r.pcl_11 + r.pcl_12 + r.pcl_13 + r.pcl_14 + r.pcl_15 + r.pcl_16 + r.pcl_17;

		// TODO: Check in database for actual cutoff (45-50)
		// SELECT cutoff_value FROM scoring WHERE name ="PCL-C" AND type = "PCL-cutoff"
		if(result.score < 45) {
			result.severity = 'FIXME';
			result.recommendation = 'Patient DOES NOT show signs of Post Traumatic Stress.';
		} else {
			result.severity = 'FIXME';
			result.recommendation = 'Patient shows signs of Post Traumatic Stress.';
		}
	}

	return result;
}
