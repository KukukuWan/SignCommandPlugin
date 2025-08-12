<?php

namespace KukukuWan\SignCommandPlugin;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\block\Sign;
use pocketmine\block\utils\SignText;
use pocketmine\command\ConsoleCommandSender;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerInteract(PlayerInteractEvent $event): void {
        $block = $event->getBlock();
        if ($block instanceof Sign) {
            $text = $block->getText();
            $line = $text->getLine(0);
            if (str_starts_with($line, "/")) {
                $command = substr($line, 1);
                $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $command);
            }
        }
    }
}
