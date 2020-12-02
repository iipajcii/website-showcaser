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
                case "Edit":
                    $str = $action->created_at->toDateTimeString()." (" .$parameters[0].") "."Edited Website \"".$parameters[1]."\"";
                    if(isset($parameters[2]) && ($parameters[2] != $parameters[1])){$str .= ", (renamed from \"".$parameters[2]."\")";}
                    $recent[] = $str;
                case "Toggle":
                    $str = $action->created_at->toDateTimeString()." (" .$parameters[0].") "."Toggled Website \".$parameters[1].\""." it is now ";
                    if(isset($parameters[2]) && (bool)$parameters[2]){$str .= "Visible";} else {$str .= "Hidden";}
                    $recent[] = $str;
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
