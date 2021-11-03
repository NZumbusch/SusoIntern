<?php
// Returns current User Data

$api->CSRF();


if (isset($_SESSION["user"])) {
    if (!isset($user)) {
        $api->throw("Permissionerror", "No user provided / logged in.");
    }

    if (!isset($input["roomName"])) {
        $api->throw("Requesterror", "Please provide roomName.");
    }   

    if (count($user->get_rooms()) > 50) {
        $api->throw("Permissionerror", "Normal Accounts cannot create new rooms if they are alreay in 50+. Please leave rooms in order to be able to create a new one.");
    }

    $api->send($user->createNewRoom($input["roomName"]), "Created new room.");
}
?>
