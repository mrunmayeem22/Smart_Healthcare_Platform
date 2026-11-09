<?php

include("../config/database.php");

$query = "
SELECT
tr.*,
u.full_name
FROM test_reports tr

JOIN users u
ON tr.user_id = u.user_id

ORDER BY report_id DESC
";

$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html>

<head>
<title>QR Report Verification</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<h2>Generate QR Codes</h2>

<table border="1" cellpadding="10">

<tr>

<th>Patient</th>

<th>Test Name</th>

<th>QR Code</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{
    $report_id = $row['report_id'];

    $verify_url =
    "http://localhost/SmartHealthcarePlatform/qr/verify_report.php?id="
    .$report_id;

    $qr =
    "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data="
    .urlencode($verify_url);

?>

<tr>

<td>
<?php echo $row['full_name']; ?>
</td>

<td>
<?php echo $row['test_name']; ?>
</td>

<td>

<img
src="<?php echo $qr; ?>"
width="150">

</td>

</tr>

<?php
}
?>

</table>

</body>
</html>