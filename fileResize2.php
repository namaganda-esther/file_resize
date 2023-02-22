<?php

require("dataconnect.php");


$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 



if (isset($_FILES["file"])) {
    if (is_array($_FILES)) {

		$uploadedFile = $_FILES['file']['tmp_name']; 
        $sourceProperties = getimagesize($uploadedFile);
        $newFileName = time();
        $dirPath = "rsc/";
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];

        if ($image_type == IMAGETYPE_JPEG) {
            $imageSrc = imagecreatefromjpeg($uploadedFile);
			$tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
            imagejpg($tmp,$dirPath. $newFileName. "_thump.". $ext);
            // $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
            // imagejpeg($target_layer, $_FILES['file']['name'] . "_thump.jpg");
        } elseif ($image_type == IMAGETYPE_GIF) {
            $imageSrc = imagecreatefromgif($uploadedFile);
			$tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
            imagegif($tmp,$dirPath. $newFileName. "_thump.". $ext);
            // $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
            // imagegif($target_layer, $_FILES['file']['name'] . "_thump.gif");
        } elseif ($image_type == IMAGETYPE_PNG) {
            $imageSrc = imagecreatefrompng($uploadedFile);
			$tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
            imagepng($tmp,$dirPath. $newFileName. "_thump.". $ext);
            // $target_layer = fn_resize($image_resource_id, $source_properties[0], $source_properties[1]);
            // imagepng($target_layer, $_FILES['file']['name'] . "_thump.png");
        }

		move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext);
        echo "Image Resized Successfully.";
    }
}

function imageResize($imageSrc,$imageWidth,$imageHeight) {

    $newImageWidth =200;
    $newImageHeight =200;

    $newImageLayer=imagecreatetruecolor($newImageWidth,$newImageHeight);
    imagecopyresampled($newImageLayer,$imageSrc,0,0,0,0,$newImageWidth,$newImageHeight,$imageWidth,$imageHeight);

    return $newImageLayer;
}

		//https://teamfile2.s3.us-east-2.amazonaws.com/THE_FILENAME



			echo"
			<div class=\"col-lg-6 col-sm-12\">
				<div class=\"card hover-shadow-lg\">
					<div class=\"card-body text-start pl-5\">
					   <div class=\"avatar-parent-child\">
						 <form action=\"aws_bucket_campaign_upload2.php\" method=\"post\" enctype=\"multipart/form-data\">
						   <p class=\"form-control-label\">Select image to upload:<p>
						   <input class=\"form-control\" enctype=\"multipart\" type=\"file\" name=\"file\" id = \"file\">
						   <button class=\"btn btn-sm btn-primary rounded-pill mt-4 form-control w-50\" onclick=\"upload_file('N');\">Upload</button>
						 </form>
					   </div>
					</div>
				</div>
			</div>
		  ";


?>
