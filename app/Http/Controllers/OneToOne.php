<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vote;

class OneToOne extends Controller
{
    public function get_user_vote(){ 
        // $user = User::find(1);
        /* 
        {
            "id": 1,
            "name": "Bryon Buckridge",
            "email": "nswaniawski@example.com",
            "email_verified_at": "2025-01-12T13:52:31.000000Z",
            "created_at": "2025-01-12T13:52:38.000000Z",
            "updated_at": "2025-01-12T13:52:38.000000Z"
        }
         */
        $user = User::with('vote')->find(1); 
        /* {
            "id": 1,
            "name": "Bryon Buckridge",
            "email": "nswaniawski@example.com",
            "email_verified_at": "2025-01-12T13:52:31.000000Z",
            "created_at": "2025-01-12T13:52:38.000000Z",
            "updated_at": "2025-01-12T13:52:38.000000Z",
            "vote": {
                "id": 1,
                "user_id": 1,
                "vote_name": "consequatur",
                "created_at": "2025-01-12T13:52:38.000000Z",
                "updated_at": "2025-01-12T13:52:38.000000Z"
            }
            } */
        $vote = $user->vote; // or $user->vote()->get();
        /* {
        "id": 1,
        "user_id": 1,
        "vote_name": "consequatur",
        "created_at": "2025-01-12T13:52:38.000000Z",
        "updated_at": "2025-01-12T13:52:38.000000Z"
        } */
        return $vote;
    }

    public function get_vote_user(){ 
        $user = User::find(1);
        /* {"id":1,"name":"Bryon Buckridge","email":"nswaniawski@example.com","email_verified_at":"2025-01-12T13:52:31.000000Z","created_at":"2025-01-12T13:52:38.000000Z","updated_at":"2025-01-12T13:52:38.000000Z"} */
        // $vote = $user->vote; // best use for one to one relation
        /* {"id":1,"user_id":1,"vote_name":"This is bio","created_at":"2025-01-12T13:52:38.000000Z","updated_at":"2025-01-13T18:37:30.000000Z"} */
        // $vote = $user->vote()->get(); //it gives multi reocords to votes
        /* [{"id":1,"user_id":1,"vote_name":"This is bio","created_at":"2025-01-12T13:52:38.000000Z","updated_at":"2025-01-13T18:37:30.000000Z"},{"id":201,"user_id":1,"vote_name":"This is bio","created_at":"2025-01-13T18:32:34.000000Z","updated_at":"2025-01-13T18:37:30.000000Z"}] */
        // (OR)
        // $vote = Vote::where('user_id',1)->get();
        /* [{"id":1,"user_id":1,"vote_name":"consequatur","created_at":"2025-01-12T13:52:38.000000Z","updated_at":"2025-01-12T13:52:38.000000Z"}] */
        
        // get/select particular column (not $vote = $user->vote()->vote_name); 
        $vote = $user->vote->vote_name; 
        return $vote;
    }

    public function create_vote(){ 
        $user = User::find(1);
        $user->vote()->create([
            'vote_name' => rand(111111,9999999)
        ]);
    }

    public function update_vote(){ 
        $user = User::find(1);
        $user->vote()->update([
            'vote_name' => 'This is bio'
        ]);
    }

}
