<?php
 $imageDir = __DIR__ . '/../media/captcha';
 $files = glob($imageDir . '/{*.jpg,*.png,*.jpeg}', GLOB_BRACE);
if (count($files) > 0) {
    $randomFile = $files[array_rand($files)];
    $idType = pathinfo($randomFile, PATHINFO_FILENAME);
    $imageData = base64_encode(file_get_contents($randomFile));
    
    $response = [
        'success' => true,
        'idType' => $idType,
        'image' => $imageData
    ];
        
} else {
    $response = [
        'success' => false,
        'message' => 'No captcha images found'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
