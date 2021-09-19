<?php


namespace App\Entity;
use phpDocumentor\Reflection\Type;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class EvenementSearch
{



    /**
     * @var Type = 'datetime'
     */

    private $date;

    /**
     * @var Type = 'String'
     */

    private $city;

    /**
     * @var Type = 'String'
     */
    private $contry;

    /**
     * @var Type = 'String'
     */

    private $type;

    /**
     * @return datetime| mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return datetime|EvenementSearch
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string|mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     * @return string|EvenementSearch
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string\mixed
     */
    public function getContry()
    {
        return $this->contry;
    }

    /**
     * @param mixed $contry
     * @return string\EvenementSearch
     */
    public function setContry($contry)
    {
        $this->contry = $contry;
        return $this;
    }

    /**
     * @return string\mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return strimEvenementSearch
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }


    public function __toString(){
        // to show the name of the Category in the select
        return $this->city;
        return $this->contry;
        return $this->type;
        return $this->date;
        // to show the id of the Category in the select
        // return $this->id;
    }

        }