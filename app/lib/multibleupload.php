<?php
namespace lib;
trait multibleupload
{
    public function multipleuploads($inpt,$src){
        global $con;
        $image = $_FILES[$inpt];
        $image_name = $image['name'];
        $image_type = $image['type'];
        $image_temp = $image['tmp_name'];
        $image_size = $image['size'];
        $image_eror = $image['error'];
        $allowed_extension = array('jpg','gif','png','jpeg');
        $files_count = count($image_name);
        try{
            $finalName = [];
            for($i = 0; $i < $files_count; $i++){
                $errors = []; 
                $imgnamearr = array();
                if(!empty($image_name[$i])){
                    $finalName[$i] =  rand(0,100000000000).'_'.time().'_'.$image_name[$i];
                }else{
                    $finalName[$i] = null;
                }
                $ex_arr = explode('.',$image_name[$i]);
                $img_ex = strtolower(end($ex_arr));
                if($image_eror[$i] == 4){
                    $errors[] = 'No File Uploaded';
                }else{
                    if($image_size[$i] > 500000){
                        $errors[] = 'Image Too Big';
                    }
                    if(! in_array($img_ex,$allowed_extension)){
                        $errors[] = 'You Can\'t Upload This File';
                    }
                }
                if(empty($errors)){
                    move_uploaded_file($image_temp[$i],"$src$finalName[$i]"); 
                }
            }
            $imgsNameInDb = implode(',',$finalName);
            return !empty($finalName) ? $imgsNameInDb : null;
        }catch(Exception $e){
            echo 'Caught exception: '.$e->getMessage();
        }
    }
}