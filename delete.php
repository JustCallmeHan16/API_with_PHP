<?php

header("Content-type:Application/json");

$id = $_GET["id"];
$file_path = "data/user_data.json";
$data = [];

if ($_SERVER["REQUEST_METHOD"] === "DELETE") {

    if (!empty($id)) {

        if (file_exists($file_path) && filesize($file_path)) {

            $data = json_decode(file_get_contents($file_path), true);
        }

        foreach ($data as $key => $user) {

            if ($user["id"] === $id) {
                unset($data[$key]);
            }
        }

        $open = fopen($file_path, "w");
        fwrite($open, json_encode($data));
        fclose($open);

        header("HTTP/1.0 201 OK");
        echo json_encode(["message" => "Deleted Successful"]);

    } else {

        header("HTTP/1.0 404 Server Error");
        echo json_encode(["error" => "User Not Found"]);

    }
} else {

    header("HTTP/1.0 500 Server Error");
    echo json_encode(["error" => "Server Error"]);

}
