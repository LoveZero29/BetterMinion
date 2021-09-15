<?php
declare(strict_types=1);

namespace Mcbeany\BetterMinion\minions;

use pocketmine\nbt\tag\CompoundTag;

interface MinionNBT
{
    public const OWNER = "minionOwner";
    public const TYPE = "minionType";
    public const TARGET = "minionTarget";
    public const LEVEL = "minionLevel";
    public const UPGRADE = "minionUpgrade";
    public const RESOURCES_COLLECTED = "minionResourcesCollected";

    public const MINING = 0;
    public const FARMING = 1;
    public const LUMBERJACK = 2;

    public const AUTO_SMELTER = "autoSmelter";
    public const AUTO_SELLER = "autoSeller";
    public const COMPACTOR = "compactor";
    public const EXPANDER = "expander";

    public function nbtSerialize(): CompoundTag;

    public static function nbtDeserialize(CompoundTag $tag);
}