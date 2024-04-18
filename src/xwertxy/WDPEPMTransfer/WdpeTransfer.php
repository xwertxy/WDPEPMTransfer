<?php

namespace xwertxy\WDPEPMTransfer;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\network\mcpe\protocol\TransferPacket;
use pocketmine\utils\SingletonTrait;

class WdpeTransfer extends PluginBase {
  use SingletonTrait;
  
  public function onLoad() : void {
    self::setInstance($this);
  }
  
  public function onEnable() : void {
    $this->getServer()->getCommandMap()->register("WDPEPMTransfer", new WdpeTransferCommand());
  }

  public static function transferServer(Player $player, string $address, int $port = 19132) : void {
    $player->getNetworkSession()->sendDataPacket(TransferPacket::create($address, $port));
  }
}
