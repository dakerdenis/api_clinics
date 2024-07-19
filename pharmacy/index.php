<!DOCTYPE html>
<html>
<head>
    <title>Pharmacies</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .pharmacy-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;

        }
        .pharmacy {
            display: flex;
            align-items: center;
            padding: 10px;
            color: #3e4953;
            padding: 10px 30px;
            background-color: #f6f7f7;
            border-radius: 9px;
            margin-bottom: 20px;
        }
        .pharmacy:last-child {
            border-bottom: none;
        }
        .pharmacy h2 {
            margin: 0;
            font-size: 1.2em;
            color: #d32f2f;
        }
        .pharmacy p {
            margin: 5px 0;
            font-size: 0.9em;
            color: #333;
        }
        .map-link {
            margin-left: auto;
            display: flex;
            align-items: center;
            text-decoration: none;
            justify-content: center;
            width: 30px;
            height: 30px;
        }
        .map-link  img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .red_color {
            color: #BE2A2A;
            font-weight: 600;
            font-size: 18px;
        }
        
        .tablinks {
            width: 100%;
            padding: 15px 0px;
            text-align: center;
            font-size: 18px;
        }
    </style>
    <script src="script.js" defer></script>
</head>
<body>
    <div class="pharmacy-container">
        <div class="tab">
            <h1 class="tablinks  red_color">
                Apteklər
            </h1>
        </div>
        <div id="pharmacies-container"></div>
    </div>
</body>
</html>
