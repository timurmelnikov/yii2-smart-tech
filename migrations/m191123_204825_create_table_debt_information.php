<?php

use yii\db\Migration;

/**
 * Class m191123_204825_create_table_debt_information
 */
class m191123_204825_create_table_debt_information extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable(
            'debt_information',
            [
                'id' => $this->primaryKey(11),
                'iinBin' => $this->string(20)->notNull()->comment('ИИН/БИН'), //id
                'totalArrear' => $this->float()->notNull()->defaultValue(0)->comment('Всего задолженности'),
                'totalTaxArrear' => $this->float()->notNull()->defaultValue(0)->comment('Итого задолженности в бюджет'),
                'pensionContributionArrear' => $this->float()->notNull()->defaultValue(0)->comment('Задолженность по пенсионным взносам'),
                'socialContributionArrear' => $this->float()->notNull()->defaultValue(0)->comment('Задолженность по социальным взносам'),
                'socialHealthInsuranceArrear' => $this->float()->notNull()->defaultValue(0)->comment('Задолженность по медицинским взносам'),

            ],
            'ENGINE=InnoDB'
        );

    }

    public function down()
    {
        $this->dropTable('debt_information');
    }

}
