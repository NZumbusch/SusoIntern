<?php
// Returns current User Data

$api->CSRF();


if (isset($_SESSION["user"])) {
    if (!isset($user)) {
        $api->throw("Permissionerror", "No user provided / logged in.");
    }

    if (!isset($input["roomId"])) {
        $api->throw("Requesterror", "Please provide roomId.");
    }

    $name = false;
    $rooms = $user->get_rooms();
    
    foreach($rooms as $key => $value) {
        if (intval($value["id"]) === intval($input["roomId"])) {
            $name = $value["name"];
        }
    }

    if ($name !== false) {
        $api->send([
            "id" => $input["roomId"],
            "name" => $name,
            "messages" => $user->get_room($input["roomId"]),
            "members" => $user->get_room_members($input["roomId"]),
            "isAdmin" => $user->isAdminOfRoom($input["roomId"])
        ], "Rooms of the current user.");
    } else {
        $api->throw("Requesterror", "Room not owned.");
    }
    
}
?>
