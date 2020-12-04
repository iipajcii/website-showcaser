<?php

namespace App\Models;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Actions;
use Intervention\Image\ImageManager; //from composer package: intervention/image
use Storage;

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
        $newImageName = rand().md5(time());
        Storage::copy($req->image, 'public/showcase-images/'.$newImageName);

        $imageUploaded = true;
        if($website->image == null) {$website->image = "default_image.png";$imageUploaded = false;}
        $website->categories = $req->categories;
        $website['is-hidden'] = (int)$req->hidden;
        $website->save();

        if($imageUploaded){
            $manager = new ImageManager();
            // $image = 'public/showcase-images/'.$newImageName;
            // str_replace('public','storage',$image);
            $image = $req->file('image')->store('public/showcase-images');
            $image = __DIR__.'/../../storage/app/'.$image;
            // return $image;
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
        }
        $action = new Action();
        $action->type = "Create";
        $action->parameters = $website->id. '+' .$website->name;
        $action->message = "";
        $action->save();

        return true;
    }

    public static function edit_website(Request $req)
    {
        $website = Website::findOrFail($req->id);
        $previousName = $website->name;
        if($req->name){$website->name = $req->name;}
        if($req->link){$website->link = $req->link;}
        if($req->description){$website->description = $req->description;}
        if($req->image){$website->image = $req->image;}if($website->image == null) {$website->image = "default_image.png";}
        if($req->categories){$website->categories = $req->categories;}
        if($req->hidden){$website['is-hidden'] = (int)$req->hidden;}
        $website->save();
        if($req->image){
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
        }
        $action = new Action();
        $action->type = "Edit";
        $action->parameters = $website->id. '+' .$website->name."+".$previousName;
        $action->message = "";
        $action->save();

        return true;
    }

    public static function toggle_website(Request $req)
    {
        $website = Website::findOrFail($req->data);
        $website['is-hidden'] = !$website['is-hidden'];
        $website->save();
        $action = new Action();
        $action->type = "Toggle";
        $action->parameters = $website->id. '+'.$website->name.'+'.$website['is-hidden'];
        $action->message = "";
        $action->save();
        if($website['is-hidden']){return 0;}
        else {return 1;}
    }
}
