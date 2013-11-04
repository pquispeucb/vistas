<?php

/**
 * This is the model class for table "producto".
 *
 * The followings are the available columns in table 'producto':
 * @property integer $id
 * @property string $codigo
 * @property string $descripcion
 * @property integer $usuario_solicitante_id
 *
 * The followings are the available model relations:
 * @property Compra[] $compras
 * @property Cotizacion[] $cotizacions
 * @property Inventario[] $inventarios
 * @property CrugeUser $usuarioSolicitante
 * @property SolicitudCompra[] $solicitudCompras
 */
class Producto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Producto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, descripcion, usuario_solicitante_id', 'required'),
			array('usuario_solicitante_id', 'numerical', 'integerOnly'=>true),
			array('codigo', 'length', 'max'=>45),
			array('descripcion', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, codigo, descripcion, usuario_solicitante_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'compras' => array(self::MANY_MANY, 'Compra', 'compra_item(producto_id, compra_id)'),
			'cotizacions' => array(self::MANY_MANY, 'Cotizacion', 'cotizacion_item(producto_id, cotizacion_id)'),
			'inventarios' => array(self::MANY_MANY, 'Inventario', 'inventario_items(producto_id, inventario_id)'),
			'usuarioSolicitante' => array(self::BELONGS_TO, 'CrugeUser', 'usuario_solicitante_id'),
			'solicitudCompras' => array(self::MANY_MANY, 'SolicitudCompra', 'solicitud_compra_item(producto_id, solicitud_compra_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'codigo' => 'Codigo',
			'descripcion' => 'Descripcion',
			'usuario_solicitante_id' => 'Usuario Solicitante',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('usuario_solicitante_id',$this->usuario_solicitante_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}