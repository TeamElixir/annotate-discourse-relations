<?php

namespace App\Http\Controllers;

use App\Annotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnotationsController extends Controller
{
    public static function getAllAnnotations() {
        $all_annotations = Annotation::all();
        return $all_annotations;
    }

    public static function getAnnotationsOfuser($user_id) {
        $annotations = Annotation::where('user_id', '=', $user_id)->get();
        return $annotations;
    }

    public function createAnnotation(Request $request) {
        $user_id = $request->user_id;
        $pair_id = $request->pair_id;
        $annotation = $request->annotation;

        DB::table('annotations')->insert([
            'user_id' => $user_id,
            'pair_id' => $pair_id,
            'annotation' => $annotation
        ]);

        //new implementation
        process_cluster_mapping($user_id);
        save_record($pair_id, $user_id, $annotation);

        return "annotated";
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
    public static function update_U1_blank($user_id){
        //select Max(cluster_id) from <table>;
        //assign to following variable;
        $current_maximum_cluster_id = DB::select('select max(cluster_id) from table1');
        //insert into <table> values $cluster_id,$user_id,null;
        DB::update('update table1 set user1_id = ?, user1_completed = 1 where cluster_id = ?',[$user_id, $current_maximum_cluster_id]);
    }

    //complete cluster assignment
    public static function process_cluster_mapping($user_id){
        //to check whether all the user2 sections above are filled
        if(!update_U2_blank($user_id)){
            //if no blank user2 sections availble, create cluster_id and insert as user1
            update_U1_blank($user_id);
        }
    }

    public static function save_record($user_id, $pair_id, $relation_id){
        //insert into <relation-pair_id table> values $pair_id,$relation_id
        DB::insert('insert into table2 (pair_id, user_id, relation) values (?, ?, ?)',[$pair_id, $user_id, $relation_id]);
    }
}
