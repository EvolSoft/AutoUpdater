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

use pocketmine\scheduler\PluginTask;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Utils;
use pocketmine\utils\VersionString;

class Query extends PluginTask{

    public function __construct(Main $plugin){
        parent::__construct($plugin);
        $this->plugin = $plugin;
    }

    public function onRun($currentTick){
    	$this->plugin = $this->getOwner();
    	$this->cfg = $this->plugin->getConfig()->getAll();
    	$query = $this->plugin->getQuery($this->plugin->getChannel());
    	$version = new VersionString();
    	$server = Server::getInstance();
		$logger = $server->getLogger();
		//Checking query
		if(isset($query["version"]) && isset($query["api_version"]) && isset($query["build"]) && isset($query["date"]) && isset($query["details_url"]) && isset($query["download_url"])){
			//Checking Build
			if($version->getBuild() < $query["build"]){
				$filename = $this->plugin->getFileName();
				$logger->info($this->plugin->translateColors("&", Main::PREFIX . "&aA new PocketMine update is available!"));
				$logger->info($this->plugin->translateColors("&", Main::PREFIX . "&eDetails: PocketMine " . $version->get() . " (Build #" . $query["build"] . ") API " . $query["api_version"] . " was released on " . date("d/m/Y h:i:s", $query["date"])));
				$logger->info($this->plugin->translateColors("&", Main::PREFIX . "&eDownload URL: " . $query["download_url"]));
				//Check auto-update
				if($this->cfg["auto-update"] == true){
					$logger->info($this->plugin->translateColors("&", Main::PREFIX . "&aUpdating PocketMine..."));
					$this->plugin->getServer()->getScheduler()->scheduleAsyncTask(new Downloader($query["download_url"], $this->plugin->getDataFolder() . "/" . $filename));
					//Do Timeout
					sleep($this->plugin->getTimeout());
					//Checking status 
					if(file_exists($this->plugin->getDataFolder() . "/" . $filename)){
						$logger->info($this->plugin->translateColors("&", Main::PREFIX . "&aPocketMine updated. Restarting server now..."));
						$this->plugin->getServer()->forceShutdown();
						sleep(1);
						copy($this->plugin->getDataFolder() . "/" . $this->plugin->getFileName(), $this->plugin->getServer()->getDataPath() . "/" . $filename);
						unlink($this->plugin->getDataFolder() . "/" . $filename);
						shell_exec($this->plugin->getStartScript());
					}else{
						$logger->info($this->plugin->translateColors("&", Main::PREFIX . "&cCan't update PocketMine, an error has occurred"));
					}
				}
			}
		}else{
			$logger->info($this->plugin->translateColors("&", Main::PREFIX . "&cCan't update PocketMine, an error has occurred"));
		}
    }
}
?>
