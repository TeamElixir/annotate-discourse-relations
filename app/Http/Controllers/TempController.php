<?php

namespace App\Http\Controllers;

use App\PairCluster;
use App\SentencePair;
use Illuminate\Http\Request;
use DB;

class TempController extends Controller
{
    //to shuffle ; and add records to table 3
    public static function shuffleAndCluster()
    {
//        test();
//        dd();

        $sentence_pair_array = array();

        for ($i = 0; $i <= 18; $i++) {
//            $pair_count = DB::select('select count(*) as pair_count from ' . SentencePair::$table_name . ' where relation = ?', [$i]);
//
//            $selected_pairs_count = min($pair_count->pair_count, 100);

//            if ($selected_pairs_count != 0) {
            $pairs_for_relation_i = DB::select('select id from ' . SentencePair::$table_name . ' where relation = ? limit 100', [$i]);

            foreach ($pairs_for_relation_i as $pair) {
                array_push($sentence_pair_array, $pair->id);
            }
        }
//            }
        //pair pool is completed; next -> shuffle
        $pair_pool_size = sizeof($sentence_pair_array);

        //shuffle
        for ($j = 0; $j < 1000; $j++) {
            $sentence_pair_array = self::array_swap_assoc(mt_rand(0, $pair_pool_size - 1), mt_rand(0, $pair_pool_size - 1), $sentence_pair_array);
        }

        //update the table pair_id - cluster_id
        $cluster_count = 0;
        $k = 0;

        foreach ($sentence_pair_array as $pair) {
            DB::insert('insert into ' . PairCluster::$table_name . ' (pair_id, cluster_id) values (?, ?)', [$pair, $cluster_count]);
            $k++;

            if ($k == 5) {
                $k = 0;
                $cluster_count++;
            }
        }
    }


    public function test()
    {

    }

//swap two elements in array
    public
    static function array_swap_assoc($key1, $key2, $array)
    {
        $newArray = array();
        foreach ($array as $key => $value) {
            if ($key == $key1) {
                $newArray[$key2] = $array[$key2];
            } elseif ($key == $key2) {
                $newArray[$key1] = $array[$key1];
            } else {
                $newArray[$key] = $value;
            }
        }
        return $newArray;
    }
}
