<?php
/*
 * This file is part of the 7well project.
 *
 * (c) 7well project <http://github.com/chd7well/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace chd7well\sales\models;

use Yii;
use yii\helpers\ArrayHelper;
use chd7well\master\models\Unit;
use chd7well\resource\models\Partner;

/**

 * @author Christian Dumhart <christian.dumhart@chd.at>
 */
class Supplier extends Partner
{
	
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}
	
	public function init()
	{
		parent::init();
		$this->is_supplier = true;
		$this->andWhere(['is_supplier'=>true]);
	}
	
}