<?php
    date_default_timezone_set('Asia/Shanghai');
    /**
     * sourcetree param set
     * @param $REPO: repository url
     * @param $FILE: export files url
     */
    if($argc == 0)
    {
        exit('Nothing to copy');
    }

    define('DS', DIRECTORY_SEPARATOR);

    $cur_time = date("YmdHi");
    $source_dir = $argv[1];
    $projectName = substr(strrchr($source_dir, '\\'), 1);
    $exp_dir = 'E:'.DS.'code_export'.DS.'export'.DS.'VERSION_'.$cur_time.DS.$projectName;

    function ExportOneFile($path)
    {
        global $source_dir,$exp_dir;

        $final_source = $source_dir.DS.$path;
        $final_dest = $exp_dir.DS.$path;

        $final_dest_dir = dirname($final_dest).DS;
        if(!is_dir($final_dest_dir))
        {
            mkdir($final_dest_dir,0777,true);
        }
        return @copy($final_source,$final_dest);
    }

    foreach($argv as $index=>$path)
    {
        if($index === 0 || $index === 1)
        {
            continue;
        }
        if(ExportOneFile($path))
        {
            echo ($index-1).' : '.$path." exported." . PHP_EOL;
        }
    }

    echo PHP_EOL. "All Complete. Please go to {$exp_dir} to view files" . PHP_EOL . PHP_EOL;
