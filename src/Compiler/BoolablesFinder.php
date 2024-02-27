<?php

$spec = json_decode(file_get_contents("openapi.json"), associative: true);
$paths = $spec["paths"];
$boolables = array();

foreach ($paths as $path) {
    $parameters = @$path["get"]["parameters"];
    if (is_null($parameters)) {
        continue;
    }
    foreach ($parameters as $param) {
        try {
            if (count(@$param["schema"]["enum"]) == 2) {
                array_push($boolables, $param["name"]);
            }
        } catch (TypeError) {
            continue;
        }
    }
}

print_r(array_unique($boolables));
