<?php

use yii\db\Schema;
use yii\db\Migration;

class m150223_091829_itemnumber_ron extends Migration
{
    public function up()
    {
    	$this->insert('{{%master_ron}}', [
    			'ronname'=>'Itemnumber',
    			'startvalue'=>1,
    			'nextvalue'=>1,
    			'incvalue'=>1,
    			'pattern'=>'%Value%',
    	]); 
    }

    public function down()
    {
        echo "m150223_091829_itemnumber_ron cannot be reverted.\n";

        return false;
    }
}
