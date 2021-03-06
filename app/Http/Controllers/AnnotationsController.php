<?php

namespace App\Http\Controllers;

use App\Annotation;
use App\ClusterUsers;
use App\PairUserAnnotation;
use Couchbase\Cluster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnotationsController extends Controller
{
    public static function getAllAnnotations()
    {
        $all_annotations = Annotation::all();
        return $all_annotations;
    }

    public static function getAnnotationsOfuser($user_id)
    {
        $annotations = Annotation::where('user_id', '=', $user_id)->get();
        return $annotations;
    }

    public static function createAnnotation($user_id, $pair_id, $annotation)
    {
        //new implementation

        self::save_record($pair_id, $user_id, $annotation);

        return "annotated";
    }

    //to find if there is any cluster which is annotate just once
    public static function update_U2_blank($user_id)
    {
        //sql query : select cluster_id, user1_id from <table> where user2_id = null;
        //the results are stored in following array (so it would be array of arrays;

        $u2_blank_clusters = DB::select('select * from ' . ClusterUsers::$table_name . ' where user2_completed = 0 and user2_id=?', [$user_id]);

        foreach ($u2_blank_clusters as $cluster) {
            if ($cluster->user2_id == $user_id) {
                //update <table> where cluster_id = $cluster[0] set cluster_id = $cluster[0], user1_id=$cluster[1], user2_id=$user_id
                DB::update('update  ' . ClusterUsers::$table_name . ' set user2_id = ?, user2_completed = 1 where cluster_id = ?',
                    [$user_id, $cluster->cluster_id]);
                return true;
            }
        }
        return false;

    }

    //to create newcluster_id and assign user1
    public static function update_U1_blank($user_id)
    {
        //select Max(cluster_id) from <table>;
        //assign to following variable;
        $current_maximum_cluster_id = DB::select('select max(cluster_id) as md from ' . ClusterUsers::$table_name . ' where user1_id = ? and user1_completed=0', [$user_id]);
        //insert into <table> values $cluster_id,$user_id,null;
        DB::update('update ' . ClusterUsers::$table_name . ' set user1_id = ?, user1_completed = 1 where cluster_id = ?',
            [$user_id, $current_maximum_cluster_id[0]->md]);
    }

    //complete cluster assignment
    public static function process_cluster_mapping($user_id)
    {
        //to check whether all the user2 sections above are filled
        if (!self::update_U2_blank($user_id)) {
            //if no blank user2 sections availble, create cluster_id and insert as user1
            self::update_U1_blank($user_id);
        }
    }

    public static function save_record($pair_id, $user_id, $relation_id)
    {
        //insert into <relation-pair_id table> values $pair_id,$relation_id
        DB::insert('insert into ' . PairUserAnnotation::$table_name . ' (pair_id, user_id, relation) values (?, ?, ?)', [$pair_id, $user_id, $relation_id]);
    }
}
