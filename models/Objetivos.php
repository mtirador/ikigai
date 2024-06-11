<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "objetivos".
 *
 * @property int $codobj
 * @property string|null $denominacion
 * @property string|null $fechalimite
 * @property string|null $descripcion
 * @property int|null $completado
 */
class Objetivos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objetivos';
    }

    /**
     * {@inheritdoc}
     */
 public function rules()
{
    return [
        [['denominacion', 'fechalimite', 'descripcion'], 'required', 'message' => 'Por favor, complete este campo'],
        [['fechalimite'], 'date', 'format' => 'php:Y-m-d', 'message' => 'Por favor, ingrese una fecha'],
        [['denominacion'], 'string', 'max' => 100, 'message' => 'Por favor, ingrese la denominación'],//mensaje personalizado
        [['descripcion'], 'string', 'max' => 500, 'message' => 'Por favor, ingrese la descripción'],
        [['completado'],'boolean'], // Cambiado a boolean para completar o no 
    ];
}


    /**
     * {@inheritdoc}
     */
    
    
    /*voy a labels a cambiar los nombres que quiero que aparezcan en mi vista*/
    public function attributeLabels()
    {
        return [
            'codobj' => 'Codobj',
            'denominacion' => '¿Cuál será tu propósito?',
            'fechalimite' => '¿Cuál es tu fecha límite?',
            'descripcion' => 'Descripción',
            'completado' => 'Completado',
        ];
    }
    
   
}

