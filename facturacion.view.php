<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación POS</title>
    <link rel="stylesheet" type="text/css" href="/papeleria/assets/css/styles.css" th:href="@/papeleria/assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/papeleria/assets/css/facturacionpos.css" th:href="@/papeleria/assets/css/fascturacionpos.css">
</head>

<body>
    <header>
        <?php
        include("/xampp/htdocs/papeleria/Views/template/header.view.php")
        ?>
    </header>
    <div class="container w-75 p-3">
        <div class="info">
            <form action="post" class="info">
                <div class="id">ID Factura</div><input type="text" class="id-form" name="ID factura">
                <input type="date" class="fecha">
                <div>
                    <?php
                    include("/xampp/htdocs/papeleria/db.php");
                    $query_cli = mysqli_query($conexion, "SELECT * FROM clientes_");
                    $result_cli = mysqli_num_rows($query_cli);

                    ?>
                    <select name="id" class="pro-form cliente">
                        <?php
                        if ($result_cli > 0) {
                            while ($cliente = mysqli_fetch_array($query_cli)) {
                        ?>
                                <option value="<?php echo $cliente["id_cliente_"]; ?>"><?php echo $cliente["nombre_"]; ?></option>
                        <?php

                            }
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <?php
                    include("/xampp/htdocs/papeleria/db.php");
                    $query_us = mysqli_query($conexion, "SELECT * FROM usuarios_");
                    $result_us = mysqli_num_rows($query_us);

                    ?>
                    <select class="vendedor pro-form">
                        <?php
                        if ($result_us > 0) {
                            while ($usuario = mysqli_fetch_array($query_us)) {
                        ?>
                                <option value="<?php echo $usuario["id_usuario_"]; ?>"><?php echo $usuario["nombre_usuario_"]; ?></option>
                        <?php

                            }
                        }

                        if (isset($_POST['pago'])) {
                            $pago = $_POST['pago'];
                        } else {
                            $pago = '';
                        }
                        ?>
                    </select>
                </div>
                <div class="co">Contado</div><input type="checkbox" name="pago" class="con" value="contado" <?php if ($pago == "contado") echo "checked"; ?>>
                <div class="cr">Crédito</div><input type="checkbox" name="pago" class="cre" value="credito" <?php if ($pago == "credito") echo "checked"; ?>>
        </div>
    </div>
    <div class="factura-container w-75 p-3">
        <div class="form-container">
            <table class="table overflow-auto" id="tabla">
                <thead>
                    <tr class="cab">
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Valor</th>
                        <th>Subtotal</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="codigo" class="cod" id="codigo"></td>
                        <td><input type="text" name="producto" class="nam" id="descripcion"></td>
                        <td><input type="text" name="cantidad" class="can" id="cantidad" value="0"></td>
                        <td><input type="text" name="valor" class="val" id="venta" value="0.00"></td>
                        <td><input type="text" name="subtotal" class="sub" id="subtotal" value="0.00"></td>
                    </tr>
                </thead>
                <tbody>
                    <tr id="detalle">

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="buttons-container w-75 p-3">
        <div class="buttons">
            <ul>
                <li><a href="" style="font-family: Arial, Helvetica, sans-serif;">Cerrar factura</a></li>
                <li><a href="/papeleria/views/imprimir/imprimirfactura.view.php" style="font-family: Arial, Helvetica, sans-serif;">Nueva factura</a></li>
                <li><a href="" style="font-family: Arial, Helvetica, sans-serif;">Reimprimir</a></li>
                <li><a href="" style="font-family: Arial, Helvetica, sans-serif;">Pasar a cartera</a></li>
            </ul>
            <div class="paga">Paga<input type="text" class="paga-form" name="Paga"></div>
            <div class="cambio">Cambio<input type="text" class="cambio-form" name="Cambio"></div>
            <div class="total">Total<input type="text" class="total-form" name="Total"></div>
            </form>
        </div>
    </div>
    <footer>
        <?php
        include("/xampp/htdocs/papeleria/Views/template/footer.view.php")
        ?>
    </footer>
</body>
<script src="/Controllers/facturacion.controller.js" type="text/javascript"></script>
</html>
