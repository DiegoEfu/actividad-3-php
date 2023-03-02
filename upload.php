<?php

//display the image
/*
$dir_path = "uploads";
$files = scandir($dir_path);

echo "<br> <br> The images are displayed here:";

for($i=0;$i<count($files);$i++){
    echo '<img src="'.$dir_path."/".$files[$i].'" alt="'.$files[$i].'" width="50px" height="50px">';

}

foreach($files as $valor){
    echo '<img src="'.$dir_path."/".$valor.'" alt="'.$valor.'" width="50px" height="50px">';
}
*/


if(isset($_POST['submit'])){

  $file = $_FILES['file'];

  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileSize = $file['size'];
  $fileError = $file['error'];
  $fileType = $file['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg','jpeg','png','pdf');

  if(in_array($fileActualExt, $allowed)){

    if($fileError === 0){
      if($fileSize < 5000000){
        $fileNameNew = uniqid('',true).".".$fileActualExt;
        $fileDestination = 'uploads/'.$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
        header("Location: index.php?uploadsuccess");
      }else{
        echo "The file is too big";
      }
    }else{
      echo "There was an error uploading the file";
    }

  } else{
    echo "You can't upload this type of file";
  }

}

?>