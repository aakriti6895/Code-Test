<!DOCTYPE html>
<!--Simple HTML form to take up the type of request (GET ping/sys_info/img_details)-->
<html lang="en">
<head>
  <title>Webservice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>PHP Rest API</h2>
  <form class="form-inline" action="" method="GET">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" class="form-control"  placeholder="Ping/Sys_info/Img_details" required/>
    </div>
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
  </form>
  <p>&nbsp;</p>
  
 <?php 
//Using cURL to get the content of the webpage.
function file_get_contents_curl($url) { 
	$ch = curl_init($url); 

	curl_setopt($ch, CURLOPT_HEADER, 0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	$data = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
//Ping request: Checking the status code to see if connection to the url successful. 
	if($httpcode>=200 && $httpcode<300)
		 {echo "pong"; 
		 echo "<br>";}
        else
		 echo "error"; 
    	curl_close($ch); 
	return $data;   }
//API requires to enter the request type and when submit button is pressed, checks with the type and performs the necessary function.
if(isset($_GET['submit']))
	{	
$name = $_GET['name'];
//If Ping, then return "pong" if successful.
if ($name == "Ping")
{
echo "Sending ping request...";
$data = file_get_contents_curl( 
'https://www.pond5.com/photo/11497188/samuel-beckett-bridge-dublin-ireland.html');
}
//If Sys_info, then information about php version and system details.
if ($name == "Sys_info")
{
$system['info'] = phpinfo(1);
echo json_encode($system);
}
//If Img_details, get the image details.
if ($name == "Img_details")
{
$data = file_get_contents_curl( 
'https://www.pond5.com/photo/11497188/samuel-beckett-bridge-dublin-ireland.html');
$dom =  new DOMDocument;
libxml_use_internal_errors($data);
$dom->loadHTML($data);

echo "Image details are as follows:";
echo "<br>";
//Scraping out the image information by providing parent div id.
$tags1 = $dom->getElementsByTagName('div');
for($i=0; $i < $tags1->length; $i++)
{
$grab1 = $tags1->item($i);
if($grab1->getAttribute('item_id') == 11497188)
echo  $grab1->getAttribute('formats_data'); //Response already in json.
}
//Scraping out the image itself.
$tags = $dom->getElementsByTagName('img');
for($i=0; $i < $tags->length; $i++)
{
$grab = $tags->item($i);
$response['title'] = $grab->getAttribute('alt');
echo "<img src=" . $grab->getAttribute('src') . " />"."\n";
}
echo json_encode($response); //Encoding response in json.
}
}
?>
</div>
</body>
</html>

 

