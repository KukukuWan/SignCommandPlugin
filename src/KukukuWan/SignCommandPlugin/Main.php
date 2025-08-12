<?php

namespace KukukuWan\SignCommandPlugin;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\block\tile\Sign as TileSign;
use pocketmine\player\Player;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerInteract(PlayerInteractEvent $event): void {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $world = $player->getWorld();
        $pos = $block->getPosition();

        $tile = $world->getTile($pos);
        if ($tile instanceof TileSign) {
            $text = $tile->getText();
            $line1 = $text->getLine(0);
            $line2 = $text->getLine(1);

            if (strtolower(trim($line1)) === "[cmd]" && str_starts_with($line2, "/")) {
                $event->cancel();
                $command = substr($line2, 1);
                $this->getServer()->dispatchCommand($player, $command);
            }
        }
    }
}
