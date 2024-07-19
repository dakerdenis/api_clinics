<?php
header('Content-Type: application/json');

$username = 'AQWeb';
$password = '@QWeb';

function getHospitals($username, $password) {
    $soapUrl = "https://insure.a-group.az/insureazSvc/AQroupMobileIntegrationSvc.asmx";

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>' .
        '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ' .
        'xmlns:xsd="http://www.w3.org/2001/XMLSchema" ' .
        'xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">' .
        '<soap:Body>' .
        '<GetHospitals xmlns="http://tempuri.org/">' .
        '<userName>' . htmlspecialchars($username) . '</userName>' .
        '<password>' . htmlspecialchars($password) . '</password>' .
        '</GetHospitals>' .
        '</soap:Body>' .
        '</soap:Envelope>';

    $headers = array(
        "Content-type: text/xml; charset=utf-8",
        "SOAPAction: \"http://tempuri.org/GetHospitals\"",
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

function getHospitalDetails($username, $password, $hospitalId) {
    $soapUrl = "https://insure.a-group.az/insureazSvc/AQroupMobileIntegrationSvc.asmx";

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>' .
        '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ' .
        'xmlns:xsd="http://www.w3.org/2001/XMLSchema" ' .
        'xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">' .
        '<soap:Body>' .
        '<GetHospitalById xmlns="http://tempuri.org/">' .
        '<userName>' . htmlspecialchars($username) . '</userName>' .
        '<password>' . htmlspecialchars($password) . '</password>' .
        '<hospitalId>' . htmlspecialchars($hospitalId) . '</hospitalId>' .
        '</GetHospitalById>' .
        '</soap:Body>' .
        '</soap:Envelope>';

    $headers = array(
        "Content-type: text/xml; charset=utf-8",
        "SOAPAction: \"http://tempuri.org/GetHospitalById\"",
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
    $response = getHospitals($username, $password);
    $xml = simplexml_load_string($response);
    if ($xml === false) {
        echo json_encode(['error' => 'Failed to parse XML', 'response' => $response]);
        exit;
    }

    $namespaces = $xml->getNamespaces(true);
    $soapBody = $xml->children($namespaces['soap'])->Body;
    $result = $soapBody->children('http://tempuri.org/')->GetHospitalsResponse->GetHospitalsResult;
    $hospitals = new SimpleXMLElement(html_entity_decode($result));
    
    $detailedHospitals = [];
    foreach ($hospitals->HOSPITALS as $hospital) {
        $basicInfo = [
            'CUSTOMER_ID' => (string)$hospital->CUSTOMER_ID,
            'NAME' => (string)$hospital->NAME,
            'LOCATION_X' => (string)$hospital->LOCATION_X,
            'LOCATION_Y' => (string)$hospital->LOCATION_Y
        ];
        $detailsResponse = getHospitalDetails($username, $password, $basicInfo['CUSTOMER_ID']);
        $detailsXml = simplexml_load_string($detailsResponse);
        if ($detailsXml === false) {
            $detailedHospitals[] = array_merge($basicInfo, ['details' => 'Failed to parse details XML']);
            continue;
        }

        $detailsNamespaces = $detailsXml->getNamespaces(true);
        $detailsSoapBody = $detailsXml->children($detailsNamespaces['soap'])->Body;
        $detailsResult = $detailsSoapBody->children('http://tempuri.org/')->GetHospitalByIdResponse->GetHospitalByIdResult;
        $hospitalDetails = new SimpleXMLElement(html_entity_decode($detailsResult));

        $detailedHospitals[] = array_merge($basicInfo, ['details' => $hospitalDetails]);
    }
    
    echo json_encode($detailedHospitals);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
