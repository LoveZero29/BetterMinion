<?php
declare(strict_types=1);

namespace Mcbeany\BetterMinion;

use Mcbeany\BetterMinion\minions\MinionManager;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class BetterMinion extends PluginBase
{
    use SingletonTrait;
    
    private MinionManager $manager;

    protected function onEnable(): void
    {
        self::setInstance($this);
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        if (!InvMenuHandler::isRegistered()) {
            InvMenuHandler::register($this);
        }
        $this->manager = new MinionManager();
    }

    public function getManager(): MinionManager
    {
        return $this->manager;
    }

}