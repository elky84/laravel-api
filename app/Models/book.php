<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;

    // 대량 할당이 가능하도록 하는 것, $guarded 와 같이 쓸 수 없지만
    // 둘 중 하나는 사용해야 데이터 추가가 가능합니다, 두 변수를 비교해서 공부하시기를 추천드립니다.
    protected $fillable = [
        'name', 'url'
    ];
}
