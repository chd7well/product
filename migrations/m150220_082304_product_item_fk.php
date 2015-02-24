<?php

use yii\db\Schema;
use yii\db\Migration;

class m150220_082304_product_item_fk extends Migration
{
    public function up()
    {
    	$this->addForeignKey('fk_sales_product_unit', '{{%sales_product}}', 'unit_ID', '{{%master_unit}}', 'ID');
    }

    public function down()
    {
        echo "m150220_082304_product_item_fk cannot be reverted.\n";

        return false;
    }
}
