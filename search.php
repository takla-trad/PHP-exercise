<?php

// checking arguments' length, if less than 1 stop
if ($argc > 1) {

	// checking the index, if it's not valid stop.
	if(!is_numeric($argv[1]) || $argv[1] < 1 || empty($argv[1])) {
		die("Please insert a valid index.");
	}

	// initializing variables
	$column_index = intval($argv[1]) - 1;
	$search_key = strval($argv[2]);
	$rows_array = array();
	$row = 1;

	// read file as csv and handle the stream with a limited length to 1000 and comma as a separator
	if (($handle = fopen("file.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			
			// check if the index is out of bound
			if($column_index >= count($data)) {
				fclose($handle);
				die("Index is out of bound. Try again with a lower index.");
			}
			
			// check if data at column index is equal to the search key 
			// if yes, push the row inside rows_array
			$result = stristr($data[$column_index], $search_key);
			if($result) {
				array_unshift($data, strval($row));
				array_push($rows_array, $data);
			}

			//increment row counter
			$row++;
		}

		// close stream 
		fclose($handle);
	}

	// print matches found
	if(count($rows_array) > 0) { 
		foreach($rows_array as $value) {
			echo implode(', ', $value) . "\n";
		}
	}
	else {
		die("Nothing was found for the searching criteria.");
	}
}
else {
	die("Try again with valid arguments");
}

?>