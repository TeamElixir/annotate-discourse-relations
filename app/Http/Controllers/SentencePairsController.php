<?php

namespace App\Http\Controllers;

use App\Relation;
use App\ClusterUsers;
use App\PairCluster;
use App\SentencePair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class SentencePairsController extends Controller
{
    public static function getAllSentencePairs()
    {
        $all_sentence_pairs = SentencePair::paginate(5);

        return $all_sentence_pairs;
    }

    //to find if there is any cluster which is annotate just once
    public static function update_U2_blank($user_id)
    {
        //sql query : select cluster_id, user1_id from <table> where user2_id = null;
        //the results are stored in following array (so it would be array of arrays;

        $u2_blank_clusters = DB::select('select * from ' . ClusterUsers::$table_name . ' where user2_id = null');

        foreach ($u2_blank_clusters as $cluster) {
            if ($cluster->user1_id != $user_id) {
                //update <table> where cluster_id = $cluster[0] set cluster_id = $cluster[0], user1_id=$cluster[1], user2_id=$user_id
                DB::update('update  ' . ClusterUsers::$table_name . ' set user2_id = ? where cluster_id = ?', ['$user_id', $cluster->cluster_id]);
                return $cluster->cluster_id;
            }
        }
        return -1;

    }

    //to create newcluster_id and assign user1 
    public static function create_new_cluster_mapping($user_id)
    {
        //select Max(cluster_id) from <table>;
        //assign to following variable;
        $current_maximum_cluster_id = DB::select('select max(cluster_id) from ' . ClusterUsers::$table_name . '');

        if ($current_maximum_cluster_id[0] != null) {
            $new_cluster_id = intval($current_maximum_cluster_id[0]) + 1;
        } else {
            $new_cluster_id = 1;
        }

        //insert into <table> values $cluster_id,$user_id,null;
        DB::insert('insert into ' . ClusterUsers::$table_name . ' (cluster_id, user1_id, user1_completed, user2_id, user2_completed) values (?, ?, ?, ?, ?)', [$cluster_id, $user_id, 0, null, 0]);
        return $new_cluster_id;
    }

    //complete cluster assignment
    public static function getSentencePairsForUser($user_id)
    {
        $relevant_cluster_id = update_U2_blank($user_id);
        if ($relevant_cluster_id == -1) {
            $relevant_cluster_id = create_new_cluster_mapping($user_id);
        }

        //return sentence-pair ids only : change accordingly
        $sentence_pair_ids = DB::select('select pair_id from ' . PairCluster::$table_name . ' where cluster_id = ?', [$relevant_cluster_id]);
        return $sentence_pair_ids;

    }

    //to shuffle ; and add records to table 3
    public static function shuffleAndCluster()
    {

        $sentence_pair_array = array();

        for ($i = 0; $i <= 18; $i++) {
            $pair_count = DB::select('select count(*) as pair_count from <<tablename>> where <<relation>> = ?', [$i]);

            $selected_pairs_count = min($pair_count->pair_count, 100);

            if ($selected_pairs_count != 0) {
                $pairs_for_relation_i = DB::select('select pair_id from <<table>> where relation_id = ? limit ?', [$i, $selected_pairs_count]);

                foreach ($pairs_for_relation_i as $pair) {
                    array_push($sentence_pair_array, $pair->pair_id);
                }
            }
            //pair pool is completed; next -> shuffle
            $pair_pool_size = sizeof($sentence_pair_array);

            //shuffle
            for ($j = 0; $j < 10000; $j++) {
                array_swap_assoc(mt_rand(0, $pair_pool_size), mt_rand(0, $pair_pool_size), $sentence_pair_array);
            }

            //update the table pair_id - cluster_id
            $cluster_count = 0;
            foreach ($sentence_pair_array as $pair) {
                for ($k = 0; $k < 5; $k++) {
                    DB::update('update ' . PairCluster::$table_name . ' (pair_id, cluster_id) values (?, ?)', [$pair, $cluster_count]);
                }
                $cluster_count++;
            }


        }
    }

    //swap two elements in array 
    public static function array_swap_assoc($key1, $key2, $array)
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
