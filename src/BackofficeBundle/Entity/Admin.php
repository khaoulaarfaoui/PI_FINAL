<?php

namespace BackofficeBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 *
 * @ORM\Table(name="admin")
 * @ORM\Entity(repositoryClass="BackofficeBundle\Repository\AdminRepository")
 */
class Admin
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     *
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @ORM\OneToMany(targetEntity="BackofficeBundle\Entity\Fournisseur", mappedBy="admin")
     */
    private $fournisseurs;

    /**
     * @return mixed
     */
    public function getFournisseurs()
    {
        return $this->fournisseurs;
    }

    /**
     * @param mixed $fournisseurs
     */
    public function setFournisseurs($fournisseurs)
    {
        $this->fournisseurs = $fournisseurs;
    }

    /**
     * @ORM\OneToMany(targetEntity="BackofficeBundle\Entity\Employee", mappedBy="admin")
     */
    private $employees;

    /**
     * @return mixed
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param mixed $employees
     */
    public function setEmployees($employees)
    {
        $this->employees = $employees;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fournisseurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->employees = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fournisseur.
     *
     * @param \BackofficeBundle\Entity\Fournisseur $fournisseur
     *
     * @return Admin
     */
    public function addFournisseur(\BackofficeBundle\Entity\Fournisseur $fournisseur)
    {
        $this->fournisseurs[] = $fournisseur;

        return $this;
    }

    /**
     * Remove fournisseur.
     *
     * @param \BackofficeBundle\Entity\Fournisseur $fournisseur
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFournisseur(\BackofficeBundle\Entity\Fournisseur $fournisseur)
    {
        return $this->fournisseurs->removeElement($fournisseur);
    }

    /**
     * Add employee.
     *
     * @param \BackofficeBundle\Entity\Employee $employee
     *
     * @return Admin
     */
    public function addEmployee(\BackofficeBundle\Entity\Employee $employee)
    {
        $this->employees[] = $employee;

        return $this;
    }

    /**
     * Remove employee.
     *
     * @param \BackofficeBundle\Entity\Employee $employee
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeEmployee(\BackofficeBundle\Entity\Employee $employee)
    {
        return $this->employees->removeElement($employee);
    }
}
