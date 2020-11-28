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
}
