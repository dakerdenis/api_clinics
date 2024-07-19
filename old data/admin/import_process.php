<?php
use PhpOffice\PhpSpreadsheet\IOFactory;


// Database configuration
$host = 'localhost';
$username = 'root';
$password = 'plo234hshjnjsaf23';
$database = 'clinics';

// Create a new spreadsheet reader
$reader = IOFactory::createReader('Xlsx');

try {
    // Load the uploaded file
    $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

    // Get the first worksheet
    $worksheet = $spreadsheet->getActiveSheet();
    
    // Establish a database connection
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Iterate through each row in the Excel sheet and insert into MySQL
    foreach ($worksheet->getRowIterator() as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(FALSE); // Loop through all cells, even if they're empty
        
        // Assuming your Excel file has columns named 'column1' and 'column2'
        $data = [
            'column1' => $cellIterator->current()->getValue(),
            'column2' => $cellIterator->next()->getValue(),
            'column3' => $cellIterator->next()->getValue(),
            'column4' => $cellIterator->next()->getValue(),
            'column5' => $cellIterator->next()->getValue(),
        ];

        // Prepare and execute the SQL insert statement
        $sql = "INSERT INTO your_table (column1, column2, column3, column4, column5, column6) VALUES (:column1, :column2, :column3, :column4, :column5, :column6)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
    }

    // Close the database connection
    $conn = null;

    // Redirect back to the upload page with a success message
    header("Location: admin.php");
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>