<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
</head>
<body>
    <h1>Transaction QR Code</h1>

    <div>
    <?php
    $localIp = getHostByName(getHostName()) ; // Get the local IP address dynamically
    $mainOffice = 'CID-OFC'; // Example value, replace with actual data
    $subOffice = 79; // Example value, replace with actual data

    $url = "http://$localIp:8080/Survey/p1?qrcode=yes&mainOffice=$mainOffice&subOffice=$subOffice"; // Construct the URL with parameters
?>
<img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::format('svg')->generate($url)) }}" />

    </div>
</body>
</html>
