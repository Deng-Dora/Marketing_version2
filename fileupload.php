<!DOCTYPE>
<html>
<head>
    <meta charset = "UTF-8">
    <meta property = "og:title" content = "fileupload for marketing" />
    <meta property ="og:description" content = "">
    <meta property = "og:image" content = "http://marketing.nexwave.io">
    <title>File Upload Result</title>
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0"> 

    <style>
      #php{text-align: center;
         font-size:larger;
         margin-top: 100px;
         display: block;
         margin-left: auto;
         margin-right: auto;}

      .center {
         display: block;
         margin-left: auto;
         margin-right: auto;
         width: 50%;
         height:100%
}
    </style>

</head>

<body>
<div id="php">
<?php
  
  $URL=$_POST["URL"];

  if (isset($_FILES['file'])){
     $errors= array();
     $file_name = $_FILES['file']['name'];
     $file_size = $_FILES['file']['size'];
     $file_tmp = $_FILES['file']['tmp_name'];
     $file_type = $_FILES['file']['type'];
     $file_ext = strtolower(end(explode('.',$_FILES['file']['name'])));
     
     $extensions = array("jpeg","jpg","png");
     
     if (in_array($file_ext,$extensions) === false){
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
     }
     
     if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
     }
     
      mkdir($URL);

       $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
       
       $name = $_POST["title"]; //rename the file 

       move_uploaded_file($_FILES["file"]["tmp_name"], "$URL/".$name.".".$extension);
       
       //GENERATE HTML FILE

      $html = "<html><head><title>Image display</title></head><body><img src = '$name.jpeg'  class='center' ></body></html>";

      $file_output=file_put_contents("$URL/index.html", $html);
     
       echo "<br>"."Success"."<br>"."URL is:",$URL,"<br>";
       echo $html;

     }else {
        print_r($errors);
     }
  
?>
</div>

   
    
</body>

</html>


