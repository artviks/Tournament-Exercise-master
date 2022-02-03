<?php

namespace Tournament\FightResources;

use Tournament\Equipment\EquipmentCollection;

class Attack
{
    private int $damage;

    public function getDamage(): int
    {
        return $this->damage;
    }

    public function setDamage(EquipmentCollection $equipment): void
    {
        $damage = 0;
        foreach ($equipment->getCollection() as $eq) {
            if (method_exists($eq, 'damageOutput')) {
                $damage += $eq->damageOutput();
            }
        }
        $this->damage = $damage;
    }

    public function addDamage(int $hitPoints): void
    {
        $this->damage += $hitPoints;
    }

}