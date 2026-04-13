<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhoneNumber;
use App\Models\User;

class HasOneThrough extends Controller
{
    public function index(){
        // return User::with('PhoneNumber')->with('company')->find(101);
        /* {"id":101,"name":"Queenie Hammes","email":"dvonrueden@example.net","email_verified_at":"2025-01-15T15:23:34.000000Z","created_at":"2025-01-15T15:23:38.000000Z","updated_at":"2025-01-15T15:23:38.000000Z","phone_number":{"id":1,"company_id":1,"phone_number":"+18707276723","created_at":"2025-01-15T15:23:38.000000Z","updated_at":"2025-01-15T15:23:38.000000Z","laravel_through_key":101},"company":{"id":1,"user_id":101,"company_name":"Cecil Fritsch II","created_at":"2025-01-15T15:23:38.000000Z","updated_at":"2025-01-15T15:23:38.000000Z"}} */
        // return User::find(101)->PhoneNumber;
        /* {"id":1,"company_id":1,"phone_number":"+18707276723","created_at":"2025-01-15T15:23:38.000000Z","updated_at":"2025-01-15T15:23:38.000000Z","laravel_through_key":101} */
        
        /* ========  jab tak primary table me id nhi denge to iske relations ke data null ainge ========= 
        |  return User::select('name')->with('PhoneNumber:phone_number,company_id')->with('company')->find(101);
        |  {"name":"Queenie Hammes","phone_number":null,"company":null} 
        |  ===================================================================================*/
        
        return User::select('name', 'id')->with('PhoneNumber:phone_number,company_id')->with('company')->find(101);
        /* {"name":"Queenie Hammes","id":101,"phone_number":{"phone_number":"+18707276723","company_id":1,"laravel_through_key":101},"company":{"id":1,"user_id":101,"company_name":"Cecil Fritsch II","created_at":"2025-01-15T15:23:38.000000Z","updated_at":"2025-01-15T15:23:38.000000Z"}} */
    }
}
