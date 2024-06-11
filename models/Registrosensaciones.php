<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registrosensaciones".
 *
 * @property int $regsensa
 * @property int|null $identrada
 * @property int|null $codsensa
 *
 * @property Sensaciones $codsensa0
 * @property Entradas $identrada0
 */
class Registrosensaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registrosensaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['identrada', 'codsensa'], 'integer'],
            [['identrada', 'codsensa'], 'unique', 'targetAttribute' => ['identrada', 'codsensa']],
            [['identrada'], 'exist', 'skipOnError' => true, 'targetClass' => Entradas::class, 'targetAttribute' => ['identrada' => 'identrada']],
            [['codsensa'], 'exist', 'skipOnError' => true, 'targetClass' => Sensaciones::class, 'targetAttribute' => ['codsensa' => 'codsensa']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'regsensa' => 'Regsensa',
            'identrada' => 'Identrada',
            'codsensa' => 'Codsensa',
        ];
    }

    /**
     * Gets query for [[Codsensa0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodsensa0()
    {
        return $this->hasOne(Sensaciones::class, ['codsensa' => 'codsensa']);
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
