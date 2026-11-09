<?php

function createNotification(
    $conn,
    $user_id,
    $title,
    $message
)
{
    mysqli_query(
        $conn,
        "INSERT INTO notifications
        (
            user_id,
            title,
            message
        )
        VALUES
        (
            '$user_id',
            '$title',
            '$message'
        )"
    );
}

?>