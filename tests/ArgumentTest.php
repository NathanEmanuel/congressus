<?php
require_once("../src/Arguments.php");
require_once("../src/QueryParameter.php");

$arguments = new Arguments();
$arguments->add(QueryParameter::published, true);
$arguments->add(QueryParameter::order, "start:asc");
print_r($arguments);
