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

// Subir archivos
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

            echo "Archivo subido correctamente. URL: " . $result['ObjectURL'] . "<br>";
        } catch (AwsException $e) {
            echo "Error subiendo el archivo: " . $e->getMessage();
        }
    } else {
        echo "Error al subir el archivo.";
    }
}

// Listar archivos en el bucket
try {
    $objects = $s3->listObjectsV2([
        'Bucket' => $bucket
    ]);

    echo "<h2>Archivos en el bucket:</h2>";
    if (isset($objects['Contents'])) {
        foreach ($objects['Contents'] as $object) {
            $fileUrl = $s3->getObjectUrl($bucket, $object['Key']);
            echo "<li><a href=\"$fileUrl\">{$object['Key']}</a></li>";
        }
    } else {
        echo "<p>No se encontraron archivos en el bucket.</p>";
    }
} catch (AwsException $e) {
    echo "Error listando los archivos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir y Listar Archivos en S3</title>
</head>
<body>
    <h1>Subir Imagen a S3</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="Subir">
    </form>
    
    <!-- Aquí se listarán los archivos en el bucket -->
    <?php
    // Aquí se mostrará la lista de archivos ya generada en PHP
    ?>
</body>
</html>