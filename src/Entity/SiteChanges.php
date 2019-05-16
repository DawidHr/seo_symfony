<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiteChangesRepository")
 */
class SiteChanges
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $site_changes_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sites")
     * @ORM\JoinColumn(name="site_id", referencedColumnName="site_id")
     */
    private $site_id;

    /**
     * @ORM\Column(name="changeDate",type="datetime")
     */
    private $changeDate;

    public function getSiteChangesId(): ?int
    {
        return $this->site_changes_id;
    }

    public function getSiteId(): ?Sites
    {
        return $this->site_id;
    }

    public function setSiteId(?Sites $site_id): self
    {
        $this->site_id = $site_id;

        return $this;
    }

    public function getChangeDate(): ?\DateTimeInterface
    {
        return $this->changeDate;
    }

    public function setChangeDate(\DateTimeInterface $changeDate): self
    {
        $this->changeDate = $changeDate;

        return $this;
    }
}
