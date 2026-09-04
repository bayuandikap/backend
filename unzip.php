<?php
$zip = new ZipArchive;
// Replace 'vendor.zip' with the exact name of your uploaded zip file
$res = $zip->open('vendor.zip'); 
if ($res === TRUE) {
    $zip->extractTo(__DIR__);
    $zip->close();
    echo 'Extraction Successful!';
} else {
    echo 'Extraction Failed. Check file name or permissions.';
}
?>