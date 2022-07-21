<?php

namespace app\models;

class BinarySearch
{
    protected $low = 0;
    protected $mid;
    protected $high;
    protected $guess;
    protected $list;
    protected $log = [];
    protected $steps;
    public $item;

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }

    /**
     * @param array $list
     */
    public function setList(array $list)
    {
        $this->list = $list;
    }


    /**
     * @param string $item
     * @return integer|string
     */
    public function search(string $item = '')
    {
        if (empty($item) === false) $this->item = $item;

        $this->high = sizeof($this->list) - 1;

        while ($this->low <= $this->high) {
            $this->mid = floor(($this->low + $this->high) / 2);
            $this->guess = $this->list[$this->mid];
            if ($this->guess == $this->item) return $this->mid;
            if ($this->item > $this->guess) $this->low = $this->mid + 1;
            else $this->high = $this->mid - 1;

            $this->log[] = [
                'high' => $this->high,
                'low' => $this->low,
                'mid' => $this->mid,
                'guess' => $this->guess,
                'item' => $this->item,
            ];

            $this->steps += 1;
        }

        return 'None';
    }

    /**
     * @return array
     */
    public function getLog(): array
    {
        return $this->log;
    }

    /**
     * @return mixed
     */
    public function getSteps()
    {
        return $this->steps;
    }
}