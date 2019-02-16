<?php

/**
 * Class TeamCalc
 * @author Nikolaev Aleksei
 */

class TeamCalc{

    /**
     * @var array - Количество возможных забитых мячей
     */
    private static $defaultScores = [0, 1, 2, 3, 4, 5];


    /**
     * Метод расчета среднего значения забитых и пропущеных голов всех команд
     *
     * @param array $teams Массив команд со статистикой
     *
     * @return array scored - забиыте, skiped - пропущенные
     * @throws Exception
     */

    public static function getAverageGoals(array $teams)
    {

        $goals = [
            'scored' => 0,
            'skiped' => 0
        ];
        $games = 0;
        if(count($teams) > 0){
            foreach ($teams as $team) {
                $goals['scored'] += $team['goals']['scored'];
                $goals['skiped'] += $team['goals']['skiped'];
                $games += $team['games'];
            }

            if ($games > 0) {
                $goals['scored'] = $goals['scored'] / $games;
                $goals['skiped'] = $goals['skiped'] / $games;
            }
        }
        else{
            throw new Exception('Пустой массив игр');
        }

        return $goals;

    }

    /**
     * Метод выбора случайного значения из массива self::$defaultScores в зависимости от веса $weight
     *
     * @param array $weights
     *
     * @return int
     */

    public static function customRandom(array $weights)
    {
        $total = array_sum($weights);
        $n = 0;
        $num = mt_rand(0, $total);

        foreach (self::$defaultScores as $i => $value) {
            $n += $weights[$i];

            if ($n >= $num) {
                return self::$defaultScores[$i];
            }
        }
    }

    /**
     * Функция распределения Пуассона
     *
     * @param float $fi
     * @param int   $x
     *
     * @return float
     */

    public static function golaso($fi, $x)
    {

        $e = exp(-$fi);

        return ($e) * (pow($fi, $x)) / self::factorial($x);
    }


    /**
     * Метод вычисление факториала
     *
     * @param int $n
     *
     * @return int
     */

    public static function factorial($n)
    {
        if ($n < 0) return 0;
        if ($n == 0) return 1;

        return $n * self::factorial($n - 1);
    }

}