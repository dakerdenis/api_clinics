<?php
function getPharmacies($username, $password) {
    $soapUrl = "https://insure.a-group.az/insureazSvc/AQroupMobileIntegrationSvc.asmx"; // SOAP endpoint

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>' .
        '<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ' .
        'xmlns:xsd="http://www.w3.org/2001/XMLSchema" ' .
        'xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">' .
        '<soap12:Body>' .
        '<GetPharmacies xmlns="http://tempuri.org/">' .
        '<userName>' . htmlspecialchars($username) . '</userName>' .
        '<password>' . htmlspecialchars($password) . '</password>' .
        '</GetPharmacies>' .
        '</soap12:Body>' .
        '</soap12:Envelope>';

    $headers = array(
        "Content-type: application/soap+xml; charset=utf-8",
        "Content-length: " . strlen($xml_post_string),
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $soapUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    
    $response = curl_exec($ch);
    if ($response === false) {
        throw new Exception(curl_error($ch), curl_errno($ch));
    }

    curl_close($ch);

    return $response;
}

try {
    $username = 'your_username';
    $password = 'your_password';
    $response = getPharmacies($username, $password);
    $xml = simplexml_load_string($response);
    $namespaces = $xml->getNamespaces(true);
    $soapBody = $xml->children($namespaces['soap12'])->Body;
    $result = $soapBody->children('http://tempuri.org/')->GetPharmaciesResponse->GetPharmaciesResult;
    $pharmacies = new SimpleXMLElement($result);
    
    $jsonPharmacies = json_encode($pharmacies);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pharmacies</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pharmacies = <?php echo $jsonPharmacies; ?>;
            const container = document.getElementById('pharmacies-container');

            pharmacies.PHARMACIES.forEach(pharmacy => {
                const pharmacyDiv = document.createElement('div');
                pharmacyDiv.innerHTML = `
                    <h2>${pharmacy.NAME}</h2>
                    <p>ID: ${pharmacy.CUSTOMER_ID}</p>
                    <p>Location: (${pharmacy.LOCATION_X}, ${pharmacy.LOCATION_Y})</p>
                `;
                container.appendChild(pharmacyDiv);
            });
        });
    </script>
</head>
<body>
    asdasd
    <h1>Pharmacies</h1>
    <div id="pharmacies-container"></div>
</body>
</html>
