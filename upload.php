<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// Configura el cliente S3
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1', // Asegúrate de que esta región coincida con la de tu bucket
]);

$bucket = 'foodespanesgallina';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Verifica si hubo algún error al subir el archivo
    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadPath = $file['tmp_name'];
        $fileName = basename($file['name']);

        try {
            // Sube el archivo al bucket de S3
            $result = $s3->putObject([
                'Bucket' => $bucket,
                'Key'    => $fileName,
                'SourceFile' => $uploadPath, 
            ]);

            echo "Archivo subido correctamente. URL: " . $result['ObjectURL'];
        } catch (AwsException $e) {
            echo "Error subiendo el archivo: " . $e->getMessage();
        }
    } else {
        echo "Error al subir el archivo.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen a S3</title>
</head>
<body>
    <h1>Subir Imagen a S3</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="Subir">
    </form>
</body>
</html>