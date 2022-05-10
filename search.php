<?php

// checking arguments' length, if less than 1 stop
if ($argc > 3) {

	// check if the file exists in this location
	// and if the extension is csv
	if(!file_exists($argv[1])) {
		die("Please insert the correct location of the CSV file.");
	}
	if(pathinfo($argv[1])['extension'] != "csv") {
		die("Please try again with a csv file.");
	}

	// checking the index, if it's not valid stop.
	if(!is_numeric($argv[2]) || $argv[2] < 1 || empty($argv[2])) {
		die("Please insert a valid index.");
	}

	// initializing variables
	$column_index = intval($argv[2]) - 1;
	$search_key = strval($argv[3]);
	$rows_array = array();
	$row = 1;
	$filename = $argv[1]; 

	// read file as csv and handle the stream with a limited length to 1000 and comma as a separator
	if (($handle = fopen($filename, "r")) !== FALSE) {
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
	die("Try again with valid arguments.");
}

?>