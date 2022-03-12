<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vacation_days".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $data_start
 * @property string $data_end
 * @property int|null $status
 * @property string|null $update_at
 * @property string|null $created_at
 */
class VacationDays extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacation_days';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['data_start', 'data_end'], 'required'],
            [['data_start', 'data_end', 'update_at', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'data_start' => 'Data Start',
            'data_end' => 'Data End',
            'status' => 'Status',
            'update_at' => 'Update At',
            'created_at' => 'Created At',
        ];
    }
}
