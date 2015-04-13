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
