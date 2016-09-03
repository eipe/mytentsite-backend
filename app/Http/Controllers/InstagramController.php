<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\TentSites;
use Vinkla\Instagram\Facades\Instagram;

class InstagramController extends Controller
{

    public function index() {
        // $tag = \DB::table(System::DB_SYSTEM)->where('key', 'my_tag_id')->get(array('value'));
        //  $newSites = Instagram::getTagMedia('mytentsite', 10, $tag);
        //$newSites = Instagram::getTagMedia('mytentsite', 10);
        $newSites = Instagram::tags()->getRecentMedia('liveterbestute', 10, 0);//('mytentsite', 10);
        dd($newSites);
       // dd($newSites->data[3]->location->latitude);

        foreach($newSites->data as $newSite) {
            if(isset($newSite->location->latitude) && isset($newSite->location->longitude)) {
                // Check if registered before
                if(\DB::table(TentSites::DB)->where('external_id', $newSite->id)->exists())
                {
                    continue;
                }

                \DB::table(TentSites::DB)->insert(
                    [
                        'reported_by' => $newSite->user->id,
                        'latitude' => $newSite->location->latitude,
                        'longitude' => $newSite->location->longitude,
                        'location_name' => $newSite->location->name,
                        'created_time' => $newSite->created_time,
                        'likes' => $newSite->likes->count,
                        'img_location' => $newSite->images->standard_resolution->url,
                        'thumbnail_location' => $newSite->images->thumbnail->url,
                        'caption' => $newSite->caption->text,
                        'external_id' => $newSite->id
                    ]
                );
            }
        }
        $this->updateMinTagId($newSites->pagination->min_tag_id);
    }


//    public function index() {
//
//        $tentSites = \DB::table(TentSites::DB)->select(
//            'latitude',
//            'longitude',
//            'thumbnail_location',
//            'img_location',
//            'location_name',
//            'caption')->get();
//        foreach($tentSites as $tentSite)
//        {
//            echo 'testf&w&L7zb7*mW';
//        }
//        return $tentSites;
//    }


    /**
     * @param integer $id my_tag_id Highest id collected from instagram in last request
     */
    private function updateMinTagId($id) {
        // Update the system var for min_tag_id
        $db = \DB::table(System::DB_SYSTEM);
        if($db->where('key', 'min_tag_id')->exists()) {
            $db->where('key', 'min_tag_id')->update(array(
                'value' => $id
            ));
        }
        else
        {
            $db->insert(array('key' => 'min_tag_id', 'value' => $id));
        }
    }


}
