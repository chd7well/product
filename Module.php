<?php

namespace chd7well\sales;

class Module extends \yii\base\Module
{

	/** @var array Model map */
	public $modelMap = [];
	
	
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    /**
     * @var string The prefix for user module URL.
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'sales';
    

}
