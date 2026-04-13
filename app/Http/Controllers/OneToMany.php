<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\PoliticalParty;
 
class OneToMany extends Controller
{
    public function get_political_party(){ 
        // $data = PoliticalParty::with('candidates')->where('name', 'Evert Jones I')->get();  // this search for table 1 (political party) condition
        $data = PoliticalParty::withwhereHas('candidates', function($q){
            // $q->where('candidate_name', 'Lynn Lemke'); // this search for table 2 (candidates) condition
        })->where('name', 'Olaf Will')->get();  // also search for name in table 1 (political parties) condition
        /* [{"id":2,"name":"Olaf Will","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z","candidates":[{"id":6,"political_party_id":2,"candidate_name":"Lynn Lemke","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":18,"political_party_id":2,"candidate_name":"Dr. Dallas Maggio","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":22,"political_party_id":2,"candidate_name":"Louisa Trantow","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":24,"political_party_id":2,"candidate_name":"Dr. Everardo Turcotte","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":35,"political_party_id":2,"candidate_name":"Dax Bergstrom","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"}]}] */
            
        /* =============== Get only candidates (table2 data) ===================
            $party = PoliticalParty::find(1);
            $data = $party->candidates()->select('candidate_name')->get(); 
        =======================================================================*/   
              
        /* =============== Get party whose no candidates (table2 data) =========
            $data = PoliticalParty::doesntHave('candidates')->get(); 
            [{"id":6,"name":"Prof. Shannon Schamberger MD","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":8,"name":"Kariane West IV","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":10,"name":"Percy Wiza","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":11,"name":"Tony Klocko","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":13,"name":"Sister Daniel","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":18,"name":"Winnifred Block","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":22,"name":"Frieda Mitchell","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":24,"name":"Dr. Jevon Upton","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":28,"name":"Triston Graham","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":35,"name":"Laisha Mayert","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":39,"name":"Broderick Wisozk","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"}]
        =======================================================================*/   
              
        /* ========================================================================
        |   $data = PoliticalParty::has('candidates')->get(); //get party only whose candidates (Get party whose candidates (table2 data [inverse of above]))
        |   
        |   $data = PoliticalParty::has('candidates','>=', 4)->with('candidates')->get();  // get party with candidates whose has min 4 candidatea
        |   [{"id":2,"name":"Olaf Will","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"}]
        |   
        |   $data = PoliticalParty::select('id', 'name')->withCount('candidates')->get(); //get party candidates count 
        |   [{"id":1,"name":"Evert Jones I","candidates_count":3},{"id":2,"name":"Olaf Will","candidates_count":5}]
        |   
        |   $party = PoliticalParty::find(2);
        |   $data = Candidate::whereBelongsTo($party)->get(); //get candidates whose political_party_id = 2 or has political party 2
        |   [{"id":6,"political_party_id":2,"candidate_name":"Lynn Lemke","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":18,"political_party_id":2,"candidate_name":"Dr. Dallas Maggio","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":22,"political_party_id":2,"candidate_name":"Louisa Trantow","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":24,"political_party_id":2,"candidate_name":"Dr. Everardo Turcotte","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"},{"id":35,"political_party_id":2,"candidate_name":"Dax Bergstrom","created_at":"2025-01-13T19:33:36.000000Z","updated_at":"2025-01-13T19:33:36.000000Z"}]
        /* ==========================================================================*/  
        return $data;
    }

    public function create_candidates(){ 
        $party = PoliticalParty::find(1);
        /* $party->candidates()->create([  //single create
            'candidate_name' => 'test candidate '. $party->id
        ]); */
        $party->candidates()->createMany([ //multi create
            ['candidate_name' => 'test candidate multi 1'],
            ['candidate_name' => 'test candidate multi 2'],
        ]);
    }

}
