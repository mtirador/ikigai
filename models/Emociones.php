<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "emociones".
 *
 * @property int $codemo
 * @property string|null $intensidad
 * @property int|null $agradable
 *
 * @property Entradas[] $identradas
 * @property Registroemociones[] $registroemociones
 * @property Tiposemociones[] $tiposemociones
 */
class Emociones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emociones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
{
    return [
        [['agradable'], 'integer'],
        [['intensidad'], 'required', 'message' => 'Este campo no puede quedar vacío.'],
        [['intensidad'], 'string', 'max' => 100],
    ];
}


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codemo' => 'Codemo',
            'intensidad' => 'Nivel de intensidad',
            'agradable' => 'Agradable',
        ];
    }

    /**
     * Gets query for [[Identradas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentradas()
    {
        return $this->hasMany(Entradas::class, ['identrada' => 'identrada'])->viaTable('registroemociones', ['codemo' => 'codemo']);
    }

    /**
     * Gets query for [[Registroemociones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistroemociones()
    {
        return $this->hasMany(Registroemociones::class, ['codemo' => 'codemo']);
    }

    /**
     * Gets query for [[Tiposemociones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTiposemociones()
    {
        return $this->hasMany(Tiposemociones::class, ['codemo' => 'codemo']);
    }
    
      public $texto; // para poder meter el contenido en los detalles 
      
      public $identrada; // Propiedad adicional para capturar el identificador de la entrada

      public $tipoEmociones;
}
