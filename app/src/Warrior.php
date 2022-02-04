<?php

namespace Tournament;

use Tournament\Equipment\EquipmentCollection;
use Tournament\Equipment\Weapon;
use Tournament\Equipment\Weapons\GreatSword;
use Tournament\FightResources\Attack;

class Warrior
{
    private const VETERAN_HP = 0.3; // 30% of baseHP
    private const VETERAN_ATTACK_UPGRADE = 1; // + 100% of current attack
    private const VICIOUS_ENDS = 3; // tick
    private const VICIOUS_ATTACK_UPGRADE = 20;

    protected int $baseHitPoints;
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

        $this->useAbility($attack, $tick);

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

    private function useAbility(Attack $attack, int $tick): void
    {
        if ($tick < self::VICIOUS_ENDS && $this->ability === "Vicious")
        {
            $attack->addDamage(self::VICIOUS_ATTACK_UPGRADE);
        }

        if ($this->ability === "Veteran" && $this->hitPoints / $this->baseHitPoints  < self::VETERAN_HP)
        {
            $attack->addDamage($attack->getDamage() * self::VETERAN_ATTACK_UPGRADE);
        }
    }
}
