<?php

require_once("../../vendor/autoload.php");

define("TARGET_DIR", "target");
define("TARGET", str_replace("\\", "/", dirname(__FILE__))  . "/" . TARGET_DIR . "/GeneratedRequests.php");
define(
    "HEADER",
    "<?php

namespace Compucie\Congressus;

use Compucie\Congressus\Model;
use Compucie\Congressus\Page;
use Compucie\Congressus\Request\Request;

trait GeneratedRequests {
"
);
define(
    "TEMPLATE",
    '/**
* [Generated method]
*/
public function %name%(%parameters%): %return_type% {
$parameters = get_defined_vars();
$request = new Request("%http_method%", "%path%", $parameters);
return $this->submit($request, new Model\%response_type%);
}

'
);
define("BOOLS", ["published", "has_invoice", "is_available_for_members", "is_available_for_external", "is_completed", "archived", "hidden", "deceased", "actual", "comments_open", "use_direct_debit"]);

function parse_parameters(array $parameters, string $parameter_string)
{
    foreach ($parameters as $param) {
        $param_name = $param["name"];
        $param_optional = $param["required"] ? "" : "= null";

        $param_type = $param["schema"]["type"];
        $param_type = $param_type == "array" ? "array|{$param['schema']['items']['type']}" : $param_type;
        $param_type = str_ends_with($param_name, "_id") ? str_replace("string", "int", $param_type) : $param_type; // make all id's 'int'
        $param_type = str_replace("integer", "int", $param_type); // convert 'integer' to 'int'

        foreach (BOOLS as $bool) {
            if (str_contains($param_name, $bool)) {
                $param_type = "bool";
                break;
            }
        }

        $parameter_string = $parameter_string . "{$param_type} \${$param_name} {$param_optional},\n";
    }
    return $parameter_string;
}

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
    if (!isset($array[$http_method]) || @$array[$http_method]["deprecated"]) {
        continue;
    }

    $name = @str_replace([' ', '-'], '', lcfirst(ucwords($array[$http_method]["summary"])));
    $response_type = @str_replace(' ', '', ucwords(str_replace("#/components/schemas/", "", $array[$http_method]["responses"]["200"]["content"]["application/json"]["schema"]["\$ref"])));
    $return_type = @str_contains($response_type, "Pagination") ? "Page" : "Model\\" . $response_type;

    if (empty($name) || empty($response_type) || empty($return_type)) {
        echo $path . " misses data\n";
        continue; // missing data in openapi.json
    }

    $parameter_string = "";
    try {
        $parameter_string = @parse_parameters($array["parameters"], $parameter_string); // path parameters
    } catch (TypeError) {
    }
    try {
        $parameter_string = @parse_parameters($array[$http_method]["parameters"], $parameter_string); // query parameters
    } catch (TypeError) {
    }

    // generate the method
    $php_method = TEMPLATE;
    $php_method = str_replace("%name%", $name, $php_method);
    $php_method = str_replace("%optional%", $optional, $php_method);
    $php_method = str_replace("%return_type%", $return_type, $php_method);
    $php_method = str_replace("%http_method%", strtoupper($http_method), $php_method);
    $php_method = str_replace("%path%", $path, $php_method);
    $php_method = str_replace("%parameters%", $parameter_string, $php_method);
    $php_method = str_replace("%response_type%", $response_type, $php_method);

    file_put_contents(TARGET, $php_method, FILE_APPEND);
}

file_put_contents(TARGET, "}", FILE_APPEND);
