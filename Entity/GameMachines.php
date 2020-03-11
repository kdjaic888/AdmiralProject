<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameMachinesRepository")
 */
class GameMachines
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $serial_number;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end_of_guarantee_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $game_type_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSerialNumber(): ?int
    {
        return $this->serial_number;
    }

    public function setSerialNumber(int $serial_number): self
    {
        $this->serial_number = $serial_number;

        return $this;
    }

    public function getEndOfGuaranteeDate()
    {
        return $this->end_of_guarantee_date;
    }

    public function setEndOfGuaranteeDate(\DateTime $end_of_guarantee_date)
    {
        $this->end_of_guarantee_date = $end_of_guarantee_date;
    }

    public function getGameTypeId(): ?string
    {
        return $this->game_type_id;
    }

    public function setGameTypeId(string $game_type_id): self
    {
        $this->game_type_id = $game_type_id;

        return $this;
    }
}
