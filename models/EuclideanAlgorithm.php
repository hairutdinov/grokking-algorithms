<?php

namespace app\models;

/**
 * @property integer $first_number
 * @property integer $second_number
 * @property integer $gcd
 */
class EuclideanAlgorithm
{
    protected $first_number;
    protected $second_number;

    /**
     * @return mixed
     */
    public function getFirstNumber(): int
    {
        return $this->first_number;
    }

    /**
     * @param mixed $first_number
     */
    public function setFirstNumber(int $first_number): void
    {
        $this->first_number = $first_number;
    }

    /**
     * @return mixed
     */
    public function getSecondNumber(): int
    {
        return $this->second_number;
    }

    /**
     * @param mixed $second_number
     */
    public function setSecondNumber(int $second_number): void
    {
        $this->second_number = $second_number;
    }

    public function setNumbers(int $first, int $second)
    {
        $this->setFirstNumber($first);
        $this->setSecondNumber($second);
    }

    /**
     * @return int
     */
    public function getGcd(): int
    {
        $first = $this->getFirstNumber();
        $second = $this->getSecondNumber();

        while ($first !== $second) {
            if ($first > $second) {
                $first = $first - $second;
            } else {
                $second = $second - $first;
            }
        }

        return $first;
    }

}