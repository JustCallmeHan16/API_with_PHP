<?php

//* server logic
function requestProcess($name, $gmail, $photo, $dir_images, $dir_data, $base_url)
{
    if ($name && $gmail && !empty($photo) && $photo["error"] === 0) {

        //* user info
        $user_info = [
            "id" => uniqid(),
            "name" => $name,
            "gmail" => $gmail
        ];

        //* create a dir for images
        if (!is_dir($dir_images)) {
            mkdir($dir_images);
        }

        //* create photo url
        if (!empty($photo) && $photo["error"] === 0) {
            $tmp_file = $photo["tmp_name"];
            $new_photo_name = $dir_images . "/" . uniqid() . "_photo." . pathinfo($photo["name"])["extension"];
            move_uploaded_file($tmp_file, $new_photo_name);
            $photo_url = $base_url . $new_photo_name;
            $user_info["image"] = $photo_url;
        }

        //* create a dir for data
        if (!is_dir($dir_data)) {
            mkdir($dir_data);
        }

        //* convert array to json object
        $data_array = [];
        $file_path = $dir_data . "/" . "user_data.json";

        if (file_exists($file_path) && filesize($file_path)) {
            $data_array = json_decode(file_get_contents($file_path), true);
        }

        array_push($data_array, $user_info);

        $user_data = json_encode($data_array);
        $open = fopen($file_path, "w");
        fwrite($open, $user_data);
        fclose($open);

        header("HTTP/1.0 201 Created");
        echo $user_data;
    } else {
        header("HTTP/1.0 404 Not Found");
        echo json_encode(["error" => "All fileds must be fill"]);
    }
}

//* detail logic
function searchDataByID($parameter, $file_path)
{
    if (!empty($file_path) && filesize($file_path)) {

        $data = json_decode(file_get_contents($file_path), true);

        foreach ($data as $user) {
            if ($user["id"] === $parameter) {
                echo json_encode($user);
            }
        }
    } else {
        header("HTTP/1.0 404 Data Not Found");
        echo json_encode(["error" => "Data Not Found"]);
    }
}

function searchDataByName($parameter, $file_path)
{
    if (!empty($file_path) && filesize($file_path)) {

        $data = json_decode(file_get_contents($file_path), true);

        foreach ($data as $user) {
            if ($user["name"] === $parameter) {
                echo json_encode($user);
            }
        }
    } else {
        header("HTTP/1.0 404 Data Not Found");
        echo json_encode(["error" => "Data Not Found"]);
    }
}
