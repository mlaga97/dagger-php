function renderQuestions(section, assessment) {
	var $container = $('<div/>', {
		'class': 'questions'
	});

	// Give ourselves a platform to build on
	var $tbody = $('<tbody/>');

	_(section.questions).each(function(question, relativeQuestionNumber) {

		// Break out a few variables
		var type = assessment.types[question.type];

		// Check that the question class actually exists
		if(type.class in questionClasses) {

			// Check if we should attempt to render the header
			if(relativeQuestionNumber == 0 || !areFriends(question, section.questions[relativeQuestionNumber-1], assessment)) {

				if(relativeQuestionNumber != 0) {
					// We should push the last one first
					$('<table/>').append($tbody).appendTo($container);
					$tbody = $('<tbody/>');
				}

				// Check for a header renderer
				if('header' in questionClasses[type.class]) {
					var $header = questionClasses[type.class].header(question, relativeQuestionNumber, section, assessment);
					$tbody.append($header);
				}

			}

			// Check for a renderer
			if('render' in questionClasses[type.class]) {
				var $question = questionClasses[type.class].render(question, relativeQuestionNumber, section, assessment);
				$tbody.append($question);
			} else {
				console.log('No renderer available for questionClass "' + type.class + '"');
			}

		} else {
			console.log('questionClass "' + type.class + '" not available!');
		}

		// Increment the absoluteQuestionNumber field
		assessment.absoluteQuestionNumber++;

	});

	// Make sure we don't forget anything
	$('<table/>').append($tbody).appendTo($container);

	return $container;
}

function renderSection(section, assessment) {
	// Begin container
	var $container = $('<div/>', {
		'class': 'section'
	});

	// TODO: Remove array accesses from of conditionals
	// TODO: Are header and description duplicate functionality?
	// TODO: Preface then description or reverse?
	// TODO: Remove <br/> tags?

	// Show header
	if('header' in section) {
		var $center = $('<center/>');

		$center.append('<br/><br/>');
		$('<strong/>').append(section.header).appendTo($center);
		$center.append('<br/><br/>');

		$container.append($center);
	}

	// Show preface
	if('preface' in section) {
		var $center = $('<center/>');

		$center.append('<br/><br/><br/>');
		$center.append('Questions ' + assessment.absoluteQuestionNumber + ' - ' + (assessment.absoluteQuestionNumber+section.questions.length-1) + ' should be prefaced with');
		$center.append('<br/><br/><br/>');
		$('<div/>', {'class': 'question_criteria'}).append(section.preface).appendTo($center);

		$container.append($center);
	}

	// Show description
	if('description' in section) {
		$container.append('<br/>' + section.description + '<br/>');
	}

	// Render Questions
	renderQuestions(section, assessment).appendTo($container);

	return $container;
}

function renderAssessment(assessment) {
	// Begin container
	var $container = $('<div/>', {
		'class': 'jsonAssessment ' + assessment.metadata.class
	})

	// Show assessment title
	// TODO: title is probably the wrong key. fix.
	$('<h3/>').append(assessment.metadata.title).appendTo($container);

	// Render Sections
	_(assessment.sections).each(function(section) {
		renderSection(section, assessment).appendTo($container);
	});

	// Append the div to the form
	

	$('#jsonAssessments').append($container);
}

// TODO: Make absolute numbering work properly
function renderAssessments(response) {
	_(response.response).each(function(assessment) {
		assessment.absoluteQuestionNumber = 1;
		renderAssessment(assessment);
	});
}

$.ajax({
	dataType: 'json',
	url: '/api/v1/assessment/all',
	data: {},
	success: renderAssessments
});
