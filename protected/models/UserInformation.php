<?php

class UserInformation extends  CActiveRecord
{

    public $first_name;
    public $last_name;
    public $college;
    public $city;
    public $branch;
    public $id;
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function primaryKey()
    {
        return 'id';

    }
    public  function tableName()
    {
        return 'user_informations';
    }
    public function rules()
    {
        return [
            ['first_name', 'required'],
            ['last_name', 'required'],
            ['college', 'required'],
            ['city', 'required'],
            ['branch','required']
        ];
    }


}
