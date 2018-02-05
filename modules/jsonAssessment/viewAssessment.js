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

	//console.log(response);

	var truncatedClass = assessment.metadata.class.split(" ")[0];

	// TODO: Remove jsonAssessment class
	$container = $('<div>', {
		'class': assessment.metadata.class + ' viewAssessment jsonAssessment'
	});

	// Assessment Header
	$('<h3>').append(assessment.metadata.text).appendTo($container);

	// Responses
	// TODO: Either switch based on [re]viewAssessment, or modify json so that it doesn't matter
	if(assessment.scoring.reviewAssessment.showResponses) {
	}

	// Scoring
	// TODO: Do we need the extra data?
	if(scoring[truncatedClass]) {
		score = scoring[truncatedClass](response)
		console.log(score)

		if(score.valid) {
			if(assessment.scoring.reviewAssessment.showScore) {
				// TODO: Don't use html strings
				// TODO: This should probably be a loader of some sort
				if(score.score) {
					$container.append(`
						<table>
							<tbody>
								<tr>
									<td>Score</td>
									<td class="score">${score.score}</td>
								</tr>
								<tr>
									<td colspan="2">${score.recommendation}</td>
								</tr>
							</tbody>
						</table>
					`)
				} else if(score.scores) {
					$container.append(`
						<table>
							<tbody>
					`)

					_(score.scores).each(function(value, key) {
						$container.append(`
								<tr>
									<td>${key}</td>
									<td>${value}</td>
								</tr>
						`)
					})

					$container.append(`
							</tbody>
						</table>
					`)
				} else {
					console.log(truncatedClass + ' did not generate a valid response!')
				}
			} else {
				console.log(truncatedClass + ' did not want to show scores!')
			}
		} else {
			console.log(truncatedClass + ' did not provide valid score!')
		}
	} else {
		console.log(truncatedClass + ' did not provide scoring!')
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
