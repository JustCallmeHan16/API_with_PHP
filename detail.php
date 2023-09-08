<?php

header("Content-type:Application/json");

$dir = "data";
$id = $_GET["id"];
$name = $_GET["name"];

$file_path = $dir . "/" . "user_data.json";

@include_once("./logic/api_logic.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    if (!empty($id)) {

        searchDataByID($id,$file_path);
        die();
        
    }

    if (!empty($name)) {

        searchDataByName($name,$file_path);
        die();
        
    }

} else {
    header("HTTP/1.0 500 Server Error");
    echo json_encode(["error" => "Server Error"]);
}
