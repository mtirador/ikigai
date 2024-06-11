<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entradas".
 *
 * @property int $identrada
 * @property string|null $titulo
 * @property string|null $descripcion
 * @property string|null $fechaentrada
 *
 * @property Emociones[] $codemos
 * @property Pensamientos[] $codpens
 * @property Sensaciones[] $codsensas
 * @property Registroemociones[] $registroemociones
 * @property Registropensamientos[] $registropensamientos
 * @property Registrosensaciones[] $registrosensaciones
 */
class Entradas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entradas';
    }

    /**
     * {@inheritdoc}
     */
   public function rules()
{
    return [
        [['titulo', 'descripcion', 'fechaentrada'], 'required'],
        [['titulo'], 'string', 'max' => 100],
        [['descripcion'], 'string', 'max' => 3000],
        ['fechaentrada', 'date', 'format' => 'php:Y-m-d', 'min' => date('Y-m-d'), 'tooSmall' => 'La fecha de entrada no puede ser anterior a hoy.'],
    ];
}


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'identrada' => 'Identrada',
            'titulo' => 'Mi día en palabras',
            'descripcion' => 'Detalla tus experiencias de hoy...',
            'fechaentrada' => 'Hoy es: ',
        ];
    }

    /**
     * Gets query for [[Codemos]].
     *
     * @return \yii\db\ActiveQuery
     */
    
    public function getCodemos()
    {
        return $this->hasMany(Emociones::class, ['codemo' => 'codemo'])->viaTable('registroemociones', ['identrada' => 'identrada']);
    }

    /**
     * Gets query for [[Codpens]].
     *
     * @return \yii\db\ActiveQuery
     */
    
    public function getCodpens()
    {
        return $this->hasMany(Pensamientos::class, ['codpen' => 'codpen'])->viaTable('registropensamientos', ['identrada' => 'identrada']);
    }

    /**
     * Gets query for [[Codsensas]].
     *
     * @return \yii\db\ActiveQuery
     */
    
    public function getCodsensas()
    {
        return $this->hasMany(Sensaciones::class, ['codsensa' => 'codsensa'])->viaTable('registrosensaciones', ['identrada' => 'identrada']);
    }

    /**
     * Gets query for [[Registroemociones]].
     *
     * @return \yii\db\ActiveQuery
     */
    
    public function getRegistroemociones()
    {
        return $this->hasMany(Registroemociones::class, ['identrada' => 'identrada']);
    }

    /**
     * Gets query for [[Registropensamientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    
    public function getRegistropensamientos()
    {
        return $this->hasMany(Registropensamientos::class, ['identrada' => 'identrada']);
    }

    /**
     * Gets query for [[Registrosensaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    
    public function getRegistrosensaciones()
    {
        return $this->hasMany(Registrosensaciones::class, ['identrada' => 'identrada']);
    }
    
    
    public function getPensamientos()
    {
    return $this->hasMany(Pensamientos::className(), ['codpen' => 'codpen'])
        ->viaTable('registropensamientos', ['identrada' => 'identrada']);
    }

    
   
}
