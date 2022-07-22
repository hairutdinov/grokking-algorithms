<?php

namespace app\controllers;

use app\models\BinarySearch;
use app\models\EuclideanAlgorithm;
use app\models\SelectionSort;
use yii\base\Controller;

class AlgorithmController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionBinarySearch()
    {
        $binary_search = new BinarySearch();
        $binary_search->setList(range(100, 1000, 3));
        $binary_search->item = 712;
        echo sprintf('Index: %s<br>', $binary_search->search());
        echo sprintf('Steps: %s', $binary_search->getSteps());
        die;
    }

    public function actionSelectionSort()
    {
        $selection_sort = new SelectionSort();
        $selection_sort->setList([3,1,4,6,10,8,2]);
        echo sprintf('Array: <pre>%s</pre><br>', json_encode($selection_sort->getList(), JSON_PRETTY_PRINT));
        echo sprintf('Sorted: <pre>%s</pre><br>', json_encode($selection_sort->sort(), JSON_PRETTY_PRINT));
        die;
    }

    public function actionEuclideanAlgorithm()
    {
        $euclidean_algorithm = new EuclideanAlgorithm();
        $euclidean_algorithm->setNumbers(1071, 462);
        echo sprintf('GCD (greatest common divisor): %s<br>', $euclidean_algorithm->getGcd());
        die;
    }
}