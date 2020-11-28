<?php

namespace App\Models;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Actions;

class Website extends Model
{
    use HasFactory;
    protected $table = 'website';

    public static function add_website(Request $req)
    {
        $website = new Website();
        $website->name = $req->name;
        $website->link = $req->link;
        $website->description = $req->description;
        $website->categories = $req->categories;
        $website['is-hidden'] = (int)$req->hidden;
        $website->save();
        $action = new Action();
        $action->type = "Create";
        $action->parameters = $website->id. ', ' .$website->name;
        $action->message = "";
        $action->save();
    }

    // public function edit_website(Request $req)
    // {
    //     $website = new Website();
    //     $website->name = $req->name;
    //     $website->link = $req->link;
    //     $website->description = $req->description;
    //     $website->save();
    //     $action->type = "Edit";
    //     // $website->name != $req->name ?
    //     $action->parameters = $website->id. ', ' .$website->name;
    //     $action->save();
    // }
}
