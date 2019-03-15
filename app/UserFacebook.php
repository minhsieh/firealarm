<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFacebook extends Model
{
    protected $fillable = [
        'user_id',
        'fb_id',
        'name',
        'email',
        'avatar',
        'token'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function updateIt(Array $fb_data)
    {
        $this->fb_id = $fb_data['id'];
        $this->name = $fb_data['name'];
        $this->email = $fb_data['email'];
        $this->avatar = $fb_data['avatar'];
        $this->token = $fb_data['token'];
        $this->save();
    }
}
