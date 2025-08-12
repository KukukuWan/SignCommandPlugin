use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\Block;
use pocketmine\block\utils\SignText;
use pocketmine\block\Sign;
use pocketmine\math\Vector3;
use pocketmine\Server;
use pocketmine\command\ConsoleCommandSender;

class SignCommandPlugin extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerInteract(PlayerInteractEvent $event): void {
        $block = $event->getBlock();
        if ($block instanceof Sign) {
            $text = $block->getText(); // SignTextオブジェクト
            $line = $text->getLine(0); // 1行目を取得
            if (str_starts_with($line, "/")) {
                $command = substr($line, 1); // `/`を除去
                $this->getServer()->dispatchCommand(new ConsoleCommandSender(), $command);
            }
        }
    }
}
