<?php

namespace app\models;

class QuickSort
{
    public array $list = [];

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
    public function setList(array $list): void
    {
        $this->list = $list;
    }

    public function sort(): array
    {
        return $this->qSort($this->getList());
    }

    protected function qSort(array $array): array
    {
        if (count($array) < 2) return $array;
        $rand_index = rand(1, (sizeof($array)-1));
        $opornyi_element = $array[$rand_index];
        $less = []; $greater = [];

        foreach ($array as $index => $item) {
            if ($index === $rand_index) continue;
            if ($item < $opornyi_element) $less[] = $item;
            else $greater[] = $item;
        }

        return array_merge($this->qSort($less), [$opornyi_element], $this->qSort($greater));
    }
}