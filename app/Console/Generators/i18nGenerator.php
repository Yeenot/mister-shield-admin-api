<?php

namespace App\Console\Generators;

use Illuminate\Filesystem\Filesystem as File;

class i18nGenerator
{
    protected $file;

    public function __construct()
    {   
        $this->file = new File();
    }

    public function run($target, $path)
    {
        // prepare directory if not exist
        $this->prepareTarget($target);

        // iterate translation files
        $messages = [];
        $global = [];
        foreach ($this->file->allFiles($path) as $file) {
            $pathName = $file->getRelativePathName();
            $extension = $this->file->extension($pathName);
            if ($extension != 'php') {
                continue;
            }

            // format path for json keys
            $key = substr($pathName, 0, -4);
            $key = str_replace(DIRECTORY_SEPARATOR, '/', $key);
            $key = preg_replace('/\//', '.', $key, 1);
            $fullPath = $path.DIRECTORY_SEPARATOR.$pathName;

            // assign translations per locale-file
            $parts = explode('.', $key);
            $keys = explode(DIRECTORY_SEPARATOR, $parts[1], 2);
            if (count($keys) > 1) {
                $messages[$keys[0]][$parts[0]][$parts[1]] = include $fullPath;
            } else {
                $global[$parts[0]][$keys[0]] = include $fullPath;
            }
        }
        foreach($messages as $group => $content) {
            foreach ($global as $locale => $value) {
                $content[$locale] = array_merge($content[$locale], $global[$locale]);
            }
            $template = str_replace('\'{ messages }\'', json_encode($content), "export default '{ messages }';");
            $template = preg_replace('/(:)(\w+)/', '{${2}}', $template); // wrap attributes with {}
            $this->file->put($target.$group.'.js', $template);
        }
    }

    protected function prepareTarget($target)
    {
        $dirname = dirname($target);
        if (!$this->file->exists($target)) {
            $this->file->makeDirectory($target, 0755, true);
        }
    }
}