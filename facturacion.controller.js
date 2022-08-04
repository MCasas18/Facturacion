
    $('#codigo').keyup(function(e) {
        e.preventDefault();

        var producto = $(this).val();
        var action = 'infoProducto';

        if (producto != '') {
            $.ajax({
                url: '/papeleria/controllers/buscar.pro.controller.php',
                type: "POST",
                async: true,
                data: {
                    action: action,
                    producto: producto
                },

                success: function(response) {

                    if (response != 'error') {

                        var info = JSON.parse(response);
                        $('#descripcion').val(info.descripcion_);
                        $('#venta').val(info.valor_venta_);

                    }
                }
            });
        }
    });

    $("#cantidad").keyup(function(e) {
        e.preventDefault();

        let cantidad = document.getElementById("cantidad").value;
        let valor = document.getElementById("venta").value;

        let resultado = parseFloat(cantidad) * parseFloat(valor)
        document.getElementById("subtotal").value = parseFloat(resultado)

        $('#subtotal').val(new Intl.NumberFormat().format(resultado));
    });


    $('#subtotal').blur(function(e) {

        e.preventDefault();

        if ($('#codigo').val() > 0) {

            let codigo = $("#codigo").val();
            let cantidad = $("#cantidad").val();
            let action = 'addProductoDetalle';

            $.ajax({

                url: '/papeleria/controllers/detalleTemp.controller.php',
                type: "POST",
                async: true,
                data: {
                    codigo: codigo,
                    cantidad: cantidad,
                    action: action,

                },

                success: function(response) {
                    console.log("Datos enviados");
                },

                error: function(response) {
                    console.log("Error al enviar datos");
                },

            });

            $.ajax({
                url: "/papeleria/controllers/detalle.controller.php",
                data: {codigo: $("#codigo").text()},
                success: function(result) {
                    
                    console.log(resultado);

                    var resultado = JSON.parse(JSON.stringify(result));

                    var html = "<tr><td>"+resultado['id_producto_']+"</td>"
                    var html = "<td>"+resultado['producto_']+"</td>"
                    var html = "<td>"+resultado['cantidad_']+"</td>"
                    var html = "<td>"+resultado['precio_venta_']+"</td>"
                    var html = "<td>"+resultado[$subtotal]+"</td></tr>"
                    

                    $("#tabla").append(html);
                }
            });
        };
    });
