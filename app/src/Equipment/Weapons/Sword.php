<?php

namespace Tournament\Equipment\Weapons;

use Tournament\Equipment\Equipment;
use Tournament\Equipment\Weapon;

class Sword extends Weapon implements Equipment
{
    protected int $damage = 5;
}