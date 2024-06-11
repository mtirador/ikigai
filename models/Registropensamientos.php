<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registropensamientos".
 *
 * @property int $regpen
 * @property int|null $identrada
 * @property int|null $codpen
 *
 * @property Pensamientos $codpen0
 * @property Entradas $identrada0
 */
class Registropensamientos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registropensamientos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['identrada', 'codpen'], 'integer'],
            [['identrada', 'codpen'], 'unique', 'targetAttribute' => ['identrada', 'codpen']],
            [['identrada'], 'exist', 'skipOnError' => true, 'targetClass' => Entradas::class, 'targetAttribute' => ['identrada' => 'identrada']],
            [['codpen'], 'exist', 'skipOnError' => true, 'targetClass' => Pensamientos::class, 'targetAttribute' => ['codpen' => 'codpen']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'regpen' => 'Regpen',
            'identrada' => 'Identrada',
            'codpen' => 'Codpen',
        ];
    }

    /**
     * Gets query for [[Codpen0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodpen0()
    {
        return $this->hasOne(Pensamientos::class, ['codpen' => 'codpen']);
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
