<?php
declare(strict_types=1);

namespace Mcbeany\BetterMinion\minions;

use Mcbeany\BetterMinion\entities\types\MiningMinion;
use Mcbeany\BetterMinion\entities\BaseMinion;
use pocketmine\entity\EntityDataHelper;
use pocketmine\entity\EntityFactory;
use pocketmine\entity\Human;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\world\Position;
use pocketmine\world\World;

final class MinionManager
{
    private static array $minions = [MiningMinion::class];

    public function __construct()
    {
        foreach (self::$minions as $minion) {
            EntityFactory::getInstance()->register($minion, function (World $world, CompoundTag $nbt) use ($minion): BaseMinion {
                return new $minion(EntityDataHelper::parseLocation($nbt, $world), Human::parseSkinNBT($nbt));
            }, [basename($minion)]);
        }
    }

    public function spawnMinion(Position $position, Skin $skin/*, CompoundTag $nbt*/)
    {
        $minion = new BaseMinion(Location::fromObject($position->asVector3(), $position->getWorld()), $skin/*, $nbt*/);
        $minion->spawnToAll();
    }

}