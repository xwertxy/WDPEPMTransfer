<?php

namespace xwertxy\WDPEPMTransfer;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\network\mcpe\protocol\TransferPacket;

class WdpeTransfer extends PluginBase {

  public function onEnable() : void {
    $this->getServer()->getCommandMap()->register("WDPEPMTransfer", new WdpeTransferCommand());
  }

  public static function transferServer(Player $player, string $address, int $port = 19132) : void {
    $player->getNetworkSession()->sendDataPacket(TransferPacket::create($address, $port));
  }
}
