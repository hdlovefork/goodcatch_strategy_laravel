<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Condition extends Model
{
    use HasFactory;

    /**
     * 简单条件
     */
    const TYPE_CONDITION = 'condition';

    /**
     * 复杂条件
     */
    const TYPE_STRATEGY = 'strategy';

    public static $typeMapModels = [
        self::TYPE_CONDITION => Condition::class,
        self::TYPE_STRATEGY => Strategy::class,
    ];

    protected static function booted()
    {
        parent::booted();
        static::saving(function ($model) {
            if (empty($model->display)) {
                // 如果条件的值包含-号，那么就是范围值
                $values = explode(',', $model->value);
                // 如果字段有单位，那么值的单位也要一致
                if ($model->field->unit) {
                    $values = array_map(function ($value) use ($model) {
                        return $value . $model->field->unit;
                    }, $values);
                }
                $values = implode(',', $values);
                // 格式化
                $s = sprintf($model->operator->format, $values);
                $model->display = $model->field->display . ' ' . $s;
            }
        });
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function toRule()
    {
        return [
            'field' => $this->field->name,
            'operator' => $this->operator->name,
            'value' => $this->value,
        ];
    }
}
