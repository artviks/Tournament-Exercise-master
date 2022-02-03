<?php

namespace Tournament;

use Tournament\Equipment\EquipmentCollection;
use Tournament\Equipment\Weapon;
use Tournament\Equipment\Weapons\GreatSword;
use Tournament\FightResources\Attack;

class Warrior
{
    protected int $maxHitPoints;
    protected int $hitPoints;
    protected EquipmentCollection $equipment;
    private ?string $ability;

    public function __construct(?string $ability)
    {
        $this->ability = $ability;
        $this->equipment= new EquipmentCollection();
    }

    public function engage(Warrior $warrior): void
    {
        $tick = 1;
        while ($warrior->hitPoints() > 0 && $this->hitPoints > 0) {
            $warrior->defend($this->attack($tick), $this->equipment()->weapon());
            $this->defend($warrior->attack($tick), $warrior->equipment()->weapon());
            $tick++;
            var_dump($warrior->hitPoints());
            var_dump($this->hitPoints);
        }
    }

    public function defend(?Attack $attack, Weapon $weapon): void
    {
        if ($attack === null) {
            return;
        }

        if ($this->equipment->buckler()) {
            $attack = $this->equipment->buckler()->receivedDamageFrom($weapon, $attack);
        }

        if ($attack && $this->equipment->armor()) {
            $attack->addDamage($this->equipment->armor()->attack());
        }

        if ($attack && $attack->getDamage() > $this->hitPoints()) {
            $this->hitPoints = 0;
            return;
        }

        $this->hitPoints -= $attack ? $attack->getDamage() : 0;
    }

    public function attack(int $tick): ?Attack
    {
        if ($tick % 3 === 0 && $this->equipment->weapon() instanceof GreatSword) {
            return null;
        }

        $attack = new Attack();
        $attack->setDamage($this->equipment);

        if ($tick < 3 && $this->ability === "Vicious")
        {
            $attack->addDamage(20);
        }

        if ($this->ability === "Veteran" && $this->hitPoints / $this->maxHitPoints  < 0.3)
        {
            $attack->addDamage($attack->getDamage());
        }

        return $attack;
    }

    public function equip(string $equipment): self
    {
        $eq = require __DIR__ . '/Equipment/warehouse.php';
        $this->equipment->addEquipment(new $eq[$equipment]);

        return $this;
    }

    public function hitPoints(): int
    {
        return $this->hitPoints;
    }

    public function equipment(): EquipmentCollection
    {
        return $this->equipment;
    }
}