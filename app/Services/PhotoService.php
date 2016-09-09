<?php

namespace App\Services;

use Illuminate\Support\Facades\URL;

class PhotoService
{
    private $dirfolder;
    private $url;

    public function __construct() {
        $this->url = URL::to('/') . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "galery" . DIRECTORY_SEPARATOR;

        $this->dirfolder = dirname(dirname(__DIR__))
            . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "galery" . DIRECTORY_SEPARATOR;
    }

    //lister tout les éléments du dossier source
    public function lister()
    {
        $dir = opendir($this->dirfolder);
        $value = [];

        while($file = readdir($dir)) {
            if($file != '.' && $file != '..' && $file != '.DS_Store' && !is_dir($this->dirfolder.$file))
            {
                $value[] = ["name" => $file, "path" => $this->dirfolder.$file, "url" => $this->url.$file];
            }
        }

        return $value;
    }

    public function delete($name) {
        $filename = $this->dirfolder . $name;

        if (file_exists ($filename) && !is_dir($filename)) {
            unlink($filename);
            return true;
        }

        return false;
    }
}
