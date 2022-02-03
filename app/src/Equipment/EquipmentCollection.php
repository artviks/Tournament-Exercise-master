<?php

namespace Tournament\Equipment;

use Tournament\Equipment\Defence\Armor;
use Tournament\Equipment\Defence\Buckler;

class EquipmentCollection
{
    private array $collection;

    public function addEquipment(Equipment $equipment): void
    {
        $key = get_parent_class($equipment) ?: get_class($equipment);
        $this->collection[$key] = $equipment;
    }

    public function weapon(): Weapon
    {
        return $this->collection[Weapon::class];
    }

    public function buckler(): ?Buckler
    {
        return $this->collection[Buckler::class] ?? null;
    }

    public function armor(): ?Armor
    {
        return $this->collection[Armor::class] ?? null;
    }

    public function getCollection(): array
    {
        return $this->collection;
    }
}