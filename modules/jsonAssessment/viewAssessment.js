var api = {};
var scoring = {};

// Get session data
$.getJSON('/api/v1/session', function(raw) {
	api.session = raw.response;

	$.when(

		// Get response
		$.getJSON('/api/v1/response/' + api.session.id, function(raw) {
			api.response = raw.response;
		}),

		// Get assessments
		// TODO: Only get the relevent assessments (may be better done server-side)
		$.getJSON('/api/v1/assessment/all', function(raw) {
			api.assessments = raw.response;
		})
	
	).then(viewAssessments);
	
});

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

function showScoring(assessment, response) {
}

function showResponses(assessment, response) {
	$container = $('<div>', {
		'class': assessment.metadata.class + ' showResponses'
	});
	
	

	return $container;
}

function viewAssessment(assessment, response) {
	/*

		<div class='sf36 jsonAssessment viewAssessment'>
			<h3>SF-36</h3>
			
			<!-- If responses selected -->
			<!-- If scoring selected -->

		</div>

	*/

	console.log(response);

	var truncatedClass = assessment.metadata.class.split(" ")[0];
	if(scoring[truncatedClass]) {
		console.log(scoring[truncatedClass](response));
	}

	$container = $('<div>', {
		'class': assessment.metadata.class + ' viewAssessment'
	});

	// Assessment Header
	$('<h3>').append(assessment.metadata.text).appendTo($container);

	// Responses
	// TODO: Either switch based on [re]viewAssessment, or modify json so that it doesn't matter
	if(assessment.scoring.reviewAssessment.showResponses) {
	}

	// Scoring
	if(assessment.scoring.reviewAssessment.showScore) {
	} else {
		console.log(assessment.metadata.class + ' does not want to show scores!');
	}
	
	$('<hr>').appendTo($container);
	return $container;
}

function viewAssessments() {

	// Get the checked assessments
	var assessments = getSelectedAssessments(api.response);

	// Render each assessment
	_(assessments).each(function(assessment) {
		$('.jsScoringTarget').append(viewAssessment(assessment, getFields(assessment, api.response)));
	});

}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

var scoreClasses = {};

scoreClasses.sumOfValues = function(assessment, response) {
	
}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

function getSelectedAssessments(response) {
	selected = [];

	_(api.assessments).each(function(assessment) {
		if(api.response[assessment.metadata.id] == 1) {
			selected.push(assessment);
		}
	});

	return selected;
}

function getFields(assessment, response) {
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
