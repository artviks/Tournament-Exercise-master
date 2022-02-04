<?php

namespace Tournament\Warriors;

use Tournament\Equipment\Weapons\GreatSword;
use Tournament\Equipment\Weapons\Sword;
use Tournament\Warrior;

class Highlander extends Warrior
{
    protected int $baseHitPoints = 150;
    protected int $hitPoints = 150;

    public function __construct(string $ability = null)
    {
        parent::__construct($ability);
        $this->equipment->addEquipment(new GreatSword());
    }

}