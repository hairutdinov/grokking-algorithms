<?php

namespace app\controllers;

use yii\base\Controller;

class RecursionController extends Controller
{
    public function actionSum()
    {
        return $this->recursiveSum([2,4,6,8]);
    }

    public function actionCount()
    {
        return $this->recursiveCount([1,2,12,33]);
    }

    public function actionMax()
    {
        return $this->recursiveMax2([2,3,1,4,50,11,0,10]);
        return $this->recursiveMax([2,3,1,4,5,11,0,10]);
    }

    public function recursiveSum(array $array): int
    {
        if (empty($array)) return 0;
        if (sizeof($array) === 1) return $array[0];
        return $array[0] + $this->recursiveSum(array_slice($array, 1));
    }

    public function recursiveCount(array $array): int
    {
        if (empty($array)) return 0;
        return 1 + $this->recursiveCount(array_slice($array, 1));
    }

    public function recursiveMax(array $array): int
    {
        if (empty($array)) return 0;
        if (sizeof($array) === 1) return $array[0];
        $max = $this->recursiveMax(array_slice($array, 1));
        return $array[0] > $max ? $array[0] : $max;
    }

    public function recursiveMax2(array $array): int
    {
        if (empty($array)) return 0;
        if (sizeof($array) === 2) return $array[0] > $array[1] ? $array[0] : $array[1];
        $sub_max = $this->recursiveMax(array_slice($array, 1));
        return $array[0] > $sub_max ? $array[0] : $sub_max;
    }
}