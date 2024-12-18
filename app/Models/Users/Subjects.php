<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;

class Subjects extends Model
{
    const UPDATED_AT = null;


    protected $fillable = [
        'subject'
    ];

    public function users()
    {
        // リレーションの定義
        return $this->belongsToMany(User::class, 'subject_users', 'subject_id', 'user_id')
            ->withTimestamps(); // 中間テーブルでタイムスタンプを使用する場合

    }
}
