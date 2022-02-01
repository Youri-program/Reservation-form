<?php

// Author: Youri van der Meulen

/* ============  Start of the application ============ */

// Declare an empty array
$aReservation = array();
$iRecordCounter = 0;

/* ---------- Load all current reservations from the file -------- */
// Open the file in 'read' modus
$file = fopen('reservations.json', 'r');
// Read the JSON array from the file
$aJSONArray = file_get_contents('reservations.json');
// Convert to JSON array back to a PHP array
$aReservationsData = json_decode($aJSONArray, TRUE);
// Count the current number of records
$iRecordCounter = count($aReservationsData);


/* ------------ Handle the new input of the form ------ */
if (!empty($_POST)) {
    $sGuestName = $_POST['sGuestName'];
    $dDate = $_POST['dDate'];
    $dTime = $_POST['dTime'];
    $iNumber = $_POST['iNumber'];

    /* --------- Store the new reservations in the file -------- */
    $aReservationsData[$iRecordCounter] = array();
    $aReservationsData[$iRecordCounter]['sGuestName'] = $sGuestName;
    $aReservationsData[$iRecordCounter]['dDate'] = $dDate;
    $aReservationsData[$iRecordCounter]['dTime'] = $dTime;
    $aReservationsData[$iRecordCounter]['iNumber'] = $iNumber;
    
} // End if not empty

// Use JSON to encode the array into a storeable string
$aJSONArray = json_encode($aReservationsData);
// Open the file in 'write' modus
$file = fopen('reservations.json', 'w');
// Save the content of the JSON array into the file
file_put_contents('reservations.json', $aJSONArray);
// Close the file
fclose($file);


/* ============= End of PHP, start of HTML ============== */
// Form where you can enter your data
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Reservations </title>
    </head>
    <body>
        <h3>Please enter the desired information below:</h3>
        <form method='post'>           
            Name: <input type='text' name='sGuestName'><br/>
            Date: <input type='date' name='dDate'><br/>
            Time: <input type='time' name='dTime'><br/>
            Number of persons: <input type='number' name='iNumber' min='1' max='10'><br/>
            <br/><input type='submit' value='Reserve'><br/><br/>
        </form>
    </body>
</html>

<?php
/* ---------- Load all current reservations from the file -------- */
// Open the file in 'read' modus
$file = fopen('reservations.json', 'r');
// Read the JSON array from the file
$aJSONArray = file_get_contents('reservations.json');
// Convert to JSON array back to a PHP array
$aReservationsData = json_decode($aJSONArray, TRUE);


// List all current reservations
echo("<table border='1' width='100%'>
    <tr><th>Name:</th><th>Date:</th><th>Time:</th><th>Number of persons:</th></tr>
    ");
foreach ($aReservationsData as $aReservation) {
    echo("<tr><td>" . $aReservation['sGuestName'] . "</td><td>" . $aReservation['dDate'] . "</td><td>" . $aReservation['dTime'] . "</td><td>" . $aReservation['iNumber'] . "</td></tr>");
}
?>

