<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'age' => $this->faker->numberBetween(18, 40),
            // 随机生成一个城市名
            'gender' => $this->faker->randomElement(['男', '女']),
            'city' => $this->faker->randomElement(['北京', '上海', '广州', '深圳', '杭州', '成都', '武汉', '南京', '西安', '厦门', '长沙', '苏州', '天津', '重庆', '郑州', '青岛', '合肥', '福州', '济南', '大连', '珠海', '无锡', '佛山', '东莞', '宁波', '常州', '沈阳', '石家庄', '昆明', '南昌', '南宁', '哈尔滨', '海口', '中山', '惠州', '贵阳', '长春', '太原', '嘉兴', '泰安', '昆山', '烟台', '兰州', '泉州', '南通', '金华', '徐州', '汕头', '温州', '乌鲁木齐', '绍兴', '济宁', '包头', '枣庄', '台州', '唐山', '潍坊', '保定', '扬州', '三亚', '呼和浩特', '临沂', '湖州', '洛阳', '威海', '德州', '漳州', '淄博', '鞍山', '廊坊', '安阳', '秦皇岛', '襄阳', '浦东新区', '盐城', '赣州', '宜昌', '泰州', '张家口', '湛江', '揭阳', '连云港', '黄山', '舟山', '衡阳', '株洲', '淮安', '宁德', '南充', '丹东', '营口', '芜湖', '宝鸡', '马鞍山', '南阳', '蚌埠', '九江', '汕尾', '宜宾', '柳州', '湘潭', '茂名',]),
            'password' => app('hash')->make('secret'),
        ];
    }
}
