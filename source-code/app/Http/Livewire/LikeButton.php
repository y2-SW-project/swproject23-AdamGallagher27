<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLike;
use Illuminate\Support\Facades\DB;



class LikeButton extends Component
{

    public $guitar;
    public $currentUser;

    // checks if the user has liked the guitar already
    private function hasLiked($guitar_id, $user_id)
    {
        $likes = UserLike::where("guitar_id", $guitar_id)->get();

        foreach ($likes as $like) {
            if ($like->guitar_id == $guitar_id and $like->user_id == $user_id) {
                return true;
            }
        }

        return false;
    }

    // function for liking a guitar
    // this is called when the like button is pressed on product view
    public function likeDislike( $guitar_id, $user_id )
    {

        // if the user hasnt liked this guitar before
        if(self::hasLiked($guitar_id, $user_id)) {
            // remove like from db
            DB::table('user_like')->where('guitar_id', $guitar_id)->where('user_id', $user_id)->delete();
            
        }
        else {
            // add new like to the like table
            $like = new UserLike;
            $like->guitar_id = $guitar_id;
            $like->user_id = $user_id;
            $like->save(); 
        }
    }


    public function render()
    {
        return view('livewire.like-button');
    }
}
