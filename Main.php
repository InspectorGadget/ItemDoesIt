<?php

namespace ItemDoesIt\RTG;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\Level;
use pocketmine\item\Item;
use pocketmine\entity\Effect;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\inventory\Inventory;

class Main extends PluginBase implements Listener {

	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		//if($this->getServer()->getPluginManager()->getPlugin("ServerCore")) {
			//$this->getLogger()->critical("ServerCore isn't supported atm!");
			//$this->setEnabled(false);
		//}
	}
	
	public function onGive($player) {
	
		$player->getInventory()->addItem(Item::get(388, 0, 1)->setCustomName("§eSpawn\nTeleports you to Spawn"));
		$player->getInventory()->addItem(Item::get(347, 0, 1)->setCustomName("§bRandom Effect\nGives you a random Effect"));
	
	}
	
	public function onHeld(PlayerItemHeldEvent $e) {
	
		$player = $e->getPlayer();
		
		$hand = $player->getInventory()->getItemInHand();
		
		if($hand->getCustomName() === "§eSpawn\nTeleports you to Spawn") {
			$l = $this->getServer()->getDefaultLevel()->getSafeSpawn();
			$player->teleport($l);
		}
		
		if($hand->getCustomName() === "§bRandom Effect\nGives you a random Effect") {
			switch(mt_rand(1,3)) {
			
			case "1":
				$effect = Effect::getEffect(3);
				$effect->setDuration(13 * 20);
				$effect->setAmplifier(1);
				$player->addEffect($effect);
			return;
			case "2":
				$effectt = Effect::getEffect(19);
				$effectt->setDuration(13 * 20);
				$effectt->setAmplifier(1);
				$player->addEffect($effectt);
			return;
			case "3":
				$effecttt = Effect::getEffect(20);
				$effecttt->setDuration(13 * 20);
				$effecttt->setAmplifier(1);
				$player->addEffect($effecttt);
			return;
			}
		}
	}
	
	public function onJoin(PlayerJoinEvent $ev) {
		$player = $ev->getPlayer();
		foreach($player->getInventory()->getItem() as $inv) {
			if(!$inv->getId() === "338") {
				if(!$inv->getId() === "347") {
					$this->onGive($player);
				}
			}
		
		}
		
	}
	
	public function onDisable() {
	}
	
}
