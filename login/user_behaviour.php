<?php

$user = $_SESSION["userId"];

$client = "";
$forward = "";

$remote = $_SERVER["REMOTE_ADDR"];
$agent = $_SERVER ['HTTP_USER_AGENT'];
$program = basename($_SERVER['SCRIPT_NAME']);

$url = $_SERVER['REQUEST_URI'];
$uri = parse_url($url, PHP_URL_PATH);

$app_version = "TMVEP V6 - AD (digital ocean)";

$sql = "
INSERT INTO user_behavior 
(app_name, uri, user, program, client, forward, remote, user_agent, app_version)
 VALUES ('EP', '$uri', '$user', '$program', '$client', '$forward', '$remote', '$agent', '$app_version')
";
$xdata = new sqldata();
$xdata->sql_query = $sql;
$xdata->save_sql_data();

?>