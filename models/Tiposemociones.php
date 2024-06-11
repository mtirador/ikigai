<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tiposemociones".
 *
 * @property int $idtipos
 * @property int|null $codemo
 * @property string|null $tipos
 *
 * @property Emociones $codemo0
 */
class Tiposemociones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tiposemociones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codemo'], 'integer'],
            [['tipos'], 'string', 'max' => 100],
            [['codemo', 'tipos'], 'unique', 'targetAttribute' => ['codemo', 'tipos']],
            [['codemo'], 'exist', 'skipOnError' => true, 'targetClass' => Emociones::class, 'targetAttribute' => ['codemo' => 'codemo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtipos' => 'Idtipos',
            'codemo' => 'Codemo',
            'tipos' => 'Tipos',
        ];
    }

    /**
     * Gets query for [[Codemo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodemo0()
    {
        return $this->hasOne(Emociones::class, ['codemo' => 'codemo']);
    }
    
    public $nombre; 
    public $descripcion;
     public $id;
    
}
