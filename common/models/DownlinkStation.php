<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "downlink_station".
 *
 * @property integer $id
 * @property string $name
 * @property integer $value
 *
 * @property Progzone[] $progzones
 */
class DownlinkStation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'downlink_station';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['value'], 'integer'],
            [['name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgzones()
    {
        return $this->hasMany(Progzone::className(), ['downlink_station_id' => 'id']);
    }
}
