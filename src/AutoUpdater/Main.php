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

use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Utils;
use pocketmine\utils\VersionString;

class Main extends PluginBase{
	
	//About Plugin Const
	const PRODUCER = "EvolSoft";
	const VERSION = "1.1";
	const MAIN_WEBSITE = "http://www.evolsoft.tk";
	//Other Const
	//Prefix
	const PREFIX = "&7[&9Auto&aUpdater&7] ";
	const API_URL = "http://pocketmine.net/api/";
	
    public $cfg;

    public function translateColors($symbol, $message){
    
    	$message = str_replace($symbol."0", TextFormat::BLACK, $message);
    	$message = str_replace($symbol."1", TextFormat::DARK_BLUE, $message);
    	$message = str_replace($symbol."2", TextFormat::DARK_GREEN, $message);
    	$message = str_replace($symbol."3", TextFormat::DARK_AQUA, $message);
    	$message = str_replace($symbol."4", TextFormat::DARK_RED, $message);
    	$message = str_replace($symbol."5", TextFormat::DARK_PURPLE, $message);
    	$message = str_replace($symbol."6", TextFormat::GOLD, $message);
    	$message = str_replace($symbol."7", TextFormat::GRAY, $message);
    	$message = str_replace($symbol."8", TextFormat::DARK_GRAY, $message);
    	$message = str_replace($symbol."9", TextFormat::BLUE, $message);
    	$message = str_replace($symbol."a", TextFormat::GREEN, $message);
    	$message = str_replace($symbol."b", TextFormat::AQUA, $message);
    	$message = str_replace($symbol."c", TextFormat::RED, $message);
    	$message = str_replace($symbol."d", TextFormat::LIGHT_PURPLE, $message);
    	$message = str_replace($symbol."e", TextFormat::YELLOW, $message);
    	$message = str_replace($symbol."f", TextFormat::WHITE, $message);
    
    	$message = str_replace($symbol."k", TextFormat::OBFUSCATED, $message);
    	$message = str_replace($symbol."l", TextFormat::BOLD, $message);
    	$message = str_replace($symbol."m", TextFormat::STRIKETHROUGH, $message);
    	$message = str_replace($symbol."n", TextFormat::UNDERLINE, $message);
    	$message = str_replace($symbol."o", TextFormat::ITALIC, $message);
    	$message = str_replace($symbol."r", TextFormat::RESET, $message);
    
    	return $message;
    }
    
    public function onEnable(){
	    @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->cfg = $this->getConfig()->getAll();
        $this->getCommand("autoupdater")->setExecutor(new Commands\Commands($this));
        $this->getCommand("update")->setExecutor(new Commands\Update($this));
        $time = intval($this->cfg["update-check-time"]) * 20;
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new Query($this), $time * 60);
    }
    
    public function getChannel(){
    	$tmp = $this->getConfig()->getAll();
    	return $tmp["channel"];
    }
    
    public function getStartScript(){
    	$tmp = $this->getConfig()->getAll();
    	return $tmp["start-script"];
    }
    
    public function getQuery($channel){
    	$query = Utils::getURL(Main::API_URL . "?channel=" . strtolower($channel));
    	$query = json_decode($query, true);
    	return $query;
    }
    
    public function getFileName(){
    	$tmp = $this->getConfig()->getAll();
    	if(strtolower(substr($tmp["file-name"], -5)) == ".phar"){
    		return $tmp["file-name"];
    	}else{
    		return $tmp["file-name"] . ".phar";
    	}
    }	
    
    public function getTimeout(){
    	$tmp = $this->getConfig()->getAll();
    	return $tmp["timeout"];
    }
}
?>
