<?php

namespace App\Http\Controllers\Api;

use App\Models\Vote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoteController extends Controller
{
    public function store(Request $request){
        
        if(!$this->addressMacAlreadyExistInDatabase($request->macadress)){
            $newVote = new Vote();
            $newVote->macadress_votant = $request->macadress;
            $newVote->candidat_choisi = $request->candidat;
            $newVote->age_votant = $request->age;
            $newVote->lieu_residence_votant = $request->residence;
            $newVote->save();
            return response()->json(["code"=>200,"message"=>"Nouveau vote enregistré"],200);
        }else{
            return response()->json(["code"=>400,"message"=>"Cette personne a déja voté"],400);
        }
       
    }

    public function addressMacAlreadyExistInDatabase($macAddress){
        $count = Vote::where("macadress_votant",$macAddress)->count();
        if($count>0){
            return true;
        }
        return false;
    }
}
