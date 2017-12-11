// TODO: This, but automatically.
function areFriends(question1, question2, assessment) {

	// Check if questions have same type
	if(question1.type == question2.type) {
		return true;
	}

	// Check if question1 has question2 as a friend
	if('friends' in assessment.types[question1.type]) {
		if($.inArray(question2.type, assessment.types[question1.type].friends) >= 0) {
			return true;
		}
	}

	// Check if question2 has question1 as a friend
	if('friends' in assessment.types[question2.type]) {
		if($.inArray(question1.type, assessment.types[question2.type].friends) >= 0) {
			return true;
		}
	}

	// They aren't friends! (;_;)
	return false;

}

