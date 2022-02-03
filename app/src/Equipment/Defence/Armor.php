<?php

namespace Tournament\Equipment\Defence;

use Tournament\Equipment\Equipment;

class Armor implements Equipment
{
    protected int $attack = -3;
    protected int $damage = -1;

    public function attack(): int
    {
        return $this->attack;
    }

    public function damageOutput(): int
    {
        return $this->damage;
    }
}