<?php

header("Content-type:Application/json");

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $folder = "data";
    $file_path = "user_data.json";
    $path = $folder . "/" . $file_path;

    if (is_file($path) && filesize($path)) {

        $user_data = file_get_contents($path);

        header("HTTP/1.1 200 OK");
        echo $user_data;

    } else {
        header("HTTP/1.1 404 Not Found");
        echo json_encode(["error" => "Data Not Found"]);
    }
} else {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(["error" => "Not Found Api"]);
}
