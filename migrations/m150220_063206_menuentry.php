<?php

use yii\db\Schema;
use yii\db\Migration;

class m150220_063206_menuentry extends Migration
{
    public function up()
    {
    	$this->insert('{{%sys_menu}}', [
    			'ID'=>5560,
    			'label'=>'Bundles (Unit)',
    			'url'=>"['/sales/bundle/index']",
    			'weight'=>5560,
    			'type_ID'=>1,
    			'parent_ID'=>5500,
    			'uniquename'=>'chd7well\sales\bundle',
    			'entryoptions'=>"['tag'=>'span', 'content'=>'', 'options'=>[]]",
    	]);
    }

    public function down()
    {
        echo "m150220_063206_menuentry cannot be reverted.\n";

        return false;
    }
}
