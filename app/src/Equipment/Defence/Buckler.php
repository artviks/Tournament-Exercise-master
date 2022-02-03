<?php

namespace Tournament\Equipment\Defence;

use Tournament\Equipment\Equipment;
use Tournament\Equipment\Weapon;
use Tournament\Equipment\Weapons\Axe;
use Tournament\FightResources\Attack;

class Buckler implements Equipment
{
    public int $count = 0;
    public int $axeHitDurability = 3;

    public function receivedDamageFrom(Weapon $weapon, Attack $attack): ?Attack
    {
        if ($this->axeHitDurability === 0) {
            return $attack;
        }

        $this->count++;

        if ($this->count % 2 === 0 && $weapon instanceof Axe) {
            $this->axeHitDurability--;
        }

        return $this->count % 2 === 0 ? $attack : null;
    }
}