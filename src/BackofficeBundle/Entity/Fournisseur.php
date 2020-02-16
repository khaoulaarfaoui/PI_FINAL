<?php

namespace BackofficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity(repositoryClass="BackofficeBundle\Repository\FournisseurRepository")
 */
class Fournisseur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $Name;

    /**
     * @var string
     *
     * @ORM\Column(name="Last_name", type="string", length=255)
     */
    private $Last_name;

    /**
     * @var string
     *
     * @ORM\Column(name="societe", type="string", length=255)
     */
    private $societe;

    /**
     * @var string
     *
     * @ORM\Column(name="BirthDate", type="date", length=255)
     */
    private $BirthDate;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->Last_name;
    }

    /**
     * @param string $Last_name
     */
    public function setLastName($Last_name)
    {
        $this->Last_name = $Last_name;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="numsociete", type="string", length=255)
     */
    private $numSociete;

    /**
     * @var string
     *
     * @ORM\Column(name="secteur", type="string", length=255)
     */
    private $secteur;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set societe.
     *
     * @param string $societe
     *
     * @return Fournisseur
     */
    public function setSociete($societe)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe.
     *
     * @return string
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * Set numSociete.
     *
     * @param string $numSociete
     *
     * @return Fournisseur
     */
    public function setNumSociete($numSociete)
    {
        $this->numSociete = $numSociete;

        return $this;
    }

    /**
     * Get numSociete.
     *
     * @return string
     */
    public function getNumSociete()
    {
        return $this->numSociete;
    }

    /**
     * Set secteur.
     *
     * @param string $secteur
     *
     * @return Fournisseur
     */
    public function setSecteur($secteur)
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * Get secteur.
     *
     * @return string
     */
    public function getSecteur()
    {
        return $this->secteur;
    }
    /**
     * @ORM\ManyToOne(targetEntity="BackofficeBundle\Entity\Admin", inversedBy="fournisseurs")
     */
    private $admin;

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * Set birthDate.
     *
     * @param \DateTime $birthDate
     *
     * @return Fournisseur
     */
    public function setBirthDate($birthDate)
    {
        $this->BirthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate.
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->BirthDate;
    }
}
