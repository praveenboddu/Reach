<?php

namespace Buoy\LocaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Validator\Constraints;
use JMS\Serializer\Annotation as JMS;

/**
 * Locale
 *
 * @ORM\Table(name="addresses")
 * @ORM\Entity(repositoryClass="Doctrine\ORM\EntityRepository")
 */
class Address
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
     * @ORM\Column(name="name", type="string", length=60)
     * @Constraints\NotBlank
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address1", type="string", length=80)
     * @Constraints\NotBlank
     */
    private $address1;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="string", length=80)
     */
    private $address2;

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
     * @var integer
     *
     * @ORM\Column(name="zipcode", type="integer")
     * @Constraints\GreaterThan(value = 0)
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
     * @return Address
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
     * Set address1
     *
     * @param string $address1
     * @return Address
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string 
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return Address
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address2;
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

    public function toArray()
    {
        $data = array();
        $data['id'] = $this->getId();
        $data['name'] = $this->getName();
        $data['address1'] = $this->getAddress1();
        $data['address2'] = $this->getAddress2();
        $data['city'] = $this->getCity();
        $data['state'] = $this->getState();
        $data['country'] = $this->getCountry();
        $data['zipcode'] = $this->getZipcode();
        $data['latitude'] = $this->getLatitude();
        $data['longitude'] = $this->getLongitude();
        $data['created'] = $this->getCreated()->format('Y-m-d H:i:s');
        return $data;
    }
}
