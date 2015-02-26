<?php

use yii\db\Schema;
use yii\db\Migration;

class m150226_124514_add_activecol extends Migration
{
    public function up()
    {
		$this->addColumn('{{%sales_product_supplier}}', 'active',	Schema::TYPE_BOOLEAN);
    }

    public function down()
    {
        echo "m150226_124514_add_activecol cannot be reverted.\n";

        return false;
    }
}
