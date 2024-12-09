<?php

namespace App\Models;

use App\Helpers\Helpers;
use App\Helpers\FileMethods;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class Image extends Model
{
    public static function boot()
    {
        parent::boot();

        self::deleting(function($image) {
            if (is_dir($image->getFolderPath())) {
                FileMethods::deleteFolder($image->getFolderPath());
            }
            $uploadedImagePath = "{$image->getFolderPath()}.{$image->getExtension()}";
            if (file_exists($uploadedImagePath)) {
                unlink($uploadedImagePath);
            }
        });
    }

    public function getUrl(int $width): string
    {
        if (file_exists($this->getPath($width))) {
            return Storage::url(FileMethods::combinePaths(
                'images',
                $this->relativeFolderPath,
                $this->getFileName(),
                $width . '.webp'
            ));
        } else if (file_exists($this->getPath('original'))) {
            return Storage::url(FileMethods::combinePaths(
                'images',
                $this->relativeFolderPath,
                $this->getFileName(),
                'original.webp'
            ));
        } else {
            return Storage::url(FileMethods::combinePaths(
                'images',
                $this->relativeFolderPath,
                $this->getFileName() . '.' . $this->getExtension()
            ));
        }
    }

    public function getMainUrl(): string
    {
        return Storage::url(FileMethods::combinePaths(
            'images',
            $this->relativeFolderPath,
            $this->getFileName()
        ));
    }

    public function moveFromUploads(): void
    {
        $uploadedFilePath = FileMethods::combinePaths(storage_path('app/public/uploads'), $this->relative_path);
        if (file_exists($uploadedFilePath)) {
            rename(
                $uploadedFilePath,
                $this->getFolderPath() . '.' . $this->getExtension()
            );
        }
    }

    public function createResizedVersions(): void
    {
        $imageName = pathinfo($this->relative_path, PATHINFO_FILENAME);
        $imageFolderPath = $this->getFolderPath();
        $imagePath = $imageFolderPath . '.' . $this->getExtension();
        if (!is_dir($imageFolderPath)) {
            mkdir($imageFolderPath);
            
            foreach ($this->resizeValues as $resizeValue) {
                $manager = new ImageManager(new Driver());
                $imageResizer = $manager->read($imagePath);
                $imageResizer->cover($resizeValue['width'], $resizeValue['height']);
                $resizedImagePath = FileMethods::combinePaths($imageFolderPath, $resizeValue['width'] . '.webp');
                $imageResizer->toWebp()->save($resizedImagePath);
            }

            $manager = new ImageManager(new Driver());
            $imageResizer = $manager->read($imagePath);
            $imageResizer->toWebp()->save(FileMethods::combinePaths($imageFolderPath, 'original.webp'));
            rename($imagePath, FileMethods::combinePaths($imageFolderPath, 'original.' . $this->getExtension()));
            $this->update(['relative_path' => str_replace('.' . $this->getExtension(), '', $this->relative_path)]);
        }
    }

    public function getPath(int|string $width): string
    {
        return FileMethods::combinePaths($this->getFolderPath(), $width . '.webp');
    }

    public function getFolderPath(): string
    {
        return FileMethods::combinePaths(
            storage_path('app/public/images'),
            $this->relativeFolderPath,
            $this->getFileName()
        );
    }

    public function getFileName(): string
    {
        return pathinfo($this->relative_path, PATHINFO_FILENAME);
    }

    public function getExtension(): string
    {
        return pathinfo($this->relative_path, PATHINFO_EXTENSION);
    }
}
