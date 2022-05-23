<?php

namespace App\Service;

use Illuminate\Support\Facades\File;

class ProductService
{
    public function saveNewImages(array $images, int $productId): array
    {
        $addedImages = [];
        foreach ($images as $image) {
            $imageName = mt_rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path("images/Products/{$productId}/"), $imageName);
            $addedImages[] = $imageName;
        }
        return $addedImages;
    }

    public function deleteOldImages(array $neededImages, int $productId): void
    {
        $currentImages = array_diff(scandir("images/Products/{$productId}/"), array('..', '.'));

        foreach ($currentImages as $imageSaved) {
            $searchResult = array_search($imageSaved, $neededImages, true);
            if ($searchResult === false) {
                File::delete("images/Products/{$productId}/{$imageSaved}");
            }
        }
    }

    public function removeDir($path): void
    {
        if (file_exists($path) && is_dir($path)) {
            $dir = opendir($path);
            while (false !== ($element = readdir($dir))) {
                if ($element !== '.' && $element !== '..') {
                    $tmp = $path . '/' . $element;
                    chmod($tmp, 0777);
                    if (is_dir($tmp)) {
                        $this->removeDir($tmp);
                    } else {
                        unlink($tmp);
                    }
                }
            }

            closedir($dir);

            if (file_exists($path)) {
                rmdir($path);
            }
        }
    }

    public function createDir(string $path)
    {
        if (!mkdir($path, 0700) && !is_dir($path)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', "/path/to/my/dir"));
        }
    }
}
