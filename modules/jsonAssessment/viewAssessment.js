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

function viewAssessments() {

	// Only render the selected assessments
	var assessments = getSelectedAssessments(api.response);

	// Render each assessment
	_(assessments).each(function(assessment) {
		$('.jsScoringTarget').append(viewAssessment(assessment, getFields(assessment, api.response)));
	});

}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

function viewAssessment(assessment, response) {
	var questionNumber = 1
	var truncatedClass = assessment.metadata.class.split(' ')[0];

	// Start container
	// TODO: Remove jsonAssessment class
	$container = $('<div>', {
		'class': assessment.metadata.class + ' viewAssessment jsonAssessment'
	});

	// Assessment title
	// Assessment Header
	$('<h3>').append(assessment.metadata.text).appendTo($container);
	
	// TODO: Extra header information, flags?

	// Responses
	// TODO: Either switch based on [re]viewAssessment, or modify json so that it doesn't matter
	if(assessment.scoring.reviewAssessment.showResponses) {
		console.log(truncatedClass + ' wants to show responses!')
		$container.append(showAssessmentResponses(assessment, response))
	} else {
		console.log(truncatedClass + ' did not want to show responses!')
	}

	// Scoring
	if(assessment.scoring.reviewAssessment.showScore) {
		consol.log(truncatedClass + ' wants to show score!')
		// TODO: Should be appended?
		showAssessmentScore(assessment, response)
	} else {
		console.log(truncatedClass + ' did not want to show scores!')
	}

	// End container
	$('<hr>').appendTo($container);
	return $container;
}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

// TODO: Stop using html literals
// TODO: Severity?
function showAssessmentScore(assessment, response) {
	var truncatedClass = assessment.metadata.class.split(' ')[0];

	if(scoring[truncatedClass]) {
		score = scoring[truncatedClass](response)
		console.log(score)

		if(score.valid) {
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
			console.log(truncatedClass + ' did not provide valid score!')
		}
	} else if(assessment.scoring.viewAssessment.scoreType) { // TODO: [re]viewAssessment
		console.log(truncatedClass + ' has jsonAssessment scoring that we haven not added yet!')
	} else {
		console.log(truncatedClass + ' did not provide scoring!')
	}
}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

function showAssessmentResponses(assessment, response) {
	var questionNumber = 1
	var $container = $('<div>', {
		'class': assessment.metadata.class + ' showResponses'
	});

	// Header
	$container.append('<table><tr><th>Question</th><th>Response</th></tr>')

	// TODO: Split into function
	_(assessment.sections).each(function(section) {
		// Show preface
		// Render questions
		_(section.questions).each(function(question) {
			// Calulate answer
			var answer
			if(response[question.id]) {
				// TODO: Functions
				if(assessment.scoring.reviewAssessment.responseFormat == 'human_readable') {
					answer = 'IMPLEMENT ME!'
				} else {
					answer = response[question.id]
				}
			} else {
				answer = 'No Response'
			}

			// Append
			$container.append(`
				<tr>
					<td>
						<ol start='${questionNumber}'>
							<li>${question.text}</li>
						</ol>
					</td>
					<td class='score'>${answer}</td>
				</tr>
			`)
			questionNumber++
		})
	})

	$container.append('</table>')

	return $container;
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
