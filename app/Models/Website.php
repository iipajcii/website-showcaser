<?php

namespace App\Models;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Actions;
use Intervention\Image\ImageManager; //from composer package: intervention/image

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
        $website->image = $req->image;
        $website->categories = $req->categories;
        $website['is-hidden'] = (int)$req->hidden;
        $website->save();
        $action = new Action();
        $action->type = "Create";
        $action->parameters = $website->id. '+' .$website->name;
        $action->message = "";
        $action->save();

        $manager = new ImageManager();
        $image = str_replace('public','storage',$website->image);
        $image = $manager->make($image);

        $imageHeight = $image->height();
        $imageWidth = $image->width();
        $landscape = $portrat = false;

        $imageHeight > $imageWidth ? $portrat = true : $landscape = true;
        if($portrat){
            $image->crop($imageWidth,$imageWidth,0,0);
        }
        else {
            $image->crop($imageHeight,$imageHeight,0,0);
        }

        $image = $image->encode('jpeg');
        $image->save(str_replace('public','storage',$website->image).'.square.jpeg');
        $image = $image->encode('webp');
        $image->save(str_replace('public','storage',$website->image).'.square.webp');
        return true;
    }

    public static function edit_website(Request $req)
    {
        $website = Website::findOrFail($req->id);
        $website->name = $req->name;
        $website->link = $req->link;
        $website->description = $req->description;
        $website->image = $req->image;
        $website->categories = $req->categories;
        $website['is-hidden'] = (int)$req->hidden;
        $website->save();
        $action = new Action();
        $action->type = "Create";
        $action->parameters = $website->id. '+' .$website->name;
        $action->message = "";
        $action->save();

        $manager = new ImageManager();
        $image = str_replace('public','storage',$website->image);
        $image = $manager->make($image);

        $imageHeight = $image->height();
        $imageWidth = $image->width();
        $landscape = $portrat = false;

        $imageHeight > $imageWidth ? $portrat = true : $landscape = true;
        if($portrat){
            $image->crop($imageWidth,$imageWidth,0,0);
        }
        else {
            $image->crop($imageHeight,$imageHeight,0,0);
        }

        $image = $image->encode('jpeg');
        $image->save(str_replace('public','storage',$website->image).'.square.jpeg');
        $image = $image->encode('webp');
        $image->save(str_replace('public','storage',$website->image).'.square.webp');
        return true;
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
