<?php

namespace common\components;

use yii\base\Component;
use yii\helpers\Html;

class Content extends Component
{
    public function getFacultyLabel($faculty = null)
    {
        if ($faculty == 1) {
            $r = '<span class="ml-1">Faculty of Humanities</span>';
        } else if ($faculty == 2) {
            $r = '<span class="ml-1">Faculty of Education</span>';
        } else if ($faculty == 3) {
            $r = '<span class="ml-1">Faculty of Fine Arts</span>';
        } else if ($faculty == 4) {
            $r = '<span class="ml-1">Faculty of Social Sciences</span>';
        } else if ($faculty == 5) {
            $r = '<span class="ml-1">Faculty of Science</span>';
        } else if ($faculty == 6) {
            $r = '<span class="ml-1">Faculty of Engineering</span>';
        } else if ($faculty == 7) {
            $r = '<span class="ml-1">Faculty of Medicine</span>';
        } else if ($faculty == 8) {
            $r = '<span class="ml-1">Faculty of Agriculture</span>';
        } else if ($faculty == 9) {
            $r = '<span class="ml-1">Faculty of Dentistry</span>';
        } else if ($faculty == 10) {
            $r = '<span class="ml-1">Faculty of Pharmacy</span>';
        } else if ($faculty == 11) {
            $r = '<span class="ml-1">Faculty of Associated Medical Science</span>';
        } else if ($faculty == 12) {
            $r = '<span class="ml-1">Faculty of Nursing</span>';
        } else if ($faculty == 13) {
            $r = '<span class="ml-1">Faculty of Agro-Industry</span>';
        } else if ($faculty == 14) {
            $r = '<span class="ml-1">Faculty of Veterinary Medicine</span>';
        } else if ($faculty == 15) {
            $r = '<span class="ml-1">Faculty of Business Administration</span>';
        } else if ($faculty == 16) {
            $r = '<span class="ml-1">Faculty of Economics</span>';
        } else if ($faculty == 17) {
            $r = '<span class="ml-1">Faculty of Architecture</span>';
        } else if ($faculty == 18) {
            $r = '<span class="ml-1">Faculty of Mass Communication</span>';
        } else if ($faculty == 19) {
            $r = '<span class="ml-1">Faculty of Political Science and Public Administration</span>';
        } else if ($faculty == 20) {
            $r = '<span class="ml-1">Faculty of Law</span>';
        }else if ($faculty == 21) {
            $r = '<span class="ml-1">College of Arts, Media and Technology</span>';
        }
        return $r;
    }
}