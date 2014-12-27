<?php

/*
 * AutoUpdater (v1.1) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 27/12/2014 02:41 PM (UTC)
 * Copyright & License: (C) 2014 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/AutoUpdater/blob/master/LICENSE)
 */

namespace AutoUpdater\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\permission\Permission;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Utils;
use pocketmine\utils\VersionString;

use AutoUpdater\Main;
use AutoUpdater\Downloader;

class Update extends PluginBase implements CommandExecutor{

	public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
    	$fcmd = strtolower($cmd->getName());
    	switch($fcmd){
    		case "update":
    			if($sender->hasPermission("autoupdater.update")){
    				$query = $this->plugin->getQuery($this->plugin->getChannel());
    				$version = new VersionString();
    				//Checking query
    				if(isset($query["version"]) && isset($query["api_version"]) && isset($query["build"]) && isset($query["date"]) && isset($query["details_url"]) && isset($query["download_url"])){
    					//Checking Build
    					if($version->getBuild() < $query["build"]){
    						$filename = $this->plugin->getFileName();
    						$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&aUpdating PocketMine..."));
    						$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&eDetails: PocketMine " . $version->get() . " (Build #" . $query["build"] . ") API " . $query["api_version"] . " was released on " . date("d/m/Y h:i:s", $query["date"])));
    						$this->plugin->getServer()->getScheduler()->scheduleAsyncTask(new Downloader($query["download_url"], $this->plugin->getDataFolder() . "/" . $filename));
    						//Do Timeout
    						sleep($this->plugin->getTimeout());
    						//Checking status
    						if(file_exists($this->plugin->getDataFolder() . "/" . $filename)){
    							$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&aPocketMine updated. Restarting server now..."));
    							$this->plugin->getServer()->forceShutdown();
    							sleep(1);
    							copy($this->plugin->getDataFolder() . "/" . $filename, $this->plugin->getServer()->getDataPath() . "/" . $filename);
    							unlink($this->plugin->getDataFolder() . "/" . $filename);
    							shell_exec($this->plugin->getStartScript());
    						}else{
    							$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&cCan't update PocketMine, an error has occurred"));
    						}
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&aYour PocketMine version is already up to date."));
    					}
    				}else{
    					$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&cCan't update PocketMine, an error has occurred"));
    				}
    			}else{
    				$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    				break;
    			}
    	}
    }
}
