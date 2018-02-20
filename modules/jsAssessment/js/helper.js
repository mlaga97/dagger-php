function getSelectedAssessments(response) {
	selected = [];

	_(api.assessments).each(function(assessment) {
		if(api.response[assessment.metadata.id] == 1) {
			selected.push(assessment);
		}
	});

	return selected;
}

function getAssessmentResponse(assessment, response) {
	var fields = {};

	if(assessment.sections) {
		_(assessment.sections).each(function(section) {
			_(section.questions).each(function(question) {
				fields[question.id] = response[question.id]
			});
		});
	} else if(assessment.questions) {
		_(assessment.questions).each(function(question) {
			fields[question.id] = response[question.id]
		});
	}

	return fields;
}
