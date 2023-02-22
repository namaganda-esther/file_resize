<?php

require("dataconnect.php");


error_reporting(E_ALL);
ini_set('display_errors', 1);
			
        if(isset($_FILES['media_image'])){
			$base= preg_replace( '/[\W]/', '', pathinfo($_FILES['media_image']['name'], PATHINFO_FILENAME))."_".uniqid();
			$media_image_fname= $base.".".$ext;
			copy($_FILES['media_image']['tmp_name'], "rsc/".$media_image_fname);

            $bucket = 'gratsymedia';
			$filepath = "".$base.".".$ext;

			$base_icon= $base."_icon";
			$image = WideImage::load("rsc/".$media_image_fname);
			$image =  $image->resize(400, 400, 'outside')->crop('center', 'middle', 400, 400);
			$image = $image->saveToFile("rsc/".$base_icon.".jpg",90);	
			
			
						// Upload a file.
			// $result_icon = $s3->putObject(array(
			// 	'Bucket'       => $bucket,
			// 	'Key'          => "rsc/".$base_icon.".jpg",
			// 	'SourceFile'   => "rsc/".$base_icon.".jpg",
			// 	'ACL'          => 'public-read',
			// 	'StorageClass' => 'REDUCED_REDUNDANCY',
			// 	'Metadata'     => array(    
	
			// 	)
			// ));	

            // unlink("rsc/".$base.".".$ext);
    }
			

 echo"

 <div class=\"col-lg-6 col-sm-12\">
 <div class=\"card hover-shadow-lg\">
     <div class=\"card-body text-start pl-5\">
        <div class=\"avatar-parent-child form-group\">
            <form action=\"media_management_system.php\" method=\"post\" enctype=\"multipart/form-data\">
            <label for=\"basicInput\" class=\"form-control-label\">Image File:<p>
            <input class=\"form-control\" type=\"file\" name=\"media_image\" id = \"media_image\">
            <button class=\"btn btn-sm btn-primary rounded-pill mt-4 form-control w-50\" onclick=\"upload_file('N');\">Create</button>
          </form>
        </div>
     </div>
 </div>
</div>

  ";


 

?>