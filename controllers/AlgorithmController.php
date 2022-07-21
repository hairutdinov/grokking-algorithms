<?php

namespace app\controllers;

use app\models\BinarySearch;
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
}