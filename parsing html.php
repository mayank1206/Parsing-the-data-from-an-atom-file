<?php
$mysql_host="localhost";
$mysql_user="admin";
$mysql_password="admin4321";
$db="StoryWeaver";
$con=new mysqli($mysql_host,$mysql_user,$mysql_password,$db);
if($con->connect_error)
{
	die('cannot connect');
}
set_time_limit(1200);
ini_set('memory_limit','2000M');
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
require "vendor/autoload.php";
use PHPHtmlParser\Dom;

$dom = new Dom;
$dom->loadFromFile('catalog.html');
$contents = $dom->find('entry');
//$a=count($contents); // 10

 foreach ($contents as $content)
{


$data['id'] =(string)$content->find('id')->innerHtml;
    $data['title'] = (string)$content->find('title')->innerHtml;
   $data['updated'] = (string)$content->find('updated')->innerHtml;
  $data['summary'] = (string)$content->find('summary')->innerHtml;
    $data['author'] = (string)$content->find('author')->find('name')->innerHtml;
  $data['contributor'] = (string)$content->find('contributor')->find('name')->innerHtml;
     $data['language'] = (string)$content->find('dcterms:language')->innerHtml;
     $data['publisher'] = (string)$content->find('dcterms:publisher')->innerHtml; 
      $data['link1'] = (string)$content->find('link')[0]->getAttribute('href');
      $data['link2'] = (string)$content->find('link')[1]->getAttribute('href');
     $data['link3'] = (string)$content->find('link')[2]->getAttribute('href');
     $data['link4'] = (string)$content->find('link')[3]->getAttribute('href');
    
     $con->set_charset("utf8");
    $sql="INSERT INTO book(id,title,updated,summary,author,contributor,language,publisher,link1,link2,link3,link4) VALUES ('".$data['id']."','".str_replace("'", "''",$data['title'])."','".str_replace("'", "''",$data['updated'])."','".str_replace("'", "''",$data['summary'])."','".str_replace("'", "''",$data['author'])."','".str_replace("'", "''",$data['contributor'])."','".$data['language']."','".$data['publisher']."','".$data['link1']."','".$data['link2']."','".$data['link3']."','".$data['link4']."')";
    //var_dump($sql);die();
      if ($con->query($sql) === TRUE) {
     echo "New record created successfully". "<br>";
 	} else {
     echo "Error: " . $sql . "<br>" . $con->error;	
}

 }

?>