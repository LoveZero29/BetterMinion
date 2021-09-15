<?php
declare(strict_types=1);

namespace Mcbeany\BetterMinion\minions;

use pocketmine\nbt\tag\CompoundTag;

class MinionUpgrade implements MinionNBT
{
    private bool $autoSmelter, $autoSeller, $compactor, $expander;

    public function __construct(bool $autoSmelter, bool $autoSeller, bool $compactor, bool $expander)
    {
        $this->autoSmelter = $autoSmelter;
        $this->autoSeller = $autoSeller;
        $this->compactor = $compactor;
        $this->expander = $expander;
    }

    public function isAutoSmelter(): bool
    {
        return $this->autoSmelter;
    }

    public function setAutoSmelter(bool $autoSmelter): void
    {
        $this->autoSmelter = $autoSmelter;
    }

    public function isAutoSeller(): bool
    {
        return $this->autoSeller;
    }

    public function setAutoSeller(bool $autoSeller): void
    {
        $this->autoSeller = $autoSeller;
    }

    public function isCompactor(): bool
    {
        return $this->compactor;
    }

    public function setCompactor(bool $compactor): void
    {
        $this->compactor = $compactor;
    }

    public function isExpander(): bool
    {
        return $this->expander;
    }

    public function setExpander(bool $expander): void
    {
        $this->expander = $expander;
    }

    public function nbtSerialize(): CompoundTag
    {
        return CompoundTag::create()
            ->setByte(self::AUTO_SMELTER, intval($this->isAutoSmelter()))
            ->setByte(self::AUTO_SELLER, intval($this->isAutoSeller()))
            ->setByte(self::COMPACTOR, intval($this->isCompactor()))
            ->setByte(self::EXPANDER, intval($this->isExpander()));
    }

    public static function nbtDeserialize(CompoundTag $tag): self
    {
        return new self(boolval($tag->getByte(self::AUTO_SMELTER)),
            boolval($tag->getByte(self::AUTO_SELLER)),
            boolval($tag->getByte(self::COMPACTOR)),
            boolval($tag->getByte(self::EXPANDER)));
    }
}