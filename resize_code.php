<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

// Set the upload directory and get the uploaded file
if(isset($_FILES["file"])){
// Step 1: Get the uploaded image
$image_name = $_FILES['file']['name'];
$image_type = $_FILES['file']['type'];
$image_size = $_FILES['file']['size'];
$image_temp = $_FILES['file']['tmp_name'];

// Step 2: Check that the uploaded file is an image
$allowed_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
if (!in_array(exif_imagetype($image_temp), $allowed_types)) {
    die("Invalid image type");
}

// Step 3: Create an image resource from the uploaded file
$image_resource = null;
if ($image_type == "image/jpeg") {
    $image_resource = imagecreatefromjpeg($image_temp);
} elseif ($image_type == "image/png") {
    $image_resource = imagecreatefrompng($image_temp);
} elseif ($image_type == "image/gif") {
    $image_resource = imagecreatefromgif($image_temp);
}

// Step 4: Resize the image
$resized_image = imagescale($image_resource, 200, 200);

// Step 5: Store the resized image in a folder on your server
$resized_image_path = "rsc/" . $image_name;
imagejpeg($resized_image, $resized_image_path);
imagepng($resized_image, $resized_image_path);
imagegif($resized_image, $resized_image_path);

}


        // $new_file_name_base = "IMG".uniqid();
		// $new_file_name_all = $new_file_name_base.".png";
		
		// $new_file_name_thumb_base = $new_file_name_base."_thumb";
		// $new_file_name_thumb_all = $new_file_name_thumb_base.".jpg";
		
		// copy($_FILES['file']['tmp_name'], "rsc/".$new_file_name_all);
		
		// $image = WideImage::load("rsc/".$new_file_name_all);
		// $image =  $image->resize(400, 400, 'outside')->crop('center', 'middle', 400, 400);
		// $image = $image->saveToFile("rsc/".$new_file_name_thumb_all,90);
		
        // header("Location: media_management_system.php");

?>


         <div class="container">
            <form action="resize.php" method="post" enctype="multipart/form-data">
               Select image to upload:
               <input type="file" name="file" id="file">
               <input type="submit" value="Upload Image" name="submit">
            </form>
         </div>
</body>
</html>