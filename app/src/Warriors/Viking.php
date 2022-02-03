<?php

namespace Tournament\Warriors;

use Tournament\Equipment\Weapons\Axe;
use Tournament\Warrior;

class Viking extends Warrior
{
    protected int $maxHitPoints = 120;
    protected int $hitPoints = 120;

    public function __construct(string $ability = null)
    {
        parent::__construct($ability);
        $this->equipment->addEquipment(new Axe());
    }
}