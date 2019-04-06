<?php
require 'config/config.php';

// comment to show E_NOTICE [undefinied variable etc.], comment if you want make script and see all errors
error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE);

// true = show sent queries and SQL queries status/status code/error message
define('DEBUG_DATABASE', false);
define('INITIALIZED', true);

if (!defined('ONLY_PAGE')) {
    define('ONLY_PAGE', true);
}

// check if site is disabled/requires installation
include_once './system/load.loadCheck.php';

// fix user data, load config, enable class auto loader
include_once './system/load.init.php';

// DATABASE
include_once './system/load.database.php';
if (DEBUG_DATABASE) {
    Website::getDBHandle()->setPrintQueries(true);
}

// DATABASE END
/*error example:
{
"errorCode":3,
"errorMessage":"Account name or password is not correct."
}
 */

# Declare variables with array structure
$characters = array();
$playdata = array();
$data = array();
$isCasting = false;

# error function
function sendError($msg)
{
    $ret = array();
    $ret["errorCode"] = 3;
    $ret["errorMessage"] = $msg;
    die(json_encode($ret));
}

# getting infos
$request = file_get_contents('php://input');
$result = json_decode($request, true);

# account infos
$accountName = $result["accountname"];
$password = $result["password"];

# game port
$port = 7172;

# check if player wanna see cast list
if (strtolower($accountName) == "cast") {
    $isCasting = true;
}

if ($isCasting) {

    $casts = $SQL->query("SELECT `player_id` FROM `live_casts`")->fetchAll();
    if (count($casts[0]) == 0) {
        sendError("There is no live casts right now!");
    }
    foreach ($casts as $cast) {
        $character = new Player();
        $character->load($cast['player_id']);
        if ($character->isLoaded()) {
            $char = array("worldid" => 0, "name" => $character->getName(), "ismale" => (($character->getSex() == 1) ? true : false), "tutorial" => false);
            $characters[] = $char;
        }
    }
    $port = 7173;
    $lastLogin = 0;
    $premiumAccount = true;
    $timePremium = 0;

} else {

    $account = new Account();
    $account->find($accountName);
    if (!$account->isLoaded()) {
        sendError("Failed to get account. Try again!");
    }
    if ($account->getPassword() != Website::encryptPassword($password)) {
        sendError("The password for this account is wrong. Try again!");
    }
    foreach ($account->getPlayersList() as $character) {
        $char = array("worldid" => 0, "name" => $character->getName(), "ismale" => (($character->getSex() == 1) ? true : false), "tutorial" => false);
        $characters[] = $char;
    }
    $lastLogin = $account->getLastLogin();
    $premiumAccount = ($account->isPremium()) ? true : false;
    $timePremium = time() + ($account->getPremDays() * 86400);

}

$session = array(
    "fpstracking" => false,
    "isreturner" => true,
    "returnernotification" => false,
    "showrewardnews" => false,
    "sessionkey" => $accountName . "\n" . $password,
    "lastlogintime" => $lastLogin,
    "ispremium" => $premiumAccount,
    "premiumuntil" => $timePremium,
    "status" => "active",
);

$world = array(
    "id" => 0,
    "name" => $config['server']['serverName'],
    "externaladdress" => $config['server']['ip'],
    "externalport" => $port,
    "previewstate" => 0,
    "location" => "BRA",
    "anticheatprotection" => false,
    "externaladdressunprotected" => $config['server']['ip'],
    "externaladdressprotected" => $config['server']['ip'],
    "externalportunprotected" => $port,
    "externalportprotected" => $port,
);

$data["session"] = $session;
$playdata["worlds"] = array($world);
$playdata["characters"] = $characters;
$data["playdata"] = $playdata;

echo json_encode($data);
