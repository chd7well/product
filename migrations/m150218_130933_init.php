<?php

use yii\db\Schema;
use yii\db\Migration;

class m150218_130933_init extends Migration
{
    public function up()
    {
    	$this->createTable('{{%sales_productgrp}}', [
    			'ID'                   => Schema::TYPE_PK,
    			'groupname' 	       => Schema::TYPE_STRING . '(255) NOT NULL',
    			'margin'				=>Schema::TYPE_FLOAT,
    	]);
    	
    	$this->createTable('{{%sales_product}}', [
    			'ID'                   => Schema::TYPE_PK,
    			'productname' 	       => Schema::TYPE_STRING . '(255) NOT NULL',
    			'description'          => Schema::TYPE_TEXT,
    			'itemnumber'		   => Schema::TYPE_STRING . '(50) NOT NULL',
    			'GS1GTIN'		  	   => Schema::TYPE_STRING . '(128) NOT NULL',
    			'unit_ID'	   => Schema::TYPE_INTEGER, //default unit
    			'productgrp_ID'	   => Schema::TYPE_INTEGER,
    	]);

    	$this->addForeignKey('fk_sales_product_productgrp', '{{%sales_product}}', 'productgrp_ID', '{{%sales_productgrp}}', 'ID');
    	
    	$this->createTable('{{%sales_bundle}}', [
    			'ID'                   => Schema::TYPE_PK,
    			'bundle_name'			=> Schema::TYPE_STRING . '(255) NOT NULL',
    			'bundle_unit_ID' 	       => Schema::TYPE_INTEGER . ' NOT NULL',
    			'item_unit_ID'            => Schema::TYPE_INTEGER . ' NOT NULL',
    			'item_count'			=> Schema::TYPE_FLOAT,
    	]);
    	
    	$this->addForeignKey('fk_sales_bundle_master_unit', '{{%sales_bundle}}', 'bundle_unit_ID', '{{%master_unit}}', 'ID');
    	$this->addForeignKey('fk_sales_bundle_master_unit_item', '{{%sales_bundle}}', 'item_unit_ID', '{{%master_unit}}', 'ID');
    	
    	$this->createTable('{{%sales_product_bundle}}', [
    			'ID'                   => Schema::TYPE_PK,
    			'bundle_ID' 	       => Schema::TYPE_INTEGER . ' NOT NULL',
    			'product_ID'            => Schema::TYPE_INTEGER . ' NOT NULL',
    	]);
    	
    	$this->addForeignKey('fk_sales_product_bundle_product', '{{%sales_product_bundle}}', 'product_ID', '{{%sales_product}}', 'ID');
    	$this->addForeignKey('fk_sales_product_bundle_bundle', '{{%sales_product_bundle}}', 'bundle_ID', '{{%sales_bundle}}', 'ID');
    	 
    	$this->createTable('{{%sales_product_retail_price}}', [
    			'ID'                   => Schema::TYPE_PK,
    			'product_ID' 	       => Schema::TYPE_INTEGER . ' NOT NULL',
    			'fromdate'          => Schema::TYPE_DATE,
    			'retailprice'		   => Schema::TYPE_FLOAT,
    	]);
    	
    	$this->addForeignKey('fk_sales_retail_price_product', '{{%sales_product_retail_price}}', 'product_ID', '{{%sales_product}}', 'ID');
    	
    	$this->createTable('{{%sales_product_supplier}}', [
    			'ID'                    => Schema::TYPE_PK,
    			'product_ID' 	        => Schema::TYPE_INTEGER . ' NOT NULL',
    			'supplier_ID'           => Schema::TYPE_INTEGER . ' NOT NULL',
    			'ordernumber'		    => Schema::TYPE_STRING . '(50)',
    			'comment'		   		=> Schema::TYPE_STRING . '(255)',
    	]);
    	
    	$this->addForeignKey('fk_sales_product_supplier_product', '{{%sales_product_supplier}}', 'product_ID', '{{%sales_product}}', 'ID');
    	$this->addForeignKey('fk_sales_product_supplier_supplier', '{{%sales_product_supplier}}', 'supplier_ID', '{{%res_partner}}', 'ID');
    	
    	$this->createTable('{{%sales_product_purchase_price}}', [
    			'ID'                    		=> Schema::TYPE_PK,
    			'purchase_ID' 	        		=> Schema::TYPE_INTEGER . ' NOT NULL',
    			'fromdate'           			=> Schema::TYPE_DATE,
    			'suggested_retailprice'		    => Schema::TYPE_FLOAT,
    			'comment'		   				=> Schema::TYPE_STRING . '(255)',
    	]);
    	
    	$this->addForeignKey('fk_sales_prodcut_purchase_price_ps', '{{%sales_product_purchase_price}}', 'purchase_ID', '{{%sales_product_supplier}}', 'ID');
    	
    	$this->insert('{{%sys_menu}}', [
    			'ID'=>5500,
    			'label'=>'Sales',
    			'url'=>'#',
    			'weight'=>5500,
    			'type_ID'=>1,
    			'uniquename'=>'chd7well\sales',
    			'entryoptions'=>"['tag'=>'span', 'content'=>'', 'options'=>[]]",
    			'beforelabel'=>"['tag'=>'i', 'content'=>'', 'options'=>['class'=>'fa fa-money']]",
    	]);
    	$this->insert('{{%sys_menu}}', [
    			'ID'=>5550,
    			'label'=>'Products',
    			'url'=>"['/sales/product/index']",
    			'weight'=>5550,
    			'type_ID'=>1,
    			'parent_ID'=>5500,
    			'uniquename'=>'chd7well\sales\product',
    			'entryoptions'=>"['tag'=>'span', 'content'=>'', 'options'=>[]]",
    	]);
    	$this->insert('{{%sys_menu}}', [
    			'ID'=>5549,
    			'label'=>'Product groups',
    			'url'=>"['/sales/productgrp/index']",
    			'weight'=>5549,
    			'type_ID'=>1,
    			'parent_ID'=>5500,
    			'uniquename'=>'chd7well\sales\productgrp',
    			'entryoptions'=>"['tag'=>'span', 'content'=>'', 'options'=>[]]",
    	]);
    	
    }

    public function down()
    {
        $this->dropTable('{{%product_product}}');
    }
}
