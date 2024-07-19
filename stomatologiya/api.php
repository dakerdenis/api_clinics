<?php
header('Content-Type: application/json');

$username = 'AQWeb';
$password = '@QWeb';

function getDentalClinics($username, $password) {
    $soapUrl = "https://insure.a-group.az/insureazSvc/AQroupMobileIntegrationSvc.asmx";

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>' .
        '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ' .
        'xmlns:xsd="http://www.w3.org/2001/XMLSchema" ' .
        'xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">' .
        '<soap:Body>' .
        '<GetDentalClinics xmlns="http://tempuri.org/">' .
        '<userName>' . htmlspecialchars($username) . '</userName>' .
        '<password>' . htmlspecialchars($password) . '</password>' .
        '</GetDentalClinics>' .
        '</soap:Body>' .
        '</soap:Envelope>';

    $headers = array(
        "Content-type: text/xml; charset=utf-8",
        "SOAPAction: \"http://tempuri.org/GetDentalClinics\"",
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

function getDentalClinicDetails($username, $password, $clinicId) {
    $soapUrl = "https://insure.a-group.az/insureazSvc/AQroupMobileIntegrationSvc.asmx";

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>' .
        '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ' .
        'xmlns:xsd="http://www.w3.org/2001/XMLSchema" ' .
        'xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">' .
        '<soap:Body>' .
        '<GetDentalClinicById xmlns="http://tempuri.org/">' .
        '<userName>' . htmlspecialchars($username) . '</userName>' .
        '<password>' . htmlspecialchars($password) . '</password>' .
        '<dentalClinicId>' . htmlspecialchars($clinicId) . '</dentalClinicId>' .
        '</GetDentalClinicById>' .
        '</soap:Body>' .
        '</soap:Envelope>';

    $headers = array(
        "Content-type: text/xml; charset=utf-8",
        "SOAPAction: \"http://tempuri.org/GetDentalClinicById\"",
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
    $response = getDentalClinics($username, $password);
    $xml = simplexml_load_string($response);
    if ($xml === false) {
        echo json_encode(['error' => 'Failed to parse XML', 'response' => $response]);
        exit;
    }

    $namespaces = $xml->getNamespaces(true);
    $soapBody = $xml->children($namespaces['soap'])->Body;
    $result = $soapBody->children('http://tempuri.org/')->GetDentalClinicsResponse->GetDentalClinicsResult;
    $clinics = new SimpleXMLElement(html_entity_decode($result));
    
    $detailedClinics = [];
    foreach ($clinics->DENTAL_CLINICS as $clinic) {
        $basicInfo = [
            'CUSTOMER_ID' => (string)$clinic->CUSTOMER_ID,
            'NAME' => (string)$clinic->NAME,
            'LOCATION_X' => (string)$clinic->LOCATION_X,
            'LOCATION_Y' => (string)$clinic->LOCATION_Y
        ];
        $detailsResponse = getDentalClinicDetails($username, $password, $basicInfo['CUSTOMER_ID']);
        $detailsXml = simplexml_load_string($detailsResponse);
        if ($detailsXml === false) {
            $detailedClinics[] = array_merge($basicInfo, ['details' => 'Failed to parse details XML']);
            continue;
        }

        $detailsNamespaces = $detailsXml->getNamespaces(true);
        $detailsSoapBody = $detailsXml->children($detailsNamespaces['soap'])->Body;
        $detailsResult = $detailsSoapBody->children('http://tempuri.org/')->GetDentalClinicByIdResponse->GetDentalClinicByIdResult;
        $clinicDetails = new SimpleXMLElement(html_entity_decode($detailsResult));

        $detailedClinics[] = array_merge($basicInfo, ['details' => $clinicDetails]);
    }
    
    echo json_encode($detailedClinics);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
