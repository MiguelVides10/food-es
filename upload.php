<?php

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

// Configura el cliente S3 usando el rol IAM de la instancia EC2
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1', // Asegúrate de que esta región coincide con la de tu bucket
]);

$bucket = 'foodespanesgallina';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_FILES['file'];

    // Verificar si hay errores al cargar el archivo
    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($file['name']);
        $filePath = $file['tmp_name'];

        try {
            // Subir el archivo a S3
            $result = $s3->putObject([
                'Bucket' => $bucket,
                'Key'    => 'uploads/' . $fileName,
                'SourceFile' => $filePath,
                'ACL'    => 'public-read', // Opcional: establece permisos públicos si es necesario
            ]);
            echo "<p>Archivo subido exitosamente. URL: <a href='{$result['ObjectURL']}'>{$result['ObjectURL']}</a></p>";
        } catch (S3Exception $e) {
            echo "<p>Error al subir el archivo: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>Error al cargar el archivo.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen a S3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .container input[type="file"] {
            margin-bottom: 20px;
        }
        .container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Subir Imagen a S3</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" accept="image/*" required>
            <input type="submit" value="Subir Imagen">
        </form>
    </div>
</body>
</html>
