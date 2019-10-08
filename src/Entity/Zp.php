<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ZpRepository")
 */
class Zp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer",name="sum")
     */
    private $sum;

    /**
     * @ORM\GeneratedValue()
     * @ORM\Column(type="datetime",name="data_pay", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $dataPay;

    /**
     * @ORM\GeneratedValue()
     * @ORM\Column(type="string",name="note")
     */
    private $note = '';

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id*100;
    }

    /**
     * @return mixed
     */
    public function getSum()
    {
        return $this->sum/100;
    }

    /**
     * @param mixed $sum
     */
    public function setSum($sum): void
    {
        $this->sum = $sum;
    }

    /**
     * @return mixed
     */
    public function getDataPay()
    {
        return $this->dataPay;
    }

    /**
     * @param mixed $dataPay
     */
    public function setDataPay($dataPay): void
    {
        $this->dataPay = $dataPay;
    }

    /**
     * @return mixed
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note): void
    {
        $this->note = $note;
    }


}
