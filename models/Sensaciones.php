<?php

namespace app\models;

use Yii;
use app\models\Registrosensaciones;

/**
 * This is the model class for table "sensaciones".
 *
 * @property int $codsensa
 * @property string|null $descripcion
 * @property string|null $denominacion
 * @property string|null $localizacioncorporal
 *
 * @property Entradas[] $identradas
 * @property Registrosensaciones[] $registrosensaciones
 */
class Sensaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sensaciones';
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['descripcion', 'denominacion', 'localizacioncorporal'], 'required', 'message' => 'Este campo no puede quedar vacío.'],
            [['descripcion', 'denominacion', 'localizacioncorporal'], 'string', 'max' => 500],
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'codsensa' => 'Codsensa',
            'descripcion' => 'Descripción',
            'denominacion' => 'Denominación',
            'localizacioncorporal' => 'Localización corporal',
        ];
    }

    /**
     * Gets query for [[Identradas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentradas()
    {
        return $this->hasMany(Entradas::class, ['identrada' => 'identrada'])->viaTable('registrosensaciones', ['codsensa' => 'codsensa']);
    }

    /**
     * Gets query for [[Registrosensaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegistrosensaciones()
    {
        return $this->hasMany(Registrosensaciones::class, ['codsensa' => 'codsensa']);
    }
    
   
    
     public $identrada;

}
