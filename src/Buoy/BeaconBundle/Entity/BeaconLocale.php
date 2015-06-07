<?php

namespace Buoy\BeaconBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Validator\Constraints;
use JMS\Serializer\Annotation as JMS;

use Buoy\LocaleBundle\Entity\Locale;
use Buoy\BeaconBundle\Entity\Beacon;

/**
 * BeaconLocales
 *
 * @ORM\Table(name="beacon_locales")
 * @ORM\Entity(repositoryClass="Buoy\BeaconBundle\Repository\BeaconLocaleRepository")
 */
class BeaconLocale
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
     * @var Beacon
     *
     * @ORM\ManyToOne(targetEntity="Buoy\BeaconBundle\Entity\Beacon")
     * @ORM\JoinColumn(name="beacon_id", referencedColumnName="id")
     */
    private $beacon;

    /**
     * @var Locale
     *
     * @ORM\ManyToOne(targetEntity="Buoy\BeaconBundle\Entity\Locale")
     * @ORM\JoinColumn(name="locale_id", referencedColumnName="id")
     */
    private $locale;

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
     * @Constraints\DateTime()
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="active_from", type="datetime")
     * @Constraints\NotBlank
     * @Constraints\DateTime()
     */
    private $activeFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="active_until", type="datetime")
     * @Constraints\DateTime()
     */
    private $activeUntil;

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
     * Set beacon
     *
     * @param Beacon $beacon
     * @return BeaconLocale
     */
    public function setBeacon(Beacon $beacon)
    {
        $this->beacon = $beacon;

        return $this;
    }

    /**
     * Get beacon
     *
     * @return Beacon 
     */
    public function getBeacon()
    {
        return $this->beacon;
    }

    /**
     * Set Locale
     *
     * @param Locale $locale
     * @return BeaconLocale
     */
    public function setLocale(Locale $locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return Locale 
     */
    public function getLocale()
    {
        return $this->locale;
    }   

    /**
     * Set clientId
     *
     * @param integer $clientId
     * @return locale
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
     * set activeFrom
     *
     * @return BeaconLocale 
     */
    public function setActiveFrom($activeFrom)
    {
        $this->activeFrom = $activeFrom;
    }

    /**
     * Get activeFrom
     *
     * @return \DateTime 
     */
    public function getActiveFrom()
    {
        return $this->activeFrom;
    }

    /**
     * set activeUntil
     *
     * @return BeaconLocale 
     */
    public function setActiveUntil($activeUntil)
    {
        $this->activeUntil = $activeUntil;
    }

    /**
     * Get activeUntil
     *
     * @return \DateTime 
     */
    public function getActiveUntil()
    {
        return $this->activeUntil;
    }
}
