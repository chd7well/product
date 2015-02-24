<?php

use yii\db\Schema;
use yii\db\Migration;

class m150224_030125_foreign_key_cascade extends Migration
{
    public function up()
    {
    	$this->dropForeignKey('fk_sales_product_bundle_product', '{{%sales_product_bundle}}');
    	$this->addForeignKey('fk_sales_product_bundle_product', '{{%sales_product_bundle}}', 'product_ID', '{{%sales_product}}', 'ID', 'CASCADE', 'RESTRICT');
    	
    	$this->dropForeignKey('fk_sales_product_supplier_product', '{{%sales_product_supplier}}');
    	$this->addForeignKey('fk_sales_product_supplier_product', '{{%sales_product_supplier}}', 'product_ID', '{{%sales_product}}', 'ID', 'CASCADE', 'RESTRICT');

    	$this->dropForeignKey('fk_sales_prodcut_purchase_price_ps', '{{%sales_product_purchase_price}}');
    	$this->addForeignKey('fk_sales_prodcut_purchase_price_ps', '{{%sales_product_purchase_price}}', 'purchase_ID', '{{%sales_product_supplier}}', 'ID', 'CASCADE', 'RESTRICT');
    	
    	$this->dropForeignKey('fk_sales_retail_price_product', '{{%sales_product_retail_price}}');
    	$this->addForeignKey('fk_sales_retail_price_product', '{{%sales_product_retail_price}}', 'product_ID', '{{%sales_product}}', 'ID', 'CASCADE', 'RESTRICT');
    	 
    }

    public function down()
    {
        echo "m150224_030125_foreign_key_cascade cannot be reverted.\n";

        return false;
    }
}
