questionClasses = {
	'radioOptions': {
		'render': function(question, relativeQuestionNumber, section, assessment) {
			//	<tr>
			//		<td>
			//			<ol start='assessment.absoluteQuestionNumber'>
			//				<li>question.text</li>
			//			</ol>
			//			<label><input type='radio' name='' value=''>Text</label><br/>
			//		</td>
			//	</tr>

			var type = assessment.types[question.type];
			var $td = $('<td/>');

			var $li = $('<li/>').append(question.text);
			$('<ol/>', {'start': assessment.absoluteQuestionNumber}).append($li).appendTo($td);

			_(type.options).forOwn(function(value, optionText) {
				var $input = $('<input/>', {
					'type': 'radio',
					'name': question.id,
					'value': value
				});

				$('<label/>').append($input).append(optionText).appendTo($td);
				$td.append('<br/>');
			});

			return $('<tr/>').append($td);
		}
	},
	'radioScale': {
		'header': function(question, relativeQuestionNumber, section, assessment) {
			//	<tr>
			//		<th>Question</th>
			//		<th>optionText1</th>
			//		<th>optionText2</th>
			//  </tr>

			var type = assessment.types[question.type];
			var $container = $('<tr/>');

			// Add 'Question' field
			$('<th/>').append('Question').appendTo($container);

			// Add option fields
			_(type.options).forOwn(function(value, optionText) {
				$('<th/>').append(optionText).appendTo($container);
			});
			
			return $container;	
		},
		'render': function(question, relativeQuestionNumber, section, assessment) {
			//	<tr>
			//		<td>
			//			<ol start='assessment.absoluteQuestionNumber'>
			//				<li>question.text</li>
			//			</ol>
			//		</td>
			//		<td>
			//			<center>
			//				<label class='radio_caption'>
			//					<br/>
			//					<input type='radio' name='' value='' />
			//					<br/>
			//					optionText
			//				</label>
			//			</center>
			//		</td>
			//	</tr>

			var type = assessment.types[question.type];
			var $container = $('<tr/>');

			// Add numbering
			var $question = $('<td/>');
			var $li = $('<li/>').append(question.text);
			$('<ol/>', {'start': assessment.absoluteQuestionNumber}).append($li).appendTo($question);
			$container.append($question);

			// Add option fields
			_(type.options).forOwn(function(value, optionText) {
				var $option = $('<td/>');
				var $center = $('<center/>');
				var $label = $('<label/>', {'class': 'radio_caption'});

				$label.append('<br/>');
				$('<input/>', {
					'type': 'radio',
					'name': question.id,
					'value': value
				}).appendTo($label);
				$label.append('<br/>');
		
				// Hide label, if asked to	
				if('hideLabel' in type >= 0 && !type.hideLabel) {
					$label.append(optionText);
				}

				$label.appendTo($center);
				$center.appendTo($option);
				$option.appendTo($container);
			});

			return $container;
		}
	},
	'bitwise': {
		'header': function(question, relativeQuestionNumber, section, assessment) {
			
		},
		'render': function(question, relativeQuestionNumber, section, assessment) {
			
		}
	}
}

