<?php
declare(strict_types=1);

namespace Mcbeany\BetterMinion;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\ItemIds;
use pocketmine\world\Position;

final class EventListener implements Listener
{

    public function onUseItem(PlayerItemUseEvent $event)
    {
        $player = $event->getPlayer();
        $item = $event->getItem();
        if ($item->getId() === ItemIds::NETHER_STAR) {
            $item->pop();
            BetterMinion::getInstance()->getManager()->spawnMinion(Position::fromObject($player->getPosition()->add(0.5, 0, 0.5), $player->getWorld()), $player->getSkin());
        }
    }

}