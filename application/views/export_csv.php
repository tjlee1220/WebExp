<?php
header("Content-type: text/csv");
header("Cache-Control: no-store, no-cache");
header("Content-Disposition: attachment; filename=".$filename.".csv");

$outstream = fopen("php://output",'w');

foreach( $data as $row )
{
	//fputcsv($outstream, $row, ',', '"');
	fputcsv($outstream, $row);
}

//fputcsv($outstream,array(),',', '"');
fputcsv($outstream,array());

foreach($stim_map as $row)
{
	//fputcsv($outstream, $row, ',', '"');
	fputcsv($outstream, $row);
}

fclose($outstream);

//echo var_dump($stim_map);

?>