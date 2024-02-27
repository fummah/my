<?php
session_start();
if(isset($_SESSION['logxged']) && !empty($_SESSION['logxged'])) {
    if (isset($_POST['doc'])) {
        $name =  $_POST['my_doc'];

        if(!isset($_POST['my_doc']))
        {
die();
        }
        $str=explode('.',$name);
        $count=count($str);
        $ext=$str[$count-1];
        $arr=["jpg","JPG","png","PNG"];
        if($ext=="PDF" || $ext=="pdf") {
            $fp = fopen($name, 'rb');
            header("Content-Type: application/pdf");
            header("Content-Length: " . filesize($name));
            fpassthru($fp);
        }
        else if($ext=="PNG" || $ext=="png")
        {
            $im = imagecreatefrompng($name);

            header('Content-Type: image/png');

            imagepng($im);
            imagedestroy($im);
        }
        else if($ext=="jpeg" || $ext=="JPEG" || $ext=="jpg" || $ext=="JPG" || $ext=="TIF" || $ext=="tif")
        {
            $im = imagecreatefromjpeg($name);
            header('Content-Type: image/jpeg');


            imagejpeg($im);

            imagedestroy($im);
        }
        else if($ext=="doc" || $ext=="docx" || $ext=="DOC" || $ext=="DOCX")
        {
            $file = $name;
            $myName="download.docx";

            ob_clean();
            header("Cache-Control: no-store");
            header("Expires: 0");
            header("Content-Type: application/msword");
            header("Cache-Control: public");
            header('Content-Disposition: inline; filename="'.$myName.'"');
            header("Content-Transfer-Encoding: binary");
            header('Accept-Ranges: bytes');
            readfile($file);
        }
        else if($ext=="msg" || $ext=="MSG" || $ext=="eml" || $ext=="EML")
        {
            header("Content-Type: text/Calendar");
            header('Content-Disposition: inline; filename='. basename($name));
            echo base64_decode($name);
        }
        else
        {
            echo "The browser cannot open this file please contact system adminstrator".$ext;
        }
    } else {
        echo "There is an error";
    }
}
else{
    echo "Invalid Access";
}
?>