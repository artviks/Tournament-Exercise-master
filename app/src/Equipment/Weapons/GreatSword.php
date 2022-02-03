<?php

namespace Tournament\Equipment\Weapons;

use Tournament\Equipment\Equipment;
use Tournament\Equipment\Weapon;

class GreatSword extends Weapon implements Equipment
{
    protected int $damage = 12;
}