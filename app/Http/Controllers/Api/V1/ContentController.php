<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem as File;

class ContentController extends Controller
{
    /**
     * Get content
     *
     */
    public function index(Request $request)
    {
        $locale = app()->getLocale();
        $path = toPathOS(resource_path()."\\lang\\{$locale}\\customer");
        $translations = [];
        $file = new File();
        try {
            foreach($file->allFiles($path) as $fileInfo) {
                $pathName = $fileInfo->getRelativePathName();
                $extension = $file->extension($pathName);
                if ($extension != 'php') {
                    continue;
                }
                $fullPath = $path.DIRECTORY_SEPARATOR.$pathName;
                $translations[str_replace('.php', '', $pathName)] = include $fullPath;
            }
            return response()->json(['data' => $translations]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Locale not found']);
        }
    }
}
