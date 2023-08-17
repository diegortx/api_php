<?php
/**
 * Responsable to load all files class inside path "classes/*"
 */
class Autoload
{
    /**
     * This contruct is for find all files inside this path "/"
     */
    public function __construct()
    {
        # Search all files in same path using __DIR__ to check exact path
        ## Remember global variable __DIR__ get exact path from file
        $files = scandir(__DIR__ . "/");


        foreach ($files as $file) {
            # Using this if to remove paths '.' and '..' and add all other files class
            if (!in_array($file, ['.', '..'])) {
                include_once($file);
            }
        }
    }
}