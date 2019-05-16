<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChangesSiteChangesRepository")
 */
class ChangesSiteChanges
{

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Changes")
     * @ORM\JoinColumn(name="change_id", referencedColumnName="change_id")
     */
    private $change_id;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\SiteChanges")
     * @ORM\JoinColumn(name="site_changes_id", referencedColumnName="site_changes_id")
     */
    private $site_changes_id;

    public function getChangeId(): ?Changes
    {
        return $this->change_id;
    }

    public function setChangeId(?Changes $change_id): self
    {
        $this->change_id = $change_id;

        return $this;
    }

    public function getSiteChangesId(): ?SiteChanges
    {
        return $this->site_changes_id;
    }

    public function setSiteChangesId(?SiteChanges $site_changes_id): self
    {
        $this->site_changes_id = $site_changes_id;

        return $this;
    }
}
