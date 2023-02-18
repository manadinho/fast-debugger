<?php

use Manadinho\FastDebugger\Fast;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\Filesystem\Filesystem;

if (! function_exists('fast')) {
    /**
     * Quickly dump and die.
     *
     * @param  mixed  $args
     * @return Fast
     */
    function fast(...$args)
    {
        try {
            if(env('APP_ENV') == 'local')
            {
                $trace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
                $caller = $trace[0];
                $fileName = $caller['file'];
                $lineNumber = $caller['line'];
                if(str_contains($fileName, '/storage/framework/views/'))
                {
                    $fileContents = file_get_contents($fileName);
                    preg_match('/\/\*\*PATH (.+?) ENDPATH\*\*\//s', $fileContents, $matches);
                    $fileName = $matches[1];
                }
                return new Fast($args, $fileName, $lineNumber);   
            }
        } catch (\Throwable $th) {
            
        }
    }
}
