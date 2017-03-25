<?php

/* 
 * Copyright (C) 2017 RTG
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace RTG\ItemDoesIt;

/* Essentials */
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\Server;
use pocketmine\entity\Effect;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;

class Loader extends PluginBase implements Listener {
    
    public function onEnable() {
        
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        
    }
    
    public function onGive(Player $p) {
        
        $itemm = \pocketmine\item\Item::get(338, 0, 1);
        $itemm->setCustomName(TF::YELLOW . "Spawn" . "\n" . TF::RED . "Teleports you to Spawn!");
        $item = \pocketmine\item\Item::get(347, 0, 1);
        $item->setCustomName(TF::RED . "Random Effect" . "\n" . TF::YELLOW . "Gives your random effect!");
        $p->getInventory()->addItem($item);
        $p->getInventory()->addItem($itemm);
        
    }
    
    public function onHold(PlayerItemHeldEvent $e) {
        
        $p = $e->getPlayer();
        $hand = $p->getInventory()->getItemInHand();
        
            if ($hand->getCustomName() === TF::YELLOW . 'Spawn' . '\n' . TF::RED . 'Teleports you to Spawn!') {
                
                $level = $this->getServer()->getDefaultLevel();
                $x = $level->getSafeSpawn()->getX();
                $y = $level->getSafeSpawn()->getY();
                $z = $level->getSafeSpawn()->getZ();
                $p->teleport(new \pocketmine\math\Vector3($x, $y, $z));
               
            }
            
            if ($hand->getCustomName() === TF::RED . 'Random Effect' . '\n' . TF::YELLOW . 'Gives your random effect!') {
                
                $rand = mt_rand(1, 3);
                
                switch($rand) {
                    
                    case 1:
                        
                        $effect = Effect::getEffect(3);
                        $effect->setDuration(13 * 20);
                        $effect->setAmplifier(1);
                        $p->addEffect($effect);
                        
                    return;
                
                    case 2:
                        
                        $effect = Effect::getEffect(19);
                        $effect->setDuration(13 * 20);
                        $effect->setAmplifier(1);
                        $p->addEffect($effect);
                        
                    return;
                    
                    case 2:
                        
                        $effect = Effect::getEffect(20);
                        $effect->setDuration(13 * 20);
                        $effect->setAmplifier(1);
                        $p->addEffect($effect);
                        
                    return;
                    
                }
                
            }
        
    }
    
    public function onJoin(\pocketmine\event\player\PlayerJoinEvent $e) {
        
        $inv = $e->getPlayer()->getInventory()->contains(\pocketmine\item\Item::get(338, 0, 1));
        $inv2 = $e->getPlayer()->getInventory()->contains(\pocketmine\item\Item::get(347, 0, 1));        

            if($inv != false && $inv2 != false) {
                $this->getLogger()->warning("No");
                $e->getPlayer()->getInventory()->remove(\pocketmine\item\Item::get(338, 0, 1));
                $e->getPlayer()->getInventory()->remove(\pocketmine\item\Item::get(347, 0, 1));
                $this->onGive($e->getPlayer());
            } else {
                $this->onGive($e->getPlayer());
            }
            
    }
    
    public function onDisable() {
        
    }
    
}