<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coaches;
use App\Area;
use App\CoachesArea;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Resources\CoachesResource;
use Illuminate\Http\Resources\Json\JsonResource;


class CoachesController extends Controller
{
    public function getCoaches(){
        // return new CoachesResource(Coaches::find(1));
        // return new CoachesResource(Coaches::get());
        return CoachesResource::collection(Coaches::all());
        // $data = Coaches::all();
        // $data = Coaches::find(1)->areas;
        // return [
        //     'data' => $data,
        //     'status' => 200,
        //     'statusText' => 'ok'
        // ];
    }
    public function getRelation(){
        // $data = CoachesArea::find(1);
        $data = Area::find(1)->coaches;
        return [
            'data' => $data,
            'status' => 200,
            'statusText' => 'ok'
        ];
    }
    public function saveCoaches(Request $request){
        // $input = $request->all();
        $first = $request->firstname;
        $last = $request->lastname;
        $desc = $request->description;
        $rate = $request->rate;
        $area = $request->areas;
        // $area = $input['areas'];
        // $str = json_encode($input['areas']);
        // var_dump($str);die();
        $inp = json_decode($area, true);
        $countRes = is_array($inp)?count($inp):0;
        
        
        // echo $countRes;die();
        $coachesObj = new Coaches;
        $coachesObj->firstname = $first;
        $coachesObj->lastname = $last;
        $coachesObj->description = $desc;
        $coachesObj->rate = $rate;
        $coachesObj->save();
        if($coachesObj && $countRes>0){
            foreach($inp as $key => $res){
                $areaObj = Area::where('area',$inp[$key])->first();
                if($areaObj){
                    $coachesAreaObj = new CoachesArea;
                    $coachesAreaObj->coaches_id = $coachesObj->id;
                    // $coachesAreaObj->coaches_id = 3;
                    $coachesAreaObj->area_id =  $areaObj->id;
                    $coachesAreaObj->save();
                }
            }
        }else{
            return[
                'message' => 'Not able to saved record',
                'success' => true,
                'status' => 401
            ];
        }
        if($coachesObj){
            // return CoachesResource::collection(Coaches::all());
            return[
                'txn' => $coachesAreaObj,
                'data'=> $coachesObj,
                'message' => 'Register successfully',
                'success' => true,
                'status' => 200
            ];
        }else{

        }
        
    }
    public function updateCoaches($id, Request $request){
        // $input = $request->all();
        $first = $request->firstname;
        $last = $request->lastname;
        $desc = $request->description;
        $rate = $request->rate;
        $coachesObj = Coaches::find($id);
        if($coachesObj){
            // $coachesObj->update($input);
            $coachesObj->firstname = $first;
            $coachesObj->lastname = $last;
            $coachesObj->description = $desc;
            $coachesObj->rate = $rate;
            $coachesObj->save();
            return[
                'data'=> $coachesObj,
                'message' => 'Updated successfully',
                'success' => true,
                'status' => 200
            ];
        }
        
    }
}
