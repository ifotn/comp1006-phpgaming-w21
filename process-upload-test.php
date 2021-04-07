<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
// inspect the uploaded file if there is one
if ($_FILES['myFile']['name'] != null) {
    $name = $_FILES['myFile']['name'];
    echo "Name: $name<br />";

    // get size in bytes. 1 kb = 1024 bytes
    $size = $_FILES['myFile']['size'];
    echo "Size: $size<br />";

    // temp cache location. we need this in order to move it to a permanent directory
    $tmp_name = $_FILES['myFile']['tmp_name'];
    echo "Tmp Name: $tmp_name<br />";

    // file type
    //$type = $_FILES['myFile']['type']; - don't use this as it can be spoofed
    $type = mime_content_type($tmp_name);
    echo "Type: $type<br />";
}
else {
    echo 'No file uploaded';
}

?>

</body>
</html>
