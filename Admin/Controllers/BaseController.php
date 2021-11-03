<?php

class BaseController
{
    const VIEWS_FOLDER_NAME = '../Admin/Views';
    const MODELS_FOLDER_NAME = '../Home/Models';

    // quy tắc 
    // + pathname: folderName.file name
    // + Lấy từ thư mục sau thư mục Views
    // VD: frontend.product.index
    public function view($viewPath, array $data = [])
    {
        foreach($data as $key => $value){
            $$key = $value;
        }
        
         require(self::VIEWS_FOLDER_NAME . '/' . str_replace('.', '/', $viewPath) . '.php');
    }

    protected function loadModel($modelPath){

        require(self::MODELS_FOLDER_NAME . '/' . $modelPath . '.php');

    }
    // Chuyển file vào thư mục 
    public function moveFile($key, $rootPath = "../"){
        if(!isset($_FILES[$key]) || !isset($_FILES[$key]["name"]) || $_FILES[$key]["name"] == ''){
            return '';
        }
        $pathTemp = $_FILES[$key]["tmp_name"];
        $filename = $_FILES[$key]["name"];
        $newPath ="assets/img/".$filename;
        // Lưu file vào thư mục trên sever
        move_uploaded_file($pathTemp,$rootPath.$newPath);
        // trả về đường dẫn để lưu vào database
        return $newPath;
    }
    public function moveMutilFile($key, $rootPath = "../"){
        
        // Count # of uploaded files in array
        $total = count($_FILES[$key]['name']);
        $newPaths = [];
        // Loop through each file
        for( $i=0 ; $i < $total ; $i++ ) {
        //Get the temp file path
        $tmpFilePath = $_FILES[$key]['tmp_name'][$i];

        //Make sure we have a file path
            if ($tmpFilePath != ""){
                //Setup our new file path
                $newFilePath = "assets/img/" . $_FILES[$key]['name'][$i];
                //Upload the file into the temp dir
                move_uploaded_file($tmpFilePath, $rootPath.$newFilePath);

                array_push($newPaths,$newFilePath);
            }
        }

        return implode(",",$newPaths);

    }
    public function fixUrl($thumbnail,$rootPath = "../"){
        if(stripos($thumbnail,'http://') != false || stripos($thumbnail,'https://') != false){

        }
        else{
            $thumbnail= $rootPath.$thumbnail;
        }
        return $thumbnail;
    }
}
