<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChangesRepository")
 */
class Changes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $change_id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;


    public function getChangeId(): ?int
    {
        return $this->change_id;
    }

    public function setChangeId(int $change_id): self
    {
        $this->change_id = $change_id;

        return $this;
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
}
