
<?php
require_once "HTTP/Request.php";

$req =& new HTTP_Request("http://api.getsatisfaction.com/topics");
$req->setBasicAuth("jenn@getsaitsfaction.com", "GoS0unders");

$response = $req->sendRequest();

if (PEAR::isError($response)) {
    echo $response->getMessage();
} else {
    echo $req->getResponseBody();
}
?>