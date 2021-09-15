<?php
declare(strict_types=1);

namespace Mcbeany\BetterMinion\minions;

use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\nbt\tag\CompoundTag;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class MinionInformation implements MinionNBT
{
    private UuidInterface $owner;
    private int $type;
    private Block $target;
    private int $level;
    private MinionUpgrade $upgrade;
    private int $resourcesCollected;

    public function __construct(UuidInterface $owner, int $type, Block $target, int $level, MinionUpgrade $upgrade, int $resourcesCollected)
    {
        $this->owner = $owner;
        $this->type = $type;
        $this->target = $target;
        $this->level = $level;
        $this->upgrade = $upgrade;
        $this->resourcesCollected = $resourcesCollected;
    }

    public function getOwner(): UuidInterface
    {
        return $this->owner;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getTarget(): Block
    {
        return $this->target;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function getUpgrade(): MinionUpgrade
    {
        return $this->upgrade;
    }

    public function getResourcesCollected(): int
    {
        return $this->resourcesCollected;
    }

    public function incrementLevel(): void
    {
        $this->level++;
    }

    public function incrementResourcesCollected(int $resourcesCollected): void
    {
        $this->resourcesCollected += $resourcesCollected;
    }


    public function nbtSerialize(): CompoundTag
    {
        return CompoundTag::create()
            ->setString(self::OWNER, $this->getOwner()->toString())
            ->setInt(self::TYPE, $this->getType())
            ->setString(self::TARGET, implode(":", array($this->getTarget()->getId(), $this->getTarget()->getMeta())))
            ->setInt(self::LEVEL, $this->getLevel())
            ->setTag(self::UPGRADE, $this->getUpgrade()->nbtSerialize())
            ->setInt(self::RESOURCES_COLLECTED, $this->getResourcesCollected());
    }

    public static function nbtDeserialize(CompoundTag $tag): self
    {
        return new self(Uuid::fromString($tag->getString(self::OWNER)),
            $tag->getInt(self::TYPE),
            VanillaBlocks::fromString($tag->getString(self::TARGET)),
            $tag->getInt(self::LEVEL),
            MinionUpgrade::nbtDeserialize($tag->getCompoundTag(self::UPGRADE)),
            $tag->getInt(self::RESOURCES_COLLECTED));
    }
}