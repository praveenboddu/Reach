<?php

namespace Buoy\BeaconEventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Validator\Constraints;
use JMS\Serializer\Annotation as JMS;

/**
 * BeaconEvent
 *
 * @ORM\Table(name="beacon_events")
 * @ORM\Entity(repositoryClass="BeaconEventBundle\Repository\BeaconEventRepository")
 */
class BeaconEvent
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
     * @var integer
     *
     * @ORM\Column(name="beacon_locale_id", type="integer")
     */
    private $beaconLocaleId;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Constraints\NotBlank
     */
    private $email;

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
     * Set beaconLocaleId
     *
     * @param string $beaconLocaleId
     * @return BeaconEvent
     */
    public function setBeaconLocaleId($beaconId)
    {
        $this->beaconLocaleId = $beaconLocaleId;

        return $this;
    }

    /**
     * Get beaconLocaleId
     *
     * @return string 
     */
    public function getBeaconLocaleId()
    {
        return $this->beaconLocaleId;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return BeaconEvent
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set clientId
     *
     * @param integer $clientId
     * @return BeaconEvent
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
        $data['beaconLocale'] = $this->getBeaconLocaleId();
        $data['email'] = $this->email();
        $data['created'] = $this->created();
        return $data;
    }
}
