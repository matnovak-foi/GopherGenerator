<?php
    class GopherPageCreator {

        private $path;

        public function __construct($path)
        {
            $this->path=$path;
        }

        public function createPage($output, $fileName)
        {
            $file=fopen($this->path.$fileName,"w");
            fwrite($file,$output);
            fclose($file);
        }
    }
?>