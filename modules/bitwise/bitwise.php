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

	// Reverse the order, so it is the same as given.
	return array_reverse($values);
}

// Takes a composite integer, returns an array of bools in the form of a string.
function unmaskValuesToString($bitwise, $index) {
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

	// Reverse the order, so it is the same as given.
	$values = array_reverse($values);
	$string = '';
	$first = true;
	foreach ($values as $key=>$value) {
		if($value) {
			// Comma Separation
			if($first) {
				$first = false;
			} else {
				$string = $string . ', ';
			}

			$string = $string . $key;
		}
	}
	
	return $string;
}

?>