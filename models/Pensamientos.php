<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pensamientos".
 *
 * @property int $codpen
 * @property int|null $intrusivo
 * @property int|null $recurrente
 * @property int|null $positivo
 *
 * @property Entradas[] $identradas
 * @property Registropensamientos[] $registropensamientos
 */
class Pensamientos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pensamientos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['intrusivo', 'recurrente', 'positivo'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codpen' => 'Codpen',
            'intrusivo' => 'Intrusivo',
            'recurrente' => 'Recurrente',
            'positivo' => 'Positivo',
        ];
    }

    /**
     * Gets query for [[Identradas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentradas()
    {
        return $this->hasMany(Entradas::class, ['identrada' => 'identrada'])->viaTable('registropensamientos', ['codpen' => 'codpen']);
    }

    /**
     * Gets query for [[Registropensamientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistropensamientos()
    {
        return $this->hasMany(Registropensamientos::class, ['codpen' => 'codpen']);
    }
    
    
     public $texto; // para poder meter el contenido en los detalles ref: views 
        // Define la propiedad identrada
    public $identrada;
    public $id;
}
