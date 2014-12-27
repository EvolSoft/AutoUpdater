<?php

/*
 * AutoUpdater (v1.1) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 27/12/2014 02:41 PM (UTC)
 * Copyright & License: (C) 2014 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/AutoUpdater/blob/master/LICENSE)
 */

namespace AutoUpdater;

use pocketmine\scheduler\AsyncTask;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Utils;
use pocketmine\utils\VersionString;

class Downloader extends AsyncTask{
	
    public function __construct($source, $dest){
        $this->source = $source;
        $this->dest = $dest;
    }

    public function onRun(){
    	$out = Utils::getURL($this->source);
    	if(is_string($out)){
    		file_put_contents($this->dest, $out);
    	}
    }
}
?>
