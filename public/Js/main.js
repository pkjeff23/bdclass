/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* global pass */

$(function () {
    validarUsuario();
    validarModificar();
    validarContraseña();
    filtrarPeriodo();
    validarAgregarNota();
});

var contraseña;

function validarUsuario() {
    $('#entrar').on('click', function (e) {
        if ($('#user').val() === '') {
            alert('No ha ingresado un usuario');
            $('#pass').val('');
            $('#user').focus();
            return;
        }

        if ($('#pass').val() === '') {
            alert('No ha ingresado una contraseña');
            $('#pass').val('');
            $('#pass').focus();
            return;
        }
        $('#log').submit();
    });
}

function validarModificar() {
    $('#guardar').on('click', function () {
        if ($('#nombres').val() === '') {
            alert('Ingrese sus nombres');
            $('#nombres').val('');
            $('#nombres').focus();
            return;
        }
        if ($('#apellidos').val() === '') {
            alert('Ingrese sus apellidos');
            $('#apellidos').val('');
            $('#apellidos').focus();
            return;
        }
        if ($('#num_identificacion').val() === '') {
            alert('Ingrese su número de identificación');
            $('#num_identificacion').val('');
            $('#num_identificacion').focus();
            return;
        }
        if ($('#telefono').val() === '') {
            alert('Ingrese un teléfono');
            $('#telefono').val('');
            $('#telefono').focus();
            return;
        }
        if ($('#direccion').val() === '') {
            alert('Ingrese su dirección');
            $('#direccion').val('');
            $('#direccion').focus();
            return;
        }
        if (!regexDateValidator($('#fecha_nac').val())) {
            alert('Fecha incorrecta');
            $('#fecha_nac').val('');
            return;
        }
        $('#actualizar').submit();
    });
}

function regexDateValidator(fecha) {
    return /[0-9]{4}\-[0-9]{2}\-[0-9]{2}/.test(fecha);
}

function validarContraseña() {
    $('#cambiar_contrasena').on('click', function () {
        if ($('#vieja').val() === '') {
            alert('Ingrese su contraseña actual');
            $('#vieja').val('');
            $('#vieja').focus();
            return;
        }
        if (pass !== $('#vieja').val()) {
            alert('La contraseña no coincide con la antigua');
            $('#vieja').val('');
            $('#vieja').focus();
            return;
        }
        if ($('#nueva1').val() === '') {
            alert('Ingrese su contraseña nueva');
            $('#nueva1').val('');
            $('#nueva1').focus();
            return;
        }
        if ($('#nueva2').val() === '') {
            alert('Ingrese su contraseña nueva');
            $('#nueva2').val('');
            $('#nueva2').focus();
            return;
        }
        if ($('#nueva1').val() !== $('#nueva2').val()) {
            alert('Las contraseñas nuevas no coinciden');
            $('#nueva1').val('');
            $('#nueva2').val('');
            $('#nueva1').focus();
            return;
        }
        $('#contrasena').submit();
    });
}

function filtrarPeriodo() {
    $('#boton_periodo').on('click', function (e) {
        if (filtrar) {
            $('#label_periodo').removeAttr('hidden');
            $('#select_periodo').removeAttr('hidden');
            $('#boton_periodo').text('Deshacer');
            filtrar = 0;
            var ajax = $.ajax({
                type: "POST",
                url: "../POJO/ajax_periodo.php",
                data: {
                    tag: '1'
                }
            });
            ajax.done(function (resp) {
                
                datos = JSON.parse(resp.toString());
                console.log(datos);

                $("#select_periodo").empty();
                for (l in datos) {
                    $("#select_periodo").append("<option value='" + datos[l].periodo + "'>Periodo " + datos[l].periodo + "</option>");
                }
            });
        } else {
            $('#label_periodo').attr('hidden', '')
            $('#select_periodo').attr('hidden', '');
            $('#boton_periodo').text('Filtrar por periodo');
            filtrar = 1;
            var ajax = $.ajax({
                type: "POST",
                url: "../POJO/ajax_periodo.php",
                data: {
                    id: idAsignatura
                }
            });

            ajax.done(function (datos) {
                $("#tbody").empty();

                datos = JSON.parse(datos);
                console.log(datos);

                for (l in datos) {
                    $("#tbody").append("<tr>" +
                            "<td>" + datos[l].idNota + "</td>" +
                            "<td>" + datos[l].grupo + "</td>" +
                            "<td>" + datos[l].actividad + "</td>" +
                            "<td>" + datos[l].nombre + "</td>" +
                            "<td>" + datos[l].periodo + "</td>" +
                            "<td>" + datos[l].valoracion + "</td>" +
                            +"</tr>");
                }
            });
        }
    });

    $("#select_periodo").on("change", function (event) {

        var periodo = $(this).val();

        var ajax = $.ajax({
            type: "POST",
            url: "../POJO/ajax_periodo.php",
            data: {
                id: idAsignatura,
                periodo: periodo,
                tag: '2'
            }
        });

        ajax.done(function (datos) {
            $("#tbody").empty();

            
            datos = JSON.parse(datos);
            console.log(datos);

            for (l in datos) {
                $("#tbody").append("<tr>" +
                        "<td>" + datos[l].idNota + "</td>" +
                        "<td>" + datos[l].grupo + "</td>" +
                        "<td>" + datos[l].actividad + "</td>" +
                        "<td>" + datos[l].nombre + "</td>" +
                        "<td>" + datos[l].periodo + "</td>" +
                        "<td>" + datos[l].valoracion + "</td>" +
                        +"</tr>");
            }
        });
    });
}

function validarAgregarNota(){
    $('#insertar_nota').on('click', function (e){
        if ($('#valoracion').val() === ''){
            alert('Ingrese una valoración');
            $('#valoracion').val('');
            $('#valoracion').focus();
            return;
        }
        
        $('#agregar_nota').submit();
    });
}