<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user, Request $request)
    {
        if($request->user()->id == $user->id){
            return true;
        }elseif($request->user()->hasRole('admin')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model, Request $request)
    {
        if($request->user()->id == $user->id){
            return true;
        }elseif($request->user()->hasRole('admin')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Request $request)
    {
        if($request->user()->id == $user->id){
            return true;
        }elseif($request->user()->hasRole('admin')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model, Request $request)
    {
        if($request->user()->id == $model->id){
            $user = $request->user();
            return true;
        }elseif($request->user()->hasRole('admin')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model, Request $request)
    {
        if($request->user()->id == $user->id){
            return true;
        }elseif($request->user()->hasRole('admin')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model, Request $request)
    {
        if($request->user()->id == $user->id){
            return true;
        }elseif($request->user()->hasRole('admin')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model, Request $request)
    {
        if($request->user()->id == $user->id){
            return true;
        }elseif($request->user()->hasRole('admin')){
            return true;
        }else{
            return false;
        }
    }
}
