<!DOCTYPE html>
<html>
<head>
<title>
Wonderful Website
</title>
</head>
<body>
<p>
<?php
function CallAPI($add,$key){
	// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $add);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERPWD, $key.":");
curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
/*
	switch ($meth)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, FALSE);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
            case "GET":
            
            break;
        default:
            //if ($data)
                //$url = sprintf("%s?%s", $url, http_build_query($data));
        break;
    }
*/


// grab URL and pass it to the browser
    $result=curl_exec($ch);
// close cURL resource, and free up system resources
    curl_close($ch);

    return $result;
}

//$data= CallAPI("GET","https://sandbox.youracclaim.com/api/v1/organizations/b9c6023b-a963-4e07-b48c-db22c6abcd3a/users","yNeJFVOmM4IPpmjPJBOk");
$data= CallAPI("https://sandbox.youracclaim.com/api/v1/organizations/b9c6023b-a963-4e07-b48c-db22c6abcd3a/users","yNeJFVOmM4IPpmjPJBOk");
$json_a = json_decode($data, true);

foreach ($json_a as $person_name => $person_a) {
    echo $person_a;
//echo $info;
//b9c6023b-a963-4e07-b48c-db22c6abcd3a
?>
</body>
</html>
