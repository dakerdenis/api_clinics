
<?php
header('Content-Type: application/json');

$username = 'AQWeb';
$password = '@QWeb';

function getOptics($username, $password) {
    $soapUrl = "https://insure.a-group.az/insureazSvc/AQroupMobileIntegrationSvc.asmx";

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>' .
        '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ' .
        'xmlns:xsd="http://www.w3.org/2001/XMLSchema" ' .
        'xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">' .
        '<soap:Body>' .
        '<GetOptics xmlns="http://tempuri.org/">' .
        '<userName>' . htmlspecialchars($username) . '</userName>' .
        '<password>' . htmlspecialchars($password) . '</password>' .
        '</GetOptics>' .
        '</soap:Body>' .
        '</soap:Envelope>';

    $headers = array(
        "Content-type: text/xml; charset=utf-8",
        "SOAPAction: \"http://tempuri.org/GetOptics\"",
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

function getOpticDetails($username, $password, $opticId) {
    $soapUrl = "https://insure.a-group.az/insureazSvc/AQroupMobileIntegrationSvc.asmx";

    $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>' .
        '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ' .
        'xmlns:xsd="http://www.w3.org/2001/XMLSchema" ' .
        'xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">' .
        '<soap:Body>' .
        '<GetOpticById xmlns="http://tempuri.org/">' .
        '<userName>' . htmlspecialchars($username) . '</userName>' .
        '<password>' . htmlspecialchars($password) . '</password>' .
        '<opticId>' . htmlspecialchars($opticId) . '</opticId>' .
        '</GetOpticById>' .
        '</soap:Body>' .
        '</soap:Envelope>';

    $headers = array(
        "Content-type: text/xml; charset=utf-8",
        "SOAPAction: \"http://tempuri.org/GetOpticById\"",
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
    $response = getOptics($username, $password);
    $xml = simplexml_load_string($response);
    if ($xml === false) {
        echo json_encode(['error' => 'Failed to parse XML', 'response' => $response]);
        exit;
    }

    $namespaces = $xml->getNamespaces(true);
    $soapBody = $xml->children($namespaces['soap'])->Body;
    $result = $soapBody->children('http://tempuri.org/')->GetOpticsResponse->GetOpticsResult;
    $optics = new SimpleXMLElement(html_entity_decode($result));
    
    $detailedOptics = [];
    foreach ($optics->OPTICS as $optic) {
        $basicInfo = [
            'CUSTOMER_ID' => (string)$optic->CUSTOMER_ID,
            'NAME' => (string)$optic->NAME,
            'LOCATION_X' => (string)$optic->LOCATION_X,
            'LOCATION_Y' => (string)$optic->LOCATION_Y
        ];
        $detailsResponse = getOpticDetails($username, $password, $basicInfo['CUSTOMER_ID']);
        $detailsXml = simplexml_load_string($detailsResponse);
        if ($detailsXml === false) {
            $detailedOptics[] = array_merge($basicInfo, ['details' => 'Failed to parse details XML']);
            continue;
        }

        $detailsNamespaces = $detailsXml->getNamespaces(true);
        $detailsSoapBody = $detailsXml->children($detailsNamespaces['soap'])->Body;
        $detailsResult = $detailsSoapBody->children('http://tempuri.org/')->GetOpticByIdResponse->GetOpticByIdResult;
        $opticDetails = new SimpleXMLElement(html_entity_decode($detailsResult));

        $detailedOptics[] = array_merge($basicInfo, ['details' => $opticDetails]);
    }
    
    echo json_encode($detailedOptics);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
