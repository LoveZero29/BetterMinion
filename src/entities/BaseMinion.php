<?php
declare(strict_types=1);

namespace Mcbeany\BetterMinion\entities;

use Mcbeany\BetterMinion\minions\MinionInformation;
use pocketmine\entity\Human;
use pocketmine\inventory\SimpleInventory;
use pocketmine\nbt\tag\CompoundTag;

class BaseMinion extends Human
{
    protected MinionInformation $minionInformation;
    protected SimpleInventory $minionInventory;

    public const MINION_SIZE = 0.5;

    protected function initEntity(CompoundTag $nbt): void
    {
        parent::initEntity($nbt);
        $this->setScale(self::MINION_SIZE);
        $this->setImmobile();
        $this->setNameTagAlwaysVisible();
    }

    public function saveNBT(): CompoundTag
    {
        $nbt = parent::saveNBT();
        return $nbt;
    }

}