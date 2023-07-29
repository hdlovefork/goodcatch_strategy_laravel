<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Operator extends Model
{
    use HasFactory;

    // 定义比较运算符常量
    const TYPE_COMPARE = 0;

    // 定义逻辑运算符常量
    const TYPE_LOGIC = 1;
}
