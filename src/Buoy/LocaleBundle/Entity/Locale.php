<?php

namespace Buoy\LocaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Validator\Constraints;
use JMS\Serializer\Annotation as JMS;
use Buoy\LocaleBundle\Entity\Address;

/**
 * Locale
 *
 * @ORM\Table(name="locales")
 * @ORM\Entity(repositoryClass="Doctrine\ORM\EntityRepository")
 */
class Locale
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     * @Constraints\NotBlank
     */
    private $name;

    /**
     * @var Address
     *
     * @ORM\ManyToOne(targetEntity="Buoy\LocaleBundle\Entity\Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer")
     * @Constraints\GreaterThan(value = 0)
     * @Constraints\Type(type="integer", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $clientId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     * @Constraints\NotBlank
     * @COnstraints\DateTime()
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     * @Constraints\NotBlank
     * @COnstraints\DateTime()
     */
    private $updated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->created = new DateTime;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Locale
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Locale
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return Address 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set clientId
     *
     * @param integer $clientId
     * @return Locale
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId
     *
     * @return integer 
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @return \DateTime 
     */
    public function setUpdated()
    {
        $this->updated = new DateTime;

        return $this->updated;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set isActive
     *
     * @param string $isActive
     * @return Locale
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return string 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    public function toArray()
    {
        $data = array();
        $data['id'] = $this->getId();
        $data['name'] = $this->getName();
        //$data['address'] = $this->getAddress();
        $data['clientId'] = $this->getClientId();
        $data['created'] = $this->getCreated()->format('Y-m-d H:i:s');
        $data['updated'] = $this->getUpdated()->format('Y-m-d H:i:s');
        $data['isActive'] = $this->getIsActive();
        return $data;
    }

    /**
    * Defines custom serialization
    * @JMS\HandlerCallback("json", direction = "serialization")
    * @return array
    */
    public function serializeToJSON()
    {
        $data = array();
        $data['id'] = $this->getId();
        $data['name'] = $this->getName();
        $data['location'] = $this->getLocation();
        $data['clientId'] = $this->clientId();
        $data['created'] = $this->created();
        return $data;
    }
}
