<?php

$username = $_GET['username'];
$distance = $_GET['distance'];

echo $_GET['username'];
echo " ";
echo $_GET['distance'];

$con = mysqli_connect("localhost", "thedreamteam", "El3ven", "SSA") or die ("Error " . mysqli_error($con));

$usercheck = mysqli_query($con, "SELECT `PlayerName` FROM `Top Player` WHERE PlayerName='$username'");

if (mysqli_num_rows($usercheck) >= 1) {
    echo "User exists ";
    $scorecheck = mysqli_query($con, "SELECT `Distance` FROM `Top Player` WHERE PlayerName='$username' AND Distance='$distance'");
    $score = mysqli_fetch_array($scorecheck);
    if ($distance > $score) {
        echo "Updated user";
        $update = mysqli_query($con, "UPDATE `Top Player` SET `Distance` = '$distance' WHERE `PlayerName` =$username;");
    } else {
        echo " Did not beat previous high score";
    }
}

if (mysqli_num_rows($usercheck) == 0) {
    echo " User does not exist, adding now";
    $insert = mysqli_query($con, "INSERT INTO `Top Player` (`PlayerID`, `PlayerName`, `Distance`) VALUES (NULL, '$username', '$distance')");
}