<?php
/*
 What the Action Model is is that it stores the recent activity
 of the application in a database. If any action is taken with
 any other model the action model must be called to note it.
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    protected $table = "actions";
    public static function recent(){
        $actions = Action::orderBy('created_at','desc')->take(10)->get();
        $recent = [];
        foreach($actions as $action){
            $parameters = explode("+",$action->parameters);
            switch($action->type){
                case "Create":
                    $recent[] = $action->created_at->toDateTimeString()." (" .$parameters[0].") "."Added Website \"".$parameters[1]."\"";
                break;
                default:
                    $recent[] += "Unregistered Action: ID - ".$action->id;
                break;
            }
        }
        return $recent;
        // return Action::orderBy('created_at','desc')->take(10)->get();
    }
}
