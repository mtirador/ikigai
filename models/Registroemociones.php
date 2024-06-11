<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registroemociones".
 *
 * @property int $regemo
 * @property int|null $identrada
 * @property int|null $codemo
 *
 * @property Emociones $codemo0
 * @property Entradas $identrada0
 */
class Registroemociones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registroemociones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['identrada', 'codemo'], 'integer'],
            [['identrada', 'codemo'], 'unique', 'targetAttribute' => ['identrada', 'codemo']],
            [['codemo'], 'exist', 'skipOnError' => true, 'targetClass' => Emociones::class, 'targetAttribute' => ['codemo' => 'codemo']],
            [['identrada'], 'exist', 'skipOnError' => true, 'targetClass' => Entradas::class, 'targetAttribute' => ['identrada' => 'identrada']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'regemo' => 'Regemo',
            'identrada' => 'Identrada',
            'codemo' => 'Codemo',
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

    /**
     * Gets query for [[Identrada0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentrada0()
    {
        return $this->hasOne(Entradas::class, ['identrada' => 'identrada']);
    }
}
