<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Auth;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getResponse($code, $message = NULL, $data = NULL)
    {
        return response()->json([
            'response_code' => $code,
            'response' => $this->getResponseType($code),
            'message' => $message,
            'data' => $data
        ]);
    }

    public function getResponseType($code)
    {
        return $code;
    }

    public function createSlug($model, $title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($model, $slug, $id);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        $i = 1;
        $contains = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $contains = false;
                return $newSlug;
            }
            $i++;
        } while ($contains);
    }

    protected function getRelatedSlugs($model, $slug, $id = 0)
    {
        $NamespacedModel = '\\App\\Models\\' . ucwords($model);
        return $NamespacedModel::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

    public function getUserRole()
    {
        $user = Auth::user();

        // return $user;

        $data = [];

        $role = json_decode($user->role);
        // $role = $user->role;

        // return $user->role;

        if(isset($role->ironman)) {

            if(isset($role->ironman->level)) $data['level'] = $role->ironman->level;

            if(isset($role->ironman->entity->product)) {

                $data['entity']['product'] = explode(",", $role->ironman->entity->product);

                if(isset($role->ironman->entity->item)) $data['entity']['item'] = explode(",", $role->ironman->entity->item);

            }   
        }
        else {
            $data['level'] = 'blocked';
            $data['entity'] = '';
        }

        return $data;
    }

}
