<?php
if($this->error->getCode()=='404') {
 header("HTTP/1.0 404 Not Found");
 $url=JURI::root()."404";
 $data = file_get_contents($url) or die("Cannot open URL");
    echo $data; 
}

?>