<?php
header('Content-Type: application/json');

$username = 'AQWeb';
$password = '@QWeb';

function getPharmacies($username, $password) {
    $soapUrl = "https://insure.a-group.az/insureazSvc/AQroupMobileIntegrationSvc.asmx";

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

    // Log the raw response for debugging
    file_put_contents('response_log.txt', $response);

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
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);
    if ($response === false) {
        throw new Exception(curl_error($ch), curl_errno($ch));
    }

    curl_close($ch);

    // Log the raw response for debugging
    file_put_contents('response_details_log.txt', $response);

    return $response;
}

try {
    $response = getPharmacies($username, $password);
    $xml = simplexml_load_string($response);
    if ($xml === false) {
        // Enhanced error handling and logging
        echo json_encode(['error' => 'Failed to parse XML', 'response' => $response]);
        exit;
    }

    $namespaces = $xml->getNamespaces(true);
    $soapBody = $xml->children($namespaces['soap12'])->Body;
    $result = $soapBody->children('http://tempuri.org/')->GetPharmaciesResponse->GetPharmaciesResult;
    $pharmacies = new SimpleXMLElement(html_entity_decode($result));
    
    // Fetch details for each pharmacy
    $detailedPharmacies = [];
    foreach ($pharmacies->PHARMACIES as $pharmacy) {
        $pharmacyId = (string)$pharmacy->CUSTOMER_ID;
        $detailsResponse = getPharmacyDetails($username, $password, $pharmacyId);
        $detailsXml = simplexml_load_string($detailsResponse);
        if ($detailsXml === false) {
            // Enhanced error handling and logging
            echo json_encode(['error' => 'Failed to parse details XML', 'response' => $detailsResponse]);
            exit;
        }
        
        $detailsNamespaces = $detailsXml->getNamespaces(true);
        $detailsSoapBody = $detailsXml->children($detailsNamespaces['soap'])->Body;
        $detailsResult = $detailsSoapBody->children('http://tempuri.org/')->GetPharmacyByIdResponse->GetPharmacyByIdResult;
        $pharmacyDetails = new SimpleXMLElement(html_entity_decode($detailsResult));
        
        $detailedPharmacies[] = [
            'basic' => $pharmacy,
            'details' => $pharmacyDetails
        ];
    }
    
    echo json_encode($detailedPharmacies);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
