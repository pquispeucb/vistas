<?php
   $this->breadcrumbs=array(
    'Transacciones',
);
?>

<?php
    $relacionados=array();
        if (Yii::app()->user->checkAccess("action_personal_personal"))
        {$relacionados[]= array('label'=>'Costo Indirecto de Producto', 'url'=>array('/detalleIndirecto/indirecto',array('idTipoNegocio'=>'2')));}
        if (Yii::app()->user->checkAccess("action_materiaPrima_create"))
        {$relacionados[]= array('label'=>'Costo Total', 'url'=>array('/calculo/costoTotalComercio'));}
        
    $this->menu=$relacionados;
?>   
 
<html>

    <head>
        <meta charset="utf-8" />
        
           <script type="text/javascript">
            //funcion para la creacion de las tabs
            $(function()
                {
                    $( "#tabs" ).tabs();
                    
                }
            );
           </script>
           
            <script type="text/javascript" >
             var URLgetsaldo= "<?php echo Yii::app()->createUrl('transaccion/getSaldo');?>";
              var URLregistrar= "<?php echo Yii::app()->createUrl('transaccion/insert');?>";
              
            </script>
            
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
            
    </head>
            
    <body>
       
         <?php if(Yii::app()->user->hasFlash('success')):?>
            <div class="flash-success">
                <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
         <?php endif; ?>

          <?php if(Yii::app()->user->hasFlash('error')):?>
            <div class="flash-error">
                <?php echo Yii::app()->user->getFlash('error'); ?>
            </div>
         <?php endif; ?>
         
        <div id="tabs" class="shadowtabs ui-tabs-collapsible" >
            <ul>
                <li><a href="#tabs-1">APROBAR/RECHAZAR SOLICITUDES</a></li>
                
            </ul>
            
            
                
            <div id="stylized">
                       <?php $this->widget('zii.widgets.grid.CGridView', array(
                            'id'=>'solicitud-compra-grid',
                            'dataProvider'=>$model->searchConfirmadas(),
                            'columns'=>array(
                                //'id',                                       
                                'fecha_alta',
                            
                                //'estado',
                                array(
                                        'class'=>'CDataColumn',
                                        'header' => "Tipo de compra",
                                        'name'=>'tipo',
                                        'value'=>'$data->tipoCompra->tipo',
                                        'htmlOptions'=>array('style'=>'text-align: left;') 
                                ),
                                
                                array(
                                        'class'=>'CDataColumn',
                                        'header' => "Proveedor",
                                        'name'=>'proveedor',
                                        //'type'=>'html',
                                        'value'=>'$data->proveedors->nombre',
                                        'htmlOptions'=>array('style'=>'text-align: left;') 
                                ),
                                   
                                array(
                                        'class'=>'CDataColumn',
                                        'header' => "Cantidad de productos",
                                        'name'=>'tipo',
                                        'value'=>'$data->cantidades($data->id)',
                                        'htmlOptions'=>array('style'=>'text-align: left;') 
                                ),
                                
                                array(
                                        'class'=>'CDataColumn',
                                        'header' => "Precio Total",
                                        'name'=>'tipo',
                                        'value'=>'$data->total($data->id)',
                                        'htmlOptions'=>array('style'=>'text-align: left;') 
                                ),
                                
                                array(
                                        'class'=>'CButtonColumn',
                                        'template'=>'{editar} ',
                                        'buttons'=>array
                                        (           
                                        'editar' => array(
                                                    'label'=>"Ver Detalle",
                                                     'url'=>'Yii::app()->createUrl("solicitudCompra/view",array("id"=>$data->id))',
                                                    ),
                                                    /* 
                                        'delete' => array(
                                                    'label'=>"Eliminar",
                                                     'url'=>'Yii::app()->createUrl("cliente/delete")',
                                                     'imageUrl'=>false,
                                                    ), 
                                                    */
                                                ),
                                    ),
                                    
                                array(
                                    'class'=>'CButtonColumn',
                                    'header'=>'Opcion',
                                    'template'=>'{aprobar} {rechazar}',
                                    'buttons'=>array
                                     (           
                                    'aprobar' => array(
                                                'label'=>'Aprobar',
                                                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                                                'url'=>'Yii::app()->createUrl("solicitudCompra/aprobar", array("id"=>$data->id))',
                                                'options'=>array('confirm'=>'Esta seguro que desea aprobar esta solicitud?'),
                                            ),
                                    'rechazar' => array(
                                                'label'=>'Rechazar',
                                                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                                                'url'=>'Yii::app()->createUrl("solicitudCompra/rechazar", array("id"=>$data->id))',
                                                'options'=>array('confirm'=>'Esta seguro que desea rechazar esta solicitud?'),
                                            ),
                                      ),
                                    ),    
                            ),
                        )); ?>
           
            </div>
        </div>
    </body>
</html> 

