<?php

include("/xampp/htdocs/papeleria/db.php");

if(! empty($_POST['codigo'])){

    $query_show = mysqli_query($conexion, "SELECT c.correlativo_, c.id_producto_, c.cantidad_, (p.descripcion_) AS producto_, c.precio_venta_ 
    FROM detalle_temp_ c 
    INNER JOIN productos_ p 
    ON c.id_producto_ = p.id_producto_");

    $result_sql = mysqli_num_rows($query_show);

    while($data = mysqli_fetch_array($query_show)){
        
    $subtotal= round($data['cantidad_'] * $data['precio_venta_']);

    $valores = $data['id_producto_'];
    $valores = $data['cantidad_'];
    $valores = $data['producto_'];
    $valores = $data['precio_venta_'];
    $valores = $subtotal;
    }
}
?>
