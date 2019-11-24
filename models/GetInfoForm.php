<?php

namespace app\models;

use yii\base\Model;

/**
 * GetInfoForm модель формы запроса информации по ИНН
 *
 * @property string $inn
 *
 */
class GetInfoForm extends Model
{
    public $inn;

    /**
     * Валидаторы
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['inn', 'required'],
            ['inn', 'string', 'length' => [12, 12]],
            ['inn', 'match', 'pattern' => '/(\d){12}/', 'message' => 'Значение «ИИН» должно содержать только цифры'],
        ];
    }


    /**
     * Наименования полей
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'inn' => 'ИИН',
        ];
    }
}
