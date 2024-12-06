<?php

////////////////////////////////////
//
// Ink Plant Function to Unzip .gz Files
// https://inkplant.com/code/unzip-gz-files-php-function
// Last updated May 6, 2019
//
////////////////////////////////////

function un_gzip($gz_filename, $output_filename=null, $allow_overwrite=false, $read_chunk_length= 4096) {

	//error check zipped file
	if (!$gz_filename) { return un_gzip_error('Can’t unzip without a filename.'); }
	if (strtolower(substr($gz_filename,-3)) != '.gz') { return un_gzip_error('The provided filename does not have the expected .gz extension.'); }
	if (!file_exists($gz_filename)) { return un_gzip_error('The zipped file does not exist.'); }

	//error check output file
	if (!$output_filename) { $output_filename = substr($gz_filename,0,-3); } //just drop the .gz from incoming file by default
	if ((!$allow_overwrite) && file_exists($output_filename)) { return un_gzip_error('A file already exists at the output file location.'); }
	if (file_exists($output_filename) && (!is_writable($output_filename))) { return un_gzip_error('The output file location is not writeable.'); }

	//open the files
	$gz = gzopen($gz_filename, 'rb');
	if (!$gz) { return un_gzip_error('The zipped file cannot be opened for reading.'); }
	$out = fopen($output_filename, 'wb');
	if (!$out) { return un_gzip_error('The output file cannot be opened for writing.'); }

	//keep unzipping $read_chunk_length bytes at a time until we hit the end of the file
	while (!gzeof($gz)) {
		$unzipped = gzread($gz, $read_chunk_length);
	if (fwrite($out, $unzipped) === false) { return un_gzip_error('There was an error writing to the output file.'); }
	}

	//close the files
	gzclose($gz);
	fclose($out);

	//return the output filename
	return $output_filename;
}

//customize this function to handle errors however you need
function un_gzip_error($error) {
	echo '<div class="alert alert-danger">Error: '.$error.'</div>';
	return false;
}


?>