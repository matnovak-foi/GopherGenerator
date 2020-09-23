<?php
    class GopherPageCreator {

        private $path;

        public function __construct($path)
        {
            $this->path=$path;
        }

        public function createPage($output, $fileName,$type)
        {
            $file=fopen($this->path.$type."/".$fileName,"w");
            fwrite($file,$output);
            fclose($file);
        }

        public function deleteOldGopherMap(){
            if(file_exists($this->path."gophermap"))
                unlink($this->path."gophermap");
        }

        public function createGopherMap(array $posts, $title)
        {
            $file=fopen($this->path."gophermap","a+");
            fwrite($file,"\n".$title."\n");
            foreach ($posts as $postTitle => $post){
                fwrite($file,"0".$postTitle."\t".$title."/".$postTitle."\twatss.foi.hr\t70\n");
            }

            fclose($file);
        }
    }
?>