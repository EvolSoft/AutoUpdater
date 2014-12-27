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

use AutoUpdater\Main;

class Commands extends PluginBase implements CommandExecutor{

	public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
    	$fcmd = strtolower($cmd->getName());
    	switch($fcmd){
    		case "autoupdater":
    			if(isset($args[0])){
    				$args[0] = strtolower($args[0]);
    				if($args[0]=="help"){
    					if($sender->hasPermission("autoupdater")){
    						$sender->sendMessage($this->plugin->translateColors("&", "&9+ &aAvailable Commands &9+"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&e/au info &9-&e Show info about this plugin"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&e/au help &9-&e Show help about this plugin"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&e/au reload &9-&e Reload the config"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&e/update &9-&e Update PocketMine"));
    						break;
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    						break;
    					}
    				}elseif($args[0]=="info"){
    					if($sender->hasPermission("autoupdater.info")){
    						$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&eAutoUpdater &9v" . Main::VERSION . " &edeveloped by&9 " . Main::PRODUCER));
    						$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&eWebsite &9" . Main::MAIN_WEBSITE));
    				        break;
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    						break;
    					}
    				}elseif($args[0]=="reload"){
    					if($sender->hasPermission("autoupdater.reload")){
    						$this->plugin->reloadConfig();
    						$sender->sendMessage($this->plugin->translateColors("&", Main::PREFIX . "&aConfiguration Reloaded."));
    				        break;
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    						break;
    					}
    				}else{
    					if($sender->hasPermission("autoupdater")){
    						$sender->sendMessage($this->plugin->translateColors("&",  Main::PREFIX . "&cSubcommand &a" . $args[0] . " &cnot found. Use &a/au help &cto show available commands"));
    						break;
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    						break;
    					}
    				}
    				}else{
    					if($sender->hasPermission("autoupdater.commands.help")){
    						$sender->sendMessage($this->plugin->translateColors("&", "&9+ &aAvailable Commands &9+"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&e/au info &9-&e Show info about this plugin"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&e/au help &9-&e Show help about this plugin"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&e/au reload &9-&e Reload the config"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&e/update &9-&e Update PocketMine"));
    						break;
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    						break;
    					}
    				}
    			}
    	}
}
?>
