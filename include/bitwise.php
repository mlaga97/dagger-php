<?php

// Takes an array of bools, returns a composite integer.
function maskValues($values) {
	$bitwise = 0;

	// Use each value as a mask to it's place value.
	foreach ($values as $column => $value)
		$bitwise += pow(2, $column) * (int)$value;

	return $bitwise;
}

// Takes a composite integer, returns an array of bools.
function unmaskValues($bitwise, $column=0) {
	$values = array();

	// Figure out how many places we have.
	while(pow(2, $column) <= $bitwise) {
		$column++;
	}

	// Use that information to descend through
	for(; $column >= 1; $column--) {
		$bitmask = pow(2, $column-1); // Calculate bitmask

		// Subtract when possible, and make note.
		if ($bitwise >= $bitmask) {
			$bitwise -= $bitmask;
			array_unshift($values, true);
		} else {
			array_unshift($values, false);
		}
	}

	return $values;
}

// Takes a composite integer, returns an array of bools.
// NOTE: Prints in reverse order? Not entirely sure why, but it's just a demo.
function unmaskValuesIndexed($bitwise, $index) {
	$values = array();
	$column = count($index);

	// Use that information to descend through
	for(; $column >= 1; $column--) {
		$bitmask = pow(2, $column-1); // Calculate bitmask

		// Subtract when possible, and make note.
		if ($bitwise >= $bitmask) {
			$bitwise -= $bitmask;
			$values[$index[$column-1]] = true;
		} else {
			$values[$index[$column-1]] = false;
		}
	}

	return $values;
}

// Takes a composite integer, returns an array of bools in the form of a string.
// NOTE: Prints in reverse order? Not entirely sure why, but it's just a demo.
function unmaskValuesToString($bitwise, $index) {
	$values = '';
	$column = count($index);
	$first = true;

	// Use that information to descend through
	for(; $column >= 1; $column--) {
		$bitmask = pow(2, $column-1); // Calculate bitmask

		// Subtract when possible, and make note.
		if ($bitwise >= $bitmask) {
			$bitwise -= $bitmask;

			// Comma Separation
			if($first) {
				$first = false;
			} else {
				$values = $values . ', ';
			}

			$values = $values . $index[$column-1];
		}
	}

	return $values;
}

?>