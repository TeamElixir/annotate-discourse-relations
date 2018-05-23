<?php

namespace App\Http\Controllers;

use App\Relation;
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

    public static function getSentencePairsForUser($user_id){
        
    }

    //to find if there is any cluster which is annotate just once
    public static function update_U2_blank($user_id){
        //sql query : select cluster_id, user1_id from <table> where user2_id = null;
        //the results are stored in following array (so it would be array of arrays;

        $u2_blank_clusters = DB::select('select * from table1 where user2_id = null');
        
        foreach($u2_blank_clusters as $cluster){
            if($cluster->user1_id != $user_id){
                //update <table> where cluster_id = $cluster[0] set cluster_id = $cluster[0], user1_id=$cluster[1], user2_id=$user_id
                DB::update('update  table1 set user2_id = ?, user2_completed = 1 where cluster_id = ?',['$user_id',$cluster->cluster_id]);
                return true;
            }
        }
        return false;

    }

    //to create newcluster_id and assign user1 
    public static function create_new_cluster_mapping($user_id){
        //select Max(cluster_id) from <table>;
        //assign to following variable;
        $current_maximum_cluster_id = DB::select('select max(cluster_id) from table1');
        $new_cluster_id = intval($current_maximum_cluster_id[0]) + 1;
        //insert into <table> values $cluster_id,$user_id,null;
        DB::insert('insert into table1 (cluster_id, user1_id, user1_completed, user2_id, user2_completed) values (?, ?, ?, ?, ?)',[$cluster_id, $user_id, 0, null, null]);
    }

    //complete cluster assignment
    public static function process_cluster_mapping($user_id){
        //to check whether all the user2 sections above are filled
        if(!update_U2_blank($user_id)){
            //if no blank user2 sections availble, create cluster_id and insert as user1
            create_new_cluster_mapping($user_id);
        }
    }
}
