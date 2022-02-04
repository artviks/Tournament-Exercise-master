<?php

namespace Tournament\Warriors;

use Tournament\Equipment\Weapons\Sword;
use Tournament\Warrior;

class Swordsman extends Warrior
{
    protected int $baseHitPoints = 100;
    protected int $hitPoints = 100;

    public function __construct(string $ability = null)
    {
        parent::__construct($ability);
        $this->equipment->addEquipment(new Sword());
    }
}
