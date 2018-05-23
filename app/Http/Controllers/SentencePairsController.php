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
        $sentence_pair_ids = DB::select('select pair_id from ' . PairCluster::$table_name . ' where cluster_id = ? inner join table ' , [$relevant_cluster_id]);
        return $sentence_pair_ids;

    }



}
