<?php
 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Headers: *");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {    
    exit(0);
} 

define('SECRET', "L)ask*-+f:l=oAa|u{t{fcz`o#=aY8");

include_once 'config/config.php';
 
$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$path = str_replace("kf6012/coursework/api/","",$path);
 
try {
    switch($path) {
        case '/':
            $endpoint = new Base();
            break;
        case '/papers/':
        case '/papers':
            $endpoint = new Papers();
            break;
        case '/authors/':
        case '/authors':
            $endpoint = new Authors();
            break;
        case '/auth':
            $endpoint = new Authenticate();
            break;
		case '/update/':
		case '/update':
			$endpoint = new Update();
			break;
        default:
            $endpoint = new ClientError("Path not found: " . $path, 404);
    }
}
catch(ClientErrorException $e) {
    $endpoint = new ClientError($e->getMessage(), $e->getCode());
}
 
$response = $endpoint->getData();
echo json_encode($response);

?>