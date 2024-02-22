<?php
define("TARGET_DIR", "target");
define("TARGET", str_replace("\\", "/", dirname(__FILE__))  . "/" . TARGET_DIR . "/GeneratedRequests.php");
define(
    "HEADER",
    "<?php

use Compucie\Congressus\Model;
use Compucie\Congressus\Page;
use Compucie\Congressus\Request\Parameters;
use Compucie\Congressus\Request\ParameterType\Query;
use Compucie\Congressus\Request\Request;

trait GeneratedRequests {
"
);
define(
    "TEMPLATE",
    '// Generated method
public function %name%(Parameters $parameters%optional%): %return_type% {
$request = new Request("%http_method%", "%path%", $parameters);
$request->allowParameters([
%parameters%]);
return $this->submit($request, new Model\%response_type%);
}

'
);

@mkdir(TARGET_DIR);
file_put_contents(TARGET, HEADER);

$json = json_decode(file_get_contents("openapi.json"), associative: true);
$paths = $json["paths"];

$http_method = "get";
foreach ($paths as $path => $array) {
    // reset
    $name = "";
    $response_type = "";
    $optional = "";
    $return_type = "";
    $parameters = "";

    // set
    if (!isset($array[$http_method])) {
        continue;
    }
    $array = $array[$http_method];

    $name = @str_replace([' ', '-'], '', lcfirst(ucwords($array["summary"])));
    $response_type = @str_replace(' ', '', ucwords(str_replace("#/components/schemas/", "", $array["responses"]["200"]["content"]["application/json"]["schema"]["\$ref"])));
    $optional = @str_contains($name, "list") ? " = new Parameters()" : "";
    $return_type = @str_contains($response_type, "Pagination") ? "Page" : "Model\\" . $response_type;

    if (empty($name) || empty($response_type) || empty($return_type)) {
        continue; // missing data in openapi.json
    }

    $parameters = "";
    foreach ($array["parameters"] as $parameter) {
        // Example: Query::page_size,
        $parameters = $parameters . ucfirst($parameter["in"]) . "::" . $parameter["name"] . ",\n";
    }

    // generate the method
    $php_method = TEMPLATE;
    $php_method = str_replace("%name%", $name, $php_method);
    $php_method = str_replace("%optional%", $optional, $php_method);
    $php_method = str_replace("%return_type%", $return_type, $php_method);
    $php_method = str_replace("%http_method%", strtoupper($http_method), $php_method);
    $php_method = str_replace("%path%", $path, $php_method);
    $php_method = str_replace("%parameters%", $parameters, $php_method);
    $php_method = str_replace("%response_type%", $response_type, $php_method);

    file_put_contents(TARGET, $php_method, FILE_APPEND);
}

file_put_contents(TARGET, "}", FILE_APPEND);