<?php

header("Content-type:Application/json");

@include_once("./logic/api_logic.php");

//* Base URL 
$base_url = "http://" . $_SERVER["HTTP_HOST"] . "/";

//* request
$name = $_POST["name"];
$gamil = $_POST["gmail"];
$photo = $_FILES["photo"];

$dir_images = "images";
$dir_data = "data";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    requestProcess($name,$gamil,$photo,$dir_images,$dir_data,$base_url);
    
} else {
    header("HTTP/1.0 500 Server Error");
    echo json_encode(["error" => "Server Error"]);
}
