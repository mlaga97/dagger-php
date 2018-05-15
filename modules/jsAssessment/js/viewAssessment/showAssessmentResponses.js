// TODO: Break up this function
function showAssessmentResponses_old(assessment, response) {
	var truncatedClass = getClass(assessment);

	var questionNumber = 1
	var $container = $('<div>', {
		'class': assessment.metadata.class + ' showResponses'
	});

	// Header
	$container.append('<table><tr><th>Question</th><th>Response</th></tr>')

	_(assessment.sections).each(function(section) {
		// Show preface
		// Render questions
		_(section.questions).each(function(question) {
			// Calulate answer
			// TODO: Empty value?
			var answer
			if(response[question.id]) {
				// Get the human readable response
				if(assessment.scoring.reviewAssessment.responseFormat == 'human_readable') {
					// TODO: Fix this utter piece of shit
					answer = _.invert(assessment.types[question.type].options)[response[question.id]]
				} else {
					console.log('Did not want human_readable?')
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

function showAssessmentResponses(assessment, response) {
	var truncatedClass = getClass(assessment);
	console.log(truncatedClass)

	return showAssessmentResponses_old(assessment, response);
}
