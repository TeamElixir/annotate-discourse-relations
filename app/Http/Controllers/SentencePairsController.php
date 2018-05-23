<?php

namespace App\Http\Controllers;

use App\Relation;
use App\ClusterUsers;
use App\PairCluster;
use App\SentencePair;
use App\SentencePairForUser;
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

        $u2_blank_clusters = DB::select('select * from ' . ClusterUsers::$table_name . ' where user2_id = 0');
//        dd($u2_blank_clusters);

        foreach ($u2_blank_clusters as $cluster) {
            if ($cluster->user1_id != $user_id) {
                //update <table> where cluster_id = $cluster[0] set cluster_id = $cluster[0], user1_id=$cluster[1], user2_id=$user_id
                DB::update('update  ' . ClusterUsers::$table_name . ' set user2_id = ? where cluster_id = ?', [$user_id, $cluster->cluster_id]);
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
        $current_maximum_cluster_id = DB::select('select max(cluster_id) as md from ' . ClusterUsers::$table_name)[0];

        if ($current_maximum_cluster_id->md != null) {
            $new_cluster_id = intval($current_maximum_cluster_id->md) + 1;
        } else {
            $new_cluster_id = 1;
        }

        //insert into <table> values $cluster_id,$user_id,null;
        DB::insert('insert into ' . ClusterUsers::$table_name . ' (cluster_id, user1_id, user1_completed, user2_id, user2_completed) values (?, ?, ?, ?, ?)',
            [$new_cluster_id, $user_id, 0, 0, 0]);
        return $new_cluster_id;
    }

    //complete cluster assignment
    public static function getSentencePairsForUser($user_id)
    {
        $relevant_cluster_id = self::update_U2_blank($user_id);
        if ($relevant_cluster_id == -1) {
            $relevant_cluster_id = self::create_new_cluster_mapping($user_id);
        }

        //return sentence-pair ids only : change accordingly
        $sentence_pairs = DB::select('select pair_id, source_sntc_id, target_sntc_id, relation, cluster_id 
                                         from ' . SentencePair::$table_name . ' inner join ' . PairCluster::$table_name . ' 
                                         on pair_id=' . SentencePair::$table_name . '.id
                                         where cluster_id = ?'
            , [$relevant_cluster_id]);

        $objects = [];
        foreach ($sentence_pairs as $sentence_pair) {
            $sentence_pair_for_user = new SentencePairForUser();
            $sentence_pair_for_user->pair_id = $sentence_pair->pair_id;
            $sentence_pair_for_user->cluster_id = $sentence_pair->cluster_id;
            $sentence_pair_for_user->source_sntc_id = $sentence_pair->source_sntc_id;
            $sentence_pair_for_user->target_sntc_id = $sentence_pair->target_sntc_id;
            $sentence_pair_for_user->relation = $sentence_pair->relation;

            array_push($objects, $sentence_pair_for_user);
        }

        return $objects;
    }
}
