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

function getPharmacyDetails($username, $password, $pharmacyId) {
    $soapUrl = "https://insure.a-group.az/insureazSvc/AQroupMobileIntegrationSvc.asmx";

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>' .
        '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ' .
        'xmlns:xsd="http://www.w3.org/2001/XMLSchema" ' .
        'xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">' .
        '<soap:Body>' .
        '<GetPharmacyById xmlns="http://tempuri.org/">' .
        '<userName>' . htmlspecialchars($username) . '</userName>' .
        '<password>' . htmlspecialchars($password) . '</password>' .
        '<pharmacyId>' . htmlspecialchars($pharmacyId) . '</pharmacyId>' .
        '</GetPharmacyById>' .
        '</soap:Body>' .
        '</soap:Envelope>';

    $headers = array(
        "Content-type: text/xml; charset=utf-8",
        "SOAPAction: \"http://tempuri.org/GetPharmacyById\"",
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
        return ['error' => curl_error($ch)];
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
    
    $detailedPharmacies = [];
    foreach ($pharmacies->PHARMACIES as $pharmacy) {
        $basicInfo = [
            'CUSTOMER_ID' => (string)$pharmacy->CUSTOMER_ID,
            'NAME' => (string)$pharmacy->NAME,
            'LOCATION_X' => (string)$pharmacy->LOCATION_X,
            'LOCATION_Y' => (string)$pharmacy->LOCATION_Y
        ];
        $detailsResponse = getPharmacyDetails($username, $password, $basicInfo['CUSTOMER_ID']);
        $detailsXml = simplexml_load_string($detailsResponse);
        if ($detailsXml === false) {
            $detailedPharmacies[] = array_merge($basicInfo, ['details' => 'Failed to parse details XML']);
            continue;
        }

        $detailsNamespaces = $detailsXml->getNamespaces(true);
        $detailsSoapBody = $detailsXml->children($detailsNamespaces['soap'])->Body;
        $detailsResult = $detailsSoapBody->children('http://tempuri.org/')->GetPharmacyByIdResponse->GetPharmacyByIdResult;
        $pharmacyDetails = new SimpleXMLElement(html_entity_decode($detailsResult));

        $detailedPharmacies[] = array_merge($basicInfo, ['details' => $pharmacyDetails]);
    }
    
    echo json_encode($detailedPharmacies);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
