<?php
/**
 * Created by PhpStorm.
 * User: clbs
 * Date: 10/13/2017
 * Time: 5:15 PM
 */

namespace backend\modules\content\components;

use yii\base\Component;

class Projectstatus extends Component
{
    public function getProjectStatus($status = null){
        if($status=='Inactive'){
            $r = '<span class="label label-danger">Unpublished</span>';
        }else if($status=='Active'){
            $r = '<span class="label label-success">Published</span>';
        }
        return $r;
    }
}