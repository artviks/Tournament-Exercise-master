<?php

namespace Tournament\Equipment;

class Weapon
{
    protected int $damage;

    public function damageOutput(): int
    {
        return $this->damage;
    }
}