<?php

namespace Beacon\BeaconBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Validator\Constraints;
use JMS\Serializer\Annotation as JMS;

/**
 * Beacon
 *
 * @ORM\Table(name="beacons")
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
     * @ORM\Column(name="beacon_id", type="string", length=40)
     * @Constraints\NotBlank
     */
    private $beaconId;

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
     * Set beaconId
     *
     * @param string $beaconId
     * @return Beacon
     */
    public function setBeaconId($beaconId)
    {
        $this->beaconId = $beaconId;

        return $this;
    }

    /**
     * Get beaconId
     *
     * @return string 
     */
    public function getBeaconId()
    {
        return $this->beaconId;
    }

    /**
     * Set clientId
     *
     * @param integer $clientId
     * @return Beacon
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

    public function toArray()
    {
        $data = array();
        $data['id'] = $this->getId();
        $data['beaconId'] = $this->getBeaconId();
        $data['clientId'] = $this->getClientId();
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
        $data['beaconId'] = $this->getBeaconId();
        $data['clientId'] = $this->clientId();
        return $data;
    }
}
