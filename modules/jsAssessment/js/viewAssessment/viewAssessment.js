var api = {};
var scoring = {};
var questionClasses = {}

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
	console.log(getSelectedAssessmentList(api.response))

	// Render each assessment
	_(assessments).each(function(assessment) {
		$('.jsScoringTarget').append(viewAssessment(assessment, getAssessmentResponse(assessment, api.response)));
	});

}

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

function viewAssessment(assessment, response) {
	var questionNumber = 1
	var truncatedClass = getClass(assessment);

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
	if(true || assessment.scoring.reviewAssessment.showResponses) {
		//console.log(truncatedClass + ' wants to show responses!')
		$container.append(showAssessmentResponses(assessment, response))
	} else {
		//console.log(truncatedClass + ' did not want to show responses!')
	}

	// Scoring
	if(assessment.scoring.reviewAssessment.showScore) {
		//console.log(truncatedClass + ' wants to show score!')
		// TODO: Should be appended?
		showAssessmentScore(assessment, response)
	} else {
		//console.log(truncatedClass + ' did not want to show scores!')
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
// TODO: Break this function up
function showAssessmentScore(assessment, response) {
	var truncatedClass = getClass(assessment);

	if(scoring[truncatedClass]) {
		score = scoring[truncatedClass](response)
		console.log(truncatedClass)
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

