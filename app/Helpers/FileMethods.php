<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Url;

class FileMethods
{
    public static function copyfolder($from, $to) {
        // (A1) SOURCE FOLDER CHECK
        if (!is_dir($from)) { exit("$from does not exist"); }
      
        // (A2) CREATE DESTINATION FOLDER
        if (!is_dir($to)) {
            if (!mkdir($to)) { exit("Failed to create $to"); }
        }
      
        // (A3) COPY FILES + RECURSIVE INTERNAL FOLDERS
        $dir = opendir($from);
        while (($ff = readdir($dir)) !== false) { 
            if ($ff!="." && $ff!="..") {
                if (is_dir("$from/$ff")) {
                    copyfolder("$from/$ff/", "$to/$ff/");
                } else {
                    if (!copy("$from/$ff", "$to/$ff")) { exit("Error copying $from/$ff to $to/$ff"); }
                }
            }
        }
        closedir($dir);
    }

    public static function getFolderSubFolders($folderPath)
    {
        $folderFiles = static::getFolderFiles($folderPath);
        $subFolders = array_values(array_filter($folderFiles, function($nodeFolderFile) use($folderPath) {
            return is_dir(static::combinePaths($folderPath, $nodeFolderFile));
        }));
        return $subFolders;
    }

    public static function getFolderFiles($folderPath)
    {
        $folderFiles = scandir($folderPath);
        unset($folderFiles[array_search('.', $folderFiles, true)]);
        unset($folderFiles[array_search('..', $folderFiles, true)]);
        return array_values($folderFiles);
    }

    public static function deleteFolder($dir) {
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = static::combinePaths($dir, $file);
            if (is_dir($path)) {
                static::deleteFolder($path);
            }
            else {
                chmod($path, 0777);
                unlink($path);
            }
        }
        return rmdir($dir);
    }

    public static function combinePaths(...$paths) {
        $standardPaths = array_map(function ($path) {
            $path = str_replace('\\', '/', $path);
            if (substr($path, -1) == '/') {
                return substr($path, 0, strlen($path) - 1);
            }
            else {
                return $path;
            }
        }, $paths);
        return Helpers::concatenateStrings($standardPaths, '/');
    }
}