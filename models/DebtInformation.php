<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "debt_information".
 *
 * @property int $id
 * @property string $iinBin ИИН/БИН
 * @property float $totalArrear Всего задолженности
 * @property float $totalTaxArrear Итого задолженности в бюджет
 * @property float $pensionContributionArrear Задолженность по пенсионным взносам
 * @property float $socialContributionArrear Задолженность по медицинским взносам
 * @property float $socialHealthInsuranceArrear Задолженность по социальным взносам
 */
class DebtInformation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'debt_information';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iinBin', 'totalArrear', 'totalTaxArrear', 'pensionContributionArrear', 'socialContributionArrear', 'socialHealthInsuranceArrear'], 'required'],
            ['iinBin', 'string', 'length' => [12, 12]],
            ['iinBin', 'match', 'pattern' => '/(\d){12}/', 'message' => 'Значение «ИИН/БИН» должно содержать только цифры'],
            [['totalArrear', 'totalTaxArrear', 'pensionContributionArrear', 'socialContributionArrear', 'socialHealthInsuranceArrear'], 'number'],
            [['iinBin'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iinBin' => 'ИИН/БИН',
            'totalArrear' => 'Всего задолженности',
            'totalTaxArrear' => 'Долг в бюджет',
            'pensionContributionArrear' => 'Долг по пенсионным взносам',
            'socialContributionArrear' => 'Долг по соц. взносам',
            'socialHealthInsuranceArrear' => 'Долг по мед. взносам',
        ];
    }
}
