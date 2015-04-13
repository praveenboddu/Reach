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
 * @ORM\Entity(repositoryClass="Buoy\LocaleBundle\Repository\LocaleRepository")
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
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer")
     * @Constraints\GreaterThan(value = 0)
     * @Constraints\Type(type="integer", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $clientId;

    /**
     * @var string
     *
     * @ORM\Column(name="street_number", type="string", length=80)
     * @Constraints\NotBlank
     */
    private $streetNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="street_name", type="string", length=200)
     */
    private $streetName;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=40)
     * @Constraints\NotBlank
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=40)
     * @Constraints\NotBlank
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=80)
     * @Constraints\NotBlank
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=10)
     * @Constraints\NotBlank
     */
    private $zipcode;

    /**
     * @var integer
     *
     * @ORM\Column(name="lat", type="float", precision=10, scale=6)
     * @Constraints\GreaterThan(value = 0)
     */
    private $latitude;

    /**
     * @var integer
     *
     * @ORM\Column(name="lng", type="float", precision=10, scale=6)
     * @Constraints\GreaterThan(value = 0)
     */
    private $longitude;

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
        $this->updated = new DateTime;
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

    /**
     * Set streetNumber
     *
     * @param string $streetNumber
     * @return Address
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * Get streetNumber
     *
     * @return string 
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Set streetName
     *
     * @param string $streetName
     * @return Address
     */
    public function setStreetName($streetName)
    {
        $this->streetName = $streetName;

        return $this;
    }

    /**
     * Get streetName
     *
     * @return string 
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Address
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return Address
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return integer 
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Address
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Address
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    public function toArray()
    {
        $data = array();
        $data['id'] = $this->getId();
        $data['name'] = $this->getName();
        $data['clientId'] = $this->getClientId();
        $data['created'] = $this->getCreated()->format('Y-m-d H:i:s');
        $data['updated'] = $this->getUpdated()->format('Y-m-d H:i:s');
        $data['isActive'] = $this->getIsActive();
        $data['city'] = $this->getCity();
        $data['state'] = $this->getState();
        $data['country'] = $this->getCountry();
        $data['zipcode'] = $this->getZipcode();
        $data['latitude'] = $this->getLatitude();
        $data['longitude'] = $this->getLongitude();

        return $data;
    }
}
