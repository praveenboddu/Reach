<?php

namespace BeaconBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Validator\Constraints;
use JMS\Serializer\Annotation as JMS;

/**
 * Locale
 *
 * @ORM\Table(name="locales")
 * @ORM\Entity(repositoryClass="Doctrine\ORM\EntityRepository")
 */
class Beacon
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
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     * @Constraints\NotBlank
     */
    private $location;

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
        $this->location = $location;

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
     * Set location
     *
     * @param string $location
     * @return Locale
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
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
