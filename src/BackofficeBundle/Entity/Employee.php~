<?php

namespace BackofficeBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="BackofficeBundle\Repository\EmployeeRepository")
 */
class Employee
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
     * @ORM\Column(name="Birth_Date", type="date", length=255)
     */
    private $Birth_date;
    /**
     * @var string
     *
     * @ORM\Column(name="Last_name", type="string", length=255)
     */
    private $Last_name;

    /**
     * @var string
     *
     * @ORM\Column(name="Fonction", type="string", length=255)
     */
    private $Fonction;
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     *
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="BackofficeBundle\Entity\Admin", inversedBy="employees")
     */
    private $admin;

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
     * Set name.
     *
     * @param string $name
     *
     * @return Employee
     */
    public function setName($name)
    {
        $this->Name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set lastName.
     *
     * @param string $lastName
     *
     * @return Employee
     */
    public function setLastName($lastName)
    {
        $this->Last_name = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->Last_name;
    }

    /**
     * Set fonction.
     *
     * @param string $fonction
     *
     * @return Employee
     */
    public function setFonction($fonction)
    {
        $this->Fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction.
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->Fonction;
    }




    /**
     * Set birthDate.
     *
     * @param \DateTime $birthDate
     *
     * @return Employee
     */
    public function setBirthDate($birthDate)
    {
        $this->Birth_date = $birthDate;

        return $this;
    }

    /**
     * Get birthDate.
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->Birth_date;
    }
}
