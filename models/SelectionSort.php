<?php

namespace app\models;

/**
 * @property array $list
 * @property array $sorted_list
 */
class SelectionSort
{
    protected $list;
    protected $sorted_list;

    /**
     * @return array
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param array $list
     */
    public function setList(array $list): void
    {
        $this->list = $list;
    }

    public function sort(): array
    {
        foreach ($this->getList() as $item) {
            $this->sorted_list[] = array_splice($this->list, $this->findSmallestIndex(), 1)[0];
        }

        return $this->sorted_list;
    }

    protected function findSmallestIndex()
    {
        $smallest = $this->list[0];
        $smallestIndex = 0;

        foreach ($this->getList() as $index => $item) {
            if ($item < $smallest) {
                $smallest = $item;
                $smallestIndex = $index;
            }
        }

        return $smallestIndex;
    }
}