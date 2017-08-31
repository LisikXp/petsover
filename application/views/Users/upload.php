<?php
require_once  $_SERVER['DOCUMENT_ROOT']. "/application/models/functions.php";
 function uploadImageFile() { // Note: GD library is required for this function

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $iWidth = (int)$_POST['w']; // desired image result dimensions
        $iHeight = (int)$_POST['h'];
        $iJpgQuality = 90;

        if ($_FILES) {

            // if no errors and size less than 250kb
            if (! $_FILES['img']['error'] ) {
                if (is_uploaded_file($_FILES['img']['tmp_name'])) {

                    // new unique filename
                    $sTempFileName = 'img/avatar/' . md5(time().rand());

                    // move uploaded file into cache folder
                    move_uploaded_file($_FILES['img']['tmp_name'], $sTempFileName);

                    // change file permission to 644
                    @chmod($sTempFileName, 0644);

                    if (file_exists($sTempFileName) && filesize($sTempFileName) > 0) {
                        $aSize = getimagesize($sTempFileName); // try to obtain image info
                        if (!$aSize) {
                            @unlink($sTempFileName);
                            return;
                        }

                        // check for image type
                        switch($aSize[2]) {
                            case IMAGETYPE_JPEG:
                            $sExt = '.jpg';

                                // create a new image from file 
                            $vImg = @imagecreatefromjpeg($sTempFileName);
                            break;
                            /*case IMAGETYPE_GIF:
                                $sExt = '.gif';

                                // create a new image from file 
                                $vImg = @imagecreatefromgif($sTempFileName);
                                break;*/
                                case IMAGETYPE_PNG:
                                $sExt = '.png';

                                // create a new image from file 
                                $vImg = @imagecreatefrompng($sTempFileName);
                                break;
                                default:
                                @unlink($sTempFileName);
                                return;
                            }

                        // create a new true color image
                            $vDstImg = @imagecreatetruecolor( $iWidth, $iHeight );

                        // copy and resize part of an image with resampling
                            imagecopyresampled($vDstImg, $vImg, 0, 0, (int)$_POST['x1'], (int)$_POST['y1'], $iWidth, $iHeight, (int)$_POST['w'], (int)$_POST['h']);

                        // define a result image filename
                            $sResultFileName = $sTempFileName . $sExt;

                        // output image to file
                            imagejpeg($vDstImg, $sResultFileName, $iJpgQuality);
                            @unlink($sTempFileName);

                            return $sResultFileName;
                        }
                    }
                }

            }
        }
    }
    if (isset($_POST['main_photo'])) {
        $sImage = uploadImageFile();
    //echo '<img id="photo_'.(int)$_POST['pid'].'" src="'.$sImage.'" />';
        $setting = new Setting;
        $setting->set_account_photo($sImage);
        echo $sImage;
        /* echo $sImage . ', '. (int)$_POST['w'].', '.(int)$_POST['h'].', '. (int)$_POST['x1'].', '. (int)$_POST['y1'];*/
    }

    if (isset($_POST['setting_photo'])) {
         $sImage = uploadImageFile();
          echo $sImage;
    }



