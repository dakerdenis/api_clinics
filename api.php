<?php
header('Content-Type: application/json');

$username = 'AQWeb';
$password = '@QWeb';

function getPharmacies($username, $password) {
    $soapUrl = "https://insure.a-group.az/insureazSvc/AQroupMobileIntegrationSvc.asmx";

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>' .
        '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ' .
        'xmlns:xsd="http://www.w3.org/2001/XMLSchema" ' .
        'xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">' .
        '<soap:Body>' .
        '<GetPharmacies xmlns="http://tempuri.org/">' .
        '<userName>' . htmlspecialchars($username) . '</userName>' .
        '<password>' . htmlspecialchars($password) . '</password>' .
        '</GetPharmacies>' .
        '</soap:Body>' .
        '</soap:Envelope>';

    $headers = array(
        "Content-type: text/xml; charset=utf-8",
        "SOAPAction: \"http://tempuri.org/GetPharmacies\"",
        "Content-length: " . strlen($xml_post_string),
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $soapUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Disable SSL verification

    $response = curl_exec($ch);
    if ($response === false) {
        echo json_encode(['error' => curl_error($ch)]);
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    return $response;
}

try {
    $response = getPharmacies($username, $password);
    $xml = simplexml_load_string($response);
    if ($xml === false) {
        echo json_encode(['error' => 'Failed to parse XML', 'response' => $response]);
        exit;
    }

    $namespaces = $xml->getNamespaces(true);
    $soapBody = $xml->children($namespaces['soap'])->Body;
    $result = $soapBody->children('http://tempuri.org/')->GetPharmaciesResponse->GetPharmaciesResult;
    $pharmacies = new SimpleXMLElement(html_entity_decode($result));
    
    $basicPharmacies = [];
    foreach ($pharmacies->PHARMACIES as $pharmacy) {
        $basicPharmacies[] = [
            'CUSTOMER_ID' => (string)$pharmacy->CUSTOMER_ID,
            'NAME' => (string)$pharmacy->NAME,
            'LOCATION_X' => (string)$pharmacy->LOCATION_X,
            'LOCATION_Y' => (string)$pharmacy->LOCATION_Y
        ];
    }
    
    echo json_encode($basicPharmacies);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
