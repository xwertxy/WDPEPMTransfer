<?php

namespace xwertxy\WDPEPMTransfer;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\Plugin;

class WdpeTransferCommand extends Command implements PluginOwned {

  public function getOwningPlugin() : Plugin {
    return WdpeTransfer::getInstance();
  }
  
  public function __construct() {
    parent::__construct("transfer", "Transfer to another server.", "For Player: /transfer <server_name> [player_name] [port], For Console: /transfer <player_name> <server_name> [port]");
  }

  public function execute(CommandSender $sender, string $label, array $args) : void {
    if ($sender instanceof Player) {
      if(!isset($args[0])) {
        $sender->sendMessage(TextFormat::RED . "Usage: " . $this->usageMessage);
        return;
      }

      if (!isset($args[1])) {
        WdpeTransfer::transferServer($sender, $args[0]);
      } else {
        if (($target = Server::getInstance()->getPlayerExact($args[1])) !== null) {
          WdpeTransfer::transferServer($target, $args[0], $args[2] ?? 19132);
        } else {
          $sender->sendMessage(TextFormat::RED . "That player is not online!");
        }
      }
    } else {
      if (!isset($args[0]) || !isset($args[1])) {
        $sender->sendMessage(TextFormat::RED . "Usage: " . $this->usageMessage);
        return;
      }

      if (($target = Server::getInstance()->getPlayerExact($args[1])) !== null) {
          WdpeTransfer::transferServer($target, $args[0], $args[2] ?? 19132);
      } else {
          $sender->sendMessage(TextFormat::RED . "That player is not online!");
      }
    }
  }
}
