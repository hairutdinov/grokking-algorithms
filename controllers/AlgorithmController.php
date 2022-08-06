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
            if (in_array($user, $searched)) continue;
            if ($user === 'thom') return "Mango seller found: $user";
            $searched[] = $user;
            $search_queue->push(...$graph[$user]);
            $searched[] = $user;
        }

        return "Mango seller not found";
    }

    public function actionDijkstrasAlgorithm()
    {
        $graph = [];
        $graph['start']['a'] = 6;
        $graph['start']['b'] = 2;
        $graph['a']['finish'] = 1;
        $graph['b']['a'] = 3;
        $graph['b']['finish'] = 5;
        $graph['finish'] = [];

        $infinity = INF;

        $costs = [];
        $costs['a'] = 6;
        $costs['b'] = 2;
        $costs['finish'] = $infinity;

        $parents = [];
        $parents['a'] = 'start';
        $parents['b'] = 'start';
        $parents['finish'] = null;

        $processed = [];

        $node = $this->find_lowest_cost_mode($costs, $processed);

        while (!is_null($node)) { // while node not null
            $cost = $costs[$node];
            $neighbors = $graph[$node];

            foreach (array_keys($neighbors) as $n) {
                $new_cost = $cost + $neighbors[$n];

                if ($costs[$n] > $new_cost) {
                    $costs[$n] = $new_cost;
                    $parents[$n] = $node;
                }
            }

            $processed[] = $node;
            $node = $this->find_lowest_cost_mode($costs, $processed);
        }

        echo sprintf('<pre>%s</pre><br>', json_encode($costs, JSON_PRETTY_PRINT));die;
    }


    /**
     * @param array $costs
     * @param array $processed
     * @return string|null
     */
    public function find_lowest_cost_mode(array $costs, array $processed)
    {
        $infinity = INF;
        $lowest_cost = $infinity;
        $lowest_cost_node = null;

        foreach ($costs as $node => $cost) {
            if ($cost < $lowest_cost && !in_array($node, $processed)) {
                $lowest_cost = $cost;
                $lowest_cost_node = $node;
            }
        }

        return $lowest_cost_node;
    }

    public function actionSetCoveringProblem()
    {
        $states_needed = array_unique(['mt', 'wa', 'or', 'id', 'nv', 'ut', 'ca', 'az']); // типо множества

        $stations = [];
        $stations['kone'] = array_unique(['id', 'nv', 'ut']);
        $stations['ktwo'] = array_unique(['wa', 'id', 'mt']);
        $stations['kthree'] = array_unique(['or', 'nv', 'ca']);
        $stations['kfour'] = array_unique(['nv', 'ut']);
        $stations['kfive'] = array_unique(['ca', 'az']);

        $final_stations = []; // итоговый набор станций

        while ($states_needed) {
            $best_station = null;
            $states_covered = []; // все штаты, обслуживаемые станцией, которые не входят в покрытие

            foreach ($stations as $station => $states_for_station) {
                $covered = array_intersect($states_needed, $states_for_station);
                if (sizeof($covered) > sizeof($states_covered)) {
                    $best_station = $station;
                    $states_covered = $covered;
                }
            }

            $final_stations[] = $best_station;
            $states_needed = array_diff($states_needed, $states_covered);
        }
    }
}