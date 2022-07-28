<?php

namespace app\controllers;

use app\models\BinarySearch;
use app\models\EuclideanAlgorithm;
use app\models\QuickSort;
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

    public function actionQuickSort()
    {
        $quick_sort = new QuickSort();
        $quick_sort->setList([4,1,22,3,10,2]);

        return json_encode([
            'array' => $quick_sort->getList(),
            'sorted' => $quick_sort->sort(),
        ]);
    }

    public function actionBreadthFirstSearch()
    {
        $graph = [];
        $graph['you'] = ['alice', 'bob', 'claire'];
        $graph['alice'] = ['peggy'];
        $graph['bob'] = ['anuj', 'peggy'];
        $graph['claire'] = ['thom', 'johnny'];
        $graph['peggy'] = [];
        $graph['anuj'] = [];
        $graph['thom'] = [];
        $graph['johnny'] = [];

        $search_queue = new \Ds\Deque(...[$graph['you']]);
        $searched = [];

        while (!$search_queue->isEmpty()) {
            $user = $search_queue->shift();

            if ($user === 'thom') return "Mango seller found: $user";
            $searched[] = $user;
            $search_queue->push(...array_filter($graph[$user], function ($name) use ($searched) { return !in_array($name, $searched); }));
            $searched = array_merge($searched, array_filter($graph[$user], function ($name) use ($searched) { return !in_array($name, $searched); }));
        }

        return "Mango seller not found";
    }
}