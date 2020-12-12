<?php
//setlocale(LC_ALL, 'ru_RU.CP1251', 'rus_RUS.CP1251', 'Russian_Russia.1251');


function csv_to_array($filename='seo.csv', $delimiter=';')
{
	$filePathNew = $_SERVER["DOCUMENT_ROOT"].'/aweb_seo/';
	
	if(!file_exists($filePathNew.$filename) || !is_readable($filePathNew.$filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filePathNew.$filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}
$massObj = csv_to_array();

?>