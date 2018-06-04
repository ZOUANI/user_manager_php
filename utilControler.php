<?php
function encode($data) {
    return json_encode(($data), JSON_UNESCAPED_UNICODE);
}

function printEncode($data) {
    echo encode($data);
}

function decode($local) {
    if ($local == 1)
        return $_GET;
    else if ($local == 2)
        return $_POST;
    else
        return json_decode(file_get_contents('php://input'), true);
}
function forward($pageToForward) {
    header("location:$pageToForward");
    exit();
}

?>
