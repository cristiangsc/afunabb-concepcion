
$.noConflict(true);
$(document).ready(function() {

    
      $.extend(true, $.fn.dataTable.defaults, {
        info: true,
        paging: true,
        ordering: true,
        searching: true,
        processing: true,
        serverSide: false,
        responsive: true,
        destroy: true,
        stateSave:false,
        language: {
            url: "/Spanish.json"  // traducir la tabla
        },
    });

    $('#tablaSocioBeneficioGeneral').DataTable({
        scrollY:"50vh",
        ajax: '/beneficios/otorgados',

        "columns": [

            { "data": "rut" },
            { "data": "dv" },
            { "data": "nombre" },
            { "data": "paterno" },
            { "data": "materno" },
            { "data": "beneficio" },
            { "data": "fecha_beneficio" },
            { "data": "monto_beneficio" },
            
        ],
        
     "columnDefs":[
        {className:"dt-body-center",targets:[1,7]},
     ],
     lengthMenu: [
            [10, 50, 100, 200, -1], [10, 50, 100, 200, 'Todos'] //cantidad de registros por pagina
        ],
        dom: "Bfrtip",
        buttons: [
           'excel', 'pdf', 'print','pageLength'
           
        ],

    });  

    $('#tablaSocioConstanciaGeneral').DataTable({
        scrollY:"50vh",
        ajax: '/constancias/otorgadas',

        "columns": [

            { "data": "id" },
            { "data": "rut" },
            { "data": "dv" },
            { "data": "nombre" },
            { "data": "paterno" },
            { "data": "materno" },
            { "data": "descripcion_participacion" },
            { "data": "fecha_inicio" },
            { "data": "fecha_termino" },
            { "data": "btn" },
            
        ],
        
     "columnDefs":[
        {className:"dt-body-center",targets:[2,7]},
     ],
     lengthMenu: [
            [10, 50, 100, 200, -1], [10, 50, 100, 200, 'Todos'] //cantidad de registros por pagina
        ],
        dom: "Bfrtip",
        buttons: [
           'excel', 'pdf', 'print','pageLength'
           
        ],

    });  


         $('#tablaSocioConstancia').DataTable({
            scrollY:"50vh",
            ajax: '/tasksconstancia',
    
            "columns": [
    
                { "data": "rut" },
                { "data": "dv" },
                { "data": "nombre" },
                { "data": "paterno" },
                { "data": "materno" },
                { "data": "btn" },
    
            ],
    
        });
     
 
    $('#tablaSocioBeneficio').DataTable({
        scrollY:"50vh",
        ajax: '/tasksbeneficio',

        "columns": [

            { "data": "rut" },
            { "data": "dv" },
            { "data": "nombre" },
            { "data": "paterno" },
            { "data": "materno" },
            { "data": "btn" },

        ],
    });

    $('#tablaSocio').DataTable({
        scrollY:"50vh",
        ajax: '/tasks',

        "columns": [

            { "data": "rut" },
            { "data": "dv" },
            { "data": "nombre" },
            { "data": "paterno" },
            { "data": "materno" },
            { "data": "paternidad" },
            { "data": "calidad" },
            { "data": "fecha_nacimiento" },
            { "data": "fecha_ingreso_ubb" },
            { "data": "fecha_ingreso_afunabb" },
            { "data": "reparticion" },
            { "data": "sede" },
            { "data": "email" },
            { "data": "telefono" },
            { "data": "anexo" },
            { "data": "direccion" },
            { "data": "comuna" },
            { "data": "nombre_cargo" },
            { "data": "name_role" },
            { "data": "btn" },

        ],
        
     "columnDefs":[
        {className:"dt-body-center",targets:[1,5,6]},
     ],
     lengthMenu: [
            [50, 100, 500,1000, -1], [50, 100, 500,1000, 'Todos'] //cantidad de registros por pagina
        ],
        dom: "Bfrtip",
        buttons: [
           'excel', 'pdf', 'print','pageLength'
           
        ],

    });  

    $('#tablaInversiones').DataTable({
        scrollY:"50vh",
        ajax: '/inversiones',

        "columns": [
            { "data": "id" },
            { "data": "nombre_inversion" },
            { "data": "monto_inversion" },
            { "data": "fecha_inversion" },
            { "data": "documento" },
            { "data": "num_documento" },
            { "data": "anno" },
            { "data": "btn" },

        ],
        
     "columnDefs":[
        {className:"dt-body-center",targets:[2,3,4,5]},
     ],
     lengthMenu: [
            [10, 20, 30,40, -1], [10, 20, 30, 40, 'Todos'] //cantidad de registros por pagina
        ],
        dom: "Bfrtip",
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print',
           
        ],

    });  
   

    // new $.fn.dataTable.FixedHeader(table);

    $('.caption').on('click', 'a.info-link', function(e) {
        e.preventDefault();
        $(this).closest('.thumbnail').find('.more-info').fadeToggle();
    });

    //--------------------------------
    $('#caja').on('keyup', function(e) {
        var caja = $('#caja').val();
        var transb = $('#transbank').val();
        var junaeb = $('#junaeb').val();
        var total = parseInt(transb) + parseInt(caja) + parseInt(junaeb);
        $('#total_ingresos').val(formatNumber.new(total));
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13)
        document.getElementById("transbank").focus();
    });
    $('#transbank').on('keyup', function(e) {
        var caja = $('#caja').val();
        var transb = $('#transbank').val();
        var junaeb = $('#junaeb').val();
        var total = parseInt(transb) + parseInt(caja) + parseInt(junaeb);
        $('#total_ingresos').val(formatNumber.new(total));
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13)
        document.getElementById("junaeb").focus();
    });

    $('#junaeb').on('keyup', function(e) {
        var caja = $('#caja').val();
        var transb = $('#transbank').val();
        var junaeb = $('#junaeb').val();
        var total = parseInt(transb) + parseInt(caja) + parseInt(junaeb);
        $('#total_ingresos').val(formatNumber.new(total));
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13)
        document.getElementById("facturas").focus();
    });
    //-------------------------
    $('#facturas').on('keyup', function(e) {
        var fact = $('#facturas').val();
        var remun = $('#remuneraciones').val();
         var comi = $('#comision').val();
        var impu = $('#impuestos').val();
        var gast = $('#gastos').val();
        var impo = $('#imposiciones').val();
        var hono = $('#honorarios').val();
        var total = parseInt(fact) + parseInt(remun) + parseInt(impu) + parseInt(gast) + parseInt(impo) + parseInt(hono)+ parseInt(comi);

        $('#total_egresos').val(formatNumber.new(total));
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13)
        document.getElementById("comision").focus();
    });
    
    $('#comision').on('keyup', function(e) {
        var fact = $('#facturas').val();
        var remun = $('#remuneraciones').val();
        var comi = $('#comision').val();
        var impu = $('#impuestos').val();
        var gast = $('#gastos').val();
        var impo = $('#imposiciones').val();
        var hono = $('#honorarios').val();
        var total = parseInt(fact) + parseInt(remun) + parseInt(impu) + parseInt(gast) + parseInt(impo) + parseInt(hono)+ parseInt(comi);

        $('#total_egresos').val(formatNumber.new(total));
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13)
        document.getElementById("remuneraciones").focus();
    });

    $('#remuneraciones').on('keyup', function(e) {
        var fact = $('#facturas').val();
        var comi = $('#comision').val(); 
        var remun = $('#remuneraciones').val();
        var impu = $('#impuestos').val();
        var gast = $('#gastos').val();
        var impo = $('#imposiciones').val();
        var hono = $('#honorarios').val();
        var total = parseInt(fact) + parseInt(remun) + parseInt(impu) + parseInt(gast) + parseInt(impo) + parseInt(hono)+ parseInt(comi);

        $('#total_egresos').val(formatNumber.new(total));
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13)
        document.getElementById("imposiciones").focus();
    });

    $('#imposiciones').on('keyup', function(e) {
        var fact = $('#facturas').val();
        var comi = $('#comision').val(); 
        var remun = $('#remuneraciones').val();
        var impu = $('#impuestos').val();
        var gast = $('#gastos').val();
        var impo = $('#imposiciones').val();
        var hono = $('#honorarios').val();
        var total = parseInt(fact) + parseInt(remun) + parseInt(impu) + parseInt(gast) + parseInt(impo) + parseInt(hono)+ parseInt(comi);

        $('#total_egresos').val(formatNumber.new(total));
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13)
        document.getElementById("impuestos").focus();
    });

    $('#impuestos').on('keyup', function(e) {
        var fact = $('#facturas').val();
        var comi = $('#comision').val(); 
        var remun = $('#remuneraciones').val();
        var impu = $('#impuestos').val();
        var gast = $('#gastos').val();
        var impo = $('#imposiciones').val();
        var hono = $('#honorarios').val();
        var total = parseInt(fact) + parseInt(remun) + parseInt(impu) + parseInt(gast) + parseInt(impo) + parseInt(hono)+ parseInt(comi);

        $('#total_egresos').val(formatNumber.new(total));
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13)
        document.getElementById("honorarios").focus();
    });

    $('#honorarios').on('keyup', function(e) {
        var fact = $('#facturas').val();
        var comi = $('#comision').val(); 
        var remun = $('#remuneraciones').val();
        var impu = $('#impuestos').val();
        var gast = $('#gastos').val();
        var impo = $('#imposiciones').val();
        var hono = $('#honorarios').val();
        var total = parseInt(fact) + parseInt(remun) + parseInt(impu) + parseInt(gast) + parseInt(impo) + parseInt(hono)+ parseInt(comi);
        
        $('#total_egresos').val(formatNumber.new(total));
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13)
        document.getElementById("gastos").focus();

    });

    $('#gastos').on('keyup', function(e) {
        var fact = $('#facturas').val();
        var comi = $('#comision').val(); 
        var remun = $('#remuneraciones').val();
        var impu = $('#impuestos').val();
        var gast = $('#gastos').val();
        var impo = $('#imposiciones').val();
        var hono = $('#honorarios').val();
        var total = parseInt(fact) + parseInt(remun) + parseInt(impu) + parseInt(gast) + parseInt(impo) + parseInt(hono)+ parseInt(comi);

        $('#total_egresos').val(formatNumber.new(total));
        tecla = (document.all) ? e.keyCode : e.which;
        if (tecla==13)
        document.getElementById("boton").focus();
    });

    //-------------------------------------------
    $('#rut').on('keyup', function() {
        var rutt = $('#rut').val();
        $('#rut2').val(rutt);

    });

    $('#paterno').on('keyup', function() {
        var paternoo = $('#paterno').val();
        $('#paterno2').val(paternoo);

    });

    $('#anno').on('keyup', function() {
        var anoo = $('#anno').val();
        $('#anno2').val(anoo);

    });

    //--------------------------------------

    $('#boton').click(function() {
        var fact = 0;
        var remun = 0;
        var impu = 0;
        var gast = 0;
        var impo = 0;
        var hono = 0;
        var total_egr = 0;
        var caja = 0;
        var transb = 0;
        var junaeb = 0;
        var total_ing = 0;
        var utilidad =0;
        var comi=0;

         fact = $('#facturas').val();
         comi = $('#comision').val(); 
         remun = $('#remuneraciones').val();
         impu = $('#impuestos').val();
         gast = $('#gastos').val();
         impo = $('#imposiciones').val();
         hono = $('#honorarios').val();
         total_egr = parseInt(fact) + parseInt(remun) + parseInt(impu) + parseInt(gast) + parseInt(impo) + parseInt(hono) + parseInt(comi);
         caja = $('#caja').val();
         transb = $('#transbank').val();
         junaeb = $('#junaeb').val();
         total_ing = parseInt(transb) + parseInt(caja) + parseInt(junaeb);
        
        utilidad = parseInt(replaceAll(total_ing, ".", "")) - parseInt(replaceAll(total_egr, ".", ""));
       
         $('#total_utilidad').val(formatNumber.new(utilidad));
    });

    var formatNumber = {

        separador: ".",
        sepDecimal: ",",

        formatear: function(num) {
           
            num += '';
            var splitStr = num.split('.');
            var splitLeft = splitStr[0];
            var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
            var regx = /(\d+)(\d{3})/;
            while (regx.test(splitLeft)) {
                splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
            }
            return this.simbol + splitLeft + splitRight;
        },

        new: function(num, simbol) {
            this.simbol = simbol || '';
            console.log(num);
            return this.formatear(num);
        }
    }

    function replaceAll(text, busca, reemplaza) {
        while (text.toString().indexOf(busca) != -1)
            text = text.toString().replace(busca, reemplaza);
        return text;
    }

    $('.btn-edit').click(function(e) {
        $("#reparticion2").empty();
        var form = $(this).parents('form');
        var url = form.attr('action');

        $.get(url, form.serialize(), function(result) {
            console.log(result.id);
            $('#reparticion2').val(result.reparticion);
            $('#id2').val(result.id);
        });

    });

    $('.btn-cat').click(function(e) {
        $("#name2").empty();
        var form = $(this).parents('form');
        var url = form.attr('action');

        $.get(url, form.serialize(), function(result) {
            console.log(result.id);
            $('#name2').val(result.name);
            $('#idc2').val(result.id);
        });

    });

    $('.btn-edit-beneficio').click(function(e) {
        $("#beneficio2").empty();
        var form = $(this).parents('form');
        var url = form.attr('action');

        $.get(url, form.serialize(), function(result) {

            $('#beneficio2').val(result.beneficio);
            $('#id2').val(result.id);
            if (result.estado == "No vigente") {
                $('#estado2').val('1');
            } else {
                $('#estado2').val('0');
            }

            $('#fecha_entrega2').val(result.fecha_entrega);

        });

    });

    function limpiar_select_ingreso(){
        var option = document.getElementById('id_ingresos2');
        var j=0;
           while(document.getElementById('id_ingresos2').length=0){
              option.remove(j);
              j++;
           }; 
    }

    $('.btn-edit-ingresos').click(function(e) {
        $("#monto2").empty();
        $("#anno2").empty();

        var form = $(this).parents('form');
        var url = form.attr('action');

        $.get(url, form.serialize(), function(result) {
            $('#idIngreso2').val(result.idIngreso2);
            $('#monto2').val(result.monto_ingreso2);
            $('#anno2').val(result.anno_ingreso2);
            $('#fecha2').val(result.fecha_ingreso2);
            limpiar_select_ingreso();
            var select = document.getElementById('id_ingresos2');
               
            for(let i  = 0; i<result.lis_ingresos2.length; i++){
           
             var option = document.createElement("option");
             option.text = result.lis_ingresos2[i].id+') '+result.lis_ingresos2[i].nombre_ingreso;
             option.value = result.lis_ingresos2[i].id;
             select.appendChild(option);
             }

            const tipo_ingreso = document.querySelector('#id_ingresos2');
            tipo_ingreso.value=result.id_ingresos2; 
            tipo_ingreso.options[tipo_ingreso.selectedIndex].defaultSelected = true;
            document.forms[0].reset();
        });

    });

    function limpiar_select_egreso(){
        var option = document.getElementById('id_egresos2');
        var j=0;
           while(document.getElementById('id_egresos2').length=0){
              option.remove(j);
              j++;
           }; 
    }

    $('.btn-edit-egresos').click(function(e) {
        $("#egreso_monto2").empty();
        $("#egreso_anno2").empty();
     
        var form = $(this).parents('form');
        var url = form.attr('action');

        $.get(url, form.serialize(), function(result) {
            $('#idEgreso2').val(result.idEgreso2);
            $('#id_egresos2').val(result.id_egresos2);
            $('#egreso_monto2').val(result.egreso_monto2);
            $('#egreso_anno2').val(result.egreso_anno2);
            $('#egreso_fecha2').val(result.egreso_fecha2);
            console.log(result.egreso_fecha2);
            limpiar_select_egreso();
            var select = document.getElementById('id_egresos2');
           
            for(let i  = 0; i<result.lis_egresos2.length; i++){
           
             var option = document.createElement("option");
             option.text = result.lis_egresos2[i].id+') '+result.lis_egresos2[i].nombre_gasto;
             option.value = result.lis_egresos2[i].id;
             select.appendChild(option);
             }

             const tipo_egreso = document.querySelector('#id_egresos2');
             tipo_egreso.value=result.id_egresos2; 
             tipo_egreso.options[tipo_egreso.selectedIndex].defaultSelected = true;
             document.forms[0].reset();
        });

    });

    $('.btn-banco').click(function(e) {
        $("#nombre_banco2").empty();
        var form = $(this).parents('form');
        var url = form.attr('action');

        $.get(url, form.serialize(), function(result) {
            console.log(result.id);
            $('#nombre_banco2').val(result.name);
            $('#idb2').val(result.id);
        });

    });

    $('.btn-genero').click(function(e) {
        $("#tipo_sexo2").empty();
        var form = $(this).parents('form');
        var url = form.attr('action');

        $.get(url, form.serialize(), function(result) {
            console.log(result.id);
            $('#tipo_sexo2').val(result.name);
            $('#idgenero2').val(result.id);
        });

    });

    $('.btn-edit-cargo').click(function(e) {
        $("#nombre_cargo2").empty();
        var form = $(this).parents('form');
        var url = form.attr('action');

        $.get(url, form.serialize(), function(result) {
            console.log(result.id);
            $('#nombre_cargo2').val(result.nombre_cargo);
            $('#idcargo2').val(result.id);
        });

    });
    
    $('.btn-gasto').click(function(e) {
        $("#nombre_gasto2").empty();
        var form = $(this).parents('form');
        var url = form.attr('action');

        $.get(url, form.serialize(), function(result) {
        
            $('#nombre_gasto2').val(result.nombre_gasto);
            $('#idg2').val(result.id);
        });

    });
    
     $('.btn-ingresos').click(function(e) {
        $("#nombre_ingreso2").empty();
        var form = $(this).parents('form');
        var url = form.attr('action');

        $.get(url, form.serialize(), function(result) {
      
            $('#nombre_ingreso2').val(result.nombre_ingreso);
            $('#idIngreso2').val(result.id);
        });

    });

    $('.btn-prevision').click(function(e) {
        $("#nombre_prevision2").empty();
        var form = $(this).parents('form');
        var url = form.attr('action');

        $.get(url, form.serialize(), function(result) {
     
            $('#nombre_prevision2').val(result.nombre);
            $('#idg2').val(result.id);
        });

    });

    $('.btn-valores').click(function(e) {
        $("#valores2").empty();
        var form = $(this).parents('form');
        var url = form.attr('action');

        $.get(url, form.serialize(), function(result) {
     
            $('#valores2').val(result.valores);
            $('#idvalores2').val(result.id);
        });

    });

    $('.btn-personal').click(function(e) {
        
        var form = $(this).parents('form');
        var url = form.attr('action');
      
        $.get(url, form.serialize(), function(result) {
          
            $('#id2').val(result.id2);
            $('#rut2').val(result.rut2);
            $('#dv2').val(result.dv2);
            $("#nombres2").val(result.nombres2);
            $("#paterno2").val(result.paterno2);
            $("#materno2").val(result.materno2);
            $("#direccion2").val(result.direccion2);
            $("#cod_ciudad2").val(result.cod_ciudad2);
            $("#fecha_nac2").val(result.fecha_nac2);
            $("#fono2").val(result.fono2);
            $("#fono_emergencia2").val(result.fono_emergencia2);
            $("#cantidad_cargas2").val(result.cantidad_cargas2);
            $("#sistema_salud2").val(result.sistema_salud2);
            $("#cod_prevision2").val(result.cod_prevision2);
            $("#estado2").val(result.estado);
            $("#email2").val(result.email2);
                               
            const salud = document.querySelector('#sistema_salud2');
            salud.value=result.n_salud; 
            salud.options[salud.selectedIndex].defaultSelected = true;

            const vigencias = document.querySelector('#estado2');
            vigencias.value=result.n_estado; 
            vigencias.options[vigencias.selectedIndex].defaultSelected = true; // Add Attribute selected to Option Element
            
            document.forms[0].reset();

        });

    });

   
    
    $('#tablaInversiones tbody').on( 'click', '.btn-inversion', function (e) {
     
        $("#nombre_inversion_edit").empty();
        $("#monto_inversion_edit").empty();
        $("#num_documento_edit").empty();
        $("#anno_edit").empty();
        const id=$(this).data("id");
        var url='inversion/editar/'+id;
       
        $.get(url, function(result) {
            $('#idInversion2').val(result.idInversion2);
            $('#nombre_inversion_edit').val(result.nombre_inversion_edit);
            $("#monto_inversion_edit").val(result.monto_inversion_edit);
            $("#fecha_inversion_edit").val(result.fecha_inversion_edit);
            $("#num_documento_edit").val(result.num_documento_edit);
            $("#anno_edit").val(result.anno_edit);
                                 
            const documento = document.querySelector('#documento_edit');
            documento.value=result.tipo_documento; 
            documento.options[documento.selectedIndex].defaultSelected = true;
             document.forms[0].reset();

        });

    });

        $('.ver_video').click(function(e) {

        var form = $(this).parents('form');
        var url = form.attr('action');
      
        $.get(url, form.serialize(), function(result) {
     
            var insertar = '<video controls class="alto-ancho" id="video" >Su Navegador no soportado' +
                '<source id="videosource" src =' + result.ruta + ' type="video/mp4"></video>';
            $('h6').text(result.nombre);
            $('#agregarvideo').html(insertar);

        });
    });
    $('#cerrarv').click(function() {
        $('#video').remove();
    });

    $(document).on("change", ".email_archivo", function(e) {

        var divresul = "texto_notificacion";
        var nombre = $('.email_archivo').val();
        nombre = nombre.split('\\');
        nombrefile = nombre[nombre.length - 1];

        var codigo = '<div class="mailbox-attachment-info"><i class="fa fa-paperclip"></i>' + nombrefile + '<span class="mailbox-attachment-size"> </span></div>';
        $("#" + divresul + "").html(codigo);

    });

    $('.galeriamodal').click(function(e) {

        var img = e.target.src;
        var modalventana = '<div class="modalv" id="modalv"><img src="' + img + '" class="modal_img"><div id="cerrar" class="modal__boton">X</div></div>';
        $('body').append(modalventana);
        $('#cerrar').click(function() {
            $('#modalv').remove();
        });

    });

    $(document).keyup(function(e) {
        if (e.which == 27) {
            $('#modalv').remove();
        }
    })

    jQuery(document).ready(function() {
        const ratingSelector = jQuery('#list_rating');
        ratingSelector.find('li').on('click', function () {
            const number = $(this).data('number');
            $("#rating_form").find('input[name=rating_input]').val(number);
            ratingSelector.find('li i').removeClass('yellow').each(function(index) {
                if ((index + 1) <= number) {
                    $(this).addClass('yellow');
                }
            })
        })
    });

    function ver_descripcion(row) {
        $("#descripciones").empty();
        var tablaDatos=$("#descripciones");
        tablaDatos.append("<p class="+"text-uppercase font-weight-bold"+">"+row+"</<p>");
     }

     function ver_causal(row) {
        $("#causal_finiquito").empty();
        var tablaDatos=$("#causal_finiquito");
        tablaDatos.append("<p class="+"text-uppercase font-weight-bold"+">"+row+"</<p>");
     }
    
    $('#tabla-contratos tbody').on( 'click', '.ver_descripcion', function (e) {
        e.preventDefault();
        const row =$(this).data("row");
        ver_descripcion(row);
     } );

     $('#tabla-finiquitos tbody').on( 'click', '.ver_causal', function (e) {
        e.preventDefault();
        const row =$(this).data("row");
        ver_causal(row);
     } );

         function cargar(rut){
        var form=$('#form-buscar') 
        var url=form.attr('action').replace(':RUT_ID',rut);
        var data=form.serialize();
        $("#dv").empty(); 
        $("#nombres").empty();
        $("#paterno").empty();
        $("#materno").empty();
        $.get(url, data, function(result) {
            $('#dv').val(result.dv);
            $("#nombres").val(result.nombres);
            $("#paterno").val(result.paterno);
            $("#materno").val(result.materno);
            var fullnombres=result.nombres+" "+result.paterno+" "+result.materno;
            $('#nombre_full').val(fullnombres);
         });
    }
      
    $('#rut-select').on( 'change', function (e) {
        e.preventDefault();
       const rut=$('#rut-select').val();
       cargar(rut);
     } );

    function cargar2(rut){
        var form=$('#form-buscar') 
        var url=form.attr('action').replace(':RUT_ID',rut);
        var data=form.serialize();
        $("#dv").empty(); 
        $("#nombres").empty();
        $("#paterno").empty();
        $("#materno").empty();
        $.get(url, data, function(result) {
        
            $('#dv').val(result.dv);
            $("#nombres").val(result.nombres);
            $("#paterno").val(result.paterno);
            $("#materno").val(result.materno);
      
            var select = document.getElementById('id_contrato');
               console.log(result.contrato);
               if (result.contrato.length==0) {
                 alert("No existen contratos asociados a este Rut");
               }      
               for(let i  = 0; i<result.contrato.length; i++){
              
                var option = document.createElement("option");
                option.text = result.contrato[i].id+') '+result.contrato[i].tipo_contrato+'  - '+result.contrato[i].fecha_inicio;
                option.value = result.contrato[i].id;
                select.appendChild(option);
                }
         });
    }

    function limpiar_select(){
        var option = document.getElementById('id_contrato');
        var j=0;
           while(document.getElementById('id_contrato').length=0){
              option.remove(j);
              j++;
           }; 
    }

    $('#rut-select2').on( 'change', function (e) {
       e.preventDefault();
       const rut=$('#rut-select2').val();
       limpiar_select();
       cargar2(rut);
     } );

     $('.sumar-finiquito').click(function() {
        var total_sueldo =0; 
        var indemnizacion = 0;
        var desahucio = 0;
        var adicional = 0;
        var proporcional = 0;
        var total = 0;
        total_sueldo =$('#total_sueldo').val();
        indemnizacion = $('#indemnizacion_annos').val();
        desahucio = $('#desahucio').val();
        adicional = $('#finiquito_adicional').val();
        proporcional = $('#feriado_proporcional').val();
        total = parseInt(total_sueldo) + parseInt(indemnizacion) + parseInt(desahucio) + parseInt(adicional)+ parseInt(proporcional);
         $('#total_finiquito').val(total);
         $('#total_finiquito2').val(formatNumber.new(total));
    });


     $('.btn-contrato').click(function() {
       
        $("#rut3").empty();  
        $("#dv3").empty(); 
        $("#nombres3").empty();
        $("#paterno3").empty();
        $("#materno3").empty();
        $("#fecha_inicio3").empty();
        $("#fecha_termino3").empty();
        $("#descripcion3").empty();
       
        var form = $(this).parents('form');
        var url = form.attr('action');
      
        $.get(url, form.serialize(), function(resultado) {
      
            $('#id3').val(resultado.id3);
            $("#rut3").val(resultado.rut3); 
            $("#dv3").val(resultado.dv3);
            $("#nombres3").val(resultado.nombres3);
            $("#paterno3").val(resultado.paterno3);
            $("#materno3").val(resultado.materno3);
            $("#fecha_inicio3").val(resultado.fecha_inicio3);
            $("#fecha_termino3").val(resultado.fecha_termino3);
            $("#descripcion3").val(resultado.descripcion3);
            
            const tipo_c = document.querySelector('#tipo_contrato3');
            tipo_c.value=resultado.t_contrato; 
            tipo_c.options[tipo_c.selectedIndex].defaultSelected = true; // Add Attribute selected to Option Element
            
            const tipo_clase_contrato = document.querySelector('#clase_contrato3');
            tipo_clase_contrato.value=resultado.clase_contrato3; 
            tipo_clase_contrato.options[tipo_clase_contrato.selectedIndex].defaultSelected = true;

            const tipo_jornada = document.querySelector('#jornada3');
            tipo_jornada.value=resultado.jornada3; 
            tipo_jornada.options[tipo_jornada.selectedIndex].defaultSelected = true;

            document.forms[0].reset();

        });

    });
      
    $('.btn-finiquito_edit').click(function() {
   
        $("#rut_edit").empty();  
        $("#dv_edit").empty(); 
        $("#nombres_edit").empty();
        $("#fecha_edit").empty();
        $("#total_sueldo_edit").empty();
        $("#indemnizacion_annos_edit").empty();
        $("#desahucio_edit").empty();
        $("#feriado_proporcional_edit").empty();
        $("#finiquito_adicional_edit").empty();
        $("#total_finiquito_edit").empty();
        $("#causal_edit").empty();
       
        var form = $(this).parents('form');
        var url = form.attr('action');
      
        $.get(url, form.serialize(), function(resultado) {
     
            $('#id_edit').val(resultado.id_edit);
            $("#rut_edit").val(resultado.rut_edit); 
            $("#dv_edit").val(resultado.dv_edit);
            $("#nombres_edit").val(resultado.nombres_edit);
            $("#fecha_edit").val(resultado.fecha_edit);
            $("#total_sueldo_edit").val(resultado.total_sueldo_edit);
            $("#indemnizacion_annos_edit").val(resultado.indemnizacion_annos_edit);
            $("#desahucio_edit").val(resultado.desahucio_edit);
            $("#feriado_proporcional_edit").val(resultado.feriado_proporcional_edit);
            $("#finiquito_adicional_edit").val(resultado.finiquito_adicional_edit);
            $("#total_finiquito_edit2").val(resultado.total_finiquito_edit);
            $("#total_finiquito_edit").val(resultado.total_finiquito_edit);
            $("#causal_edit").val(resultado.causal_edit);
        });
    
});

$('.btn-feriados').click(function(){
    $("#rutferiado").empty();  
    $("#dvferiado").empty(); 
    $("#nombresferiado").empty();
    $("#fecha_inicio_feriado").empty();
    $("#fecha_termino_feriado").empty();
    $("#cantidad_dias_feriado").empty();
  
    var form = $(this).parents('form');
    var url = form.attr('action');
  
    $.get(url, form.serialize(), function(resultado) {
 
        $('#idferiado').val(resultado.idferiado);
        $("#rutferiado").val(resultado.rutferiado); 
        $("#dvferiado").val(resultado.dvferiado);
        $("#nombresferiado").val(resultado.nombresferiado);
        $("#fecha_inicio_feriado").val(resultado.fecha_inicio_feriado);
        $("#fecha_termino_feriado").val(resultado.fecha_termino_feriado);
        $("#cantidad_dias_feriado").val(resultado.cantidad_dias_feriado);
       
    });
});

$('.sumar-finiquito_edit').click(function() {
    var total_sueldo = 0;
    var indemnizacion = 0;
    var desahucio = 0;
    var adicional = 0;
    var proporcional = 0;
    var total = 0;
    total_sueldo = $('#total_sueldo_edit').val();
    indemnizacion = $('#indemnizacion_annos_edit').val();
    desahucio = $('#desahucio_edit').val();
    adicional = $('#finiquito_adicional_edit').val();
    proporcional = $('#feriado_proporcional_edit').val();
    total =parseInt(total_sueldo) + parseInt(indemnizacion) + parseInt(desahucio) + parseInt(adicional)+ parseInt(proporcional);
     $('#total_finiquito_edit').val(total);
     $('#total_finiquito_edit2').val(formatNumber.new(total));
});

$('.calcular_dias').click(function() {
   
    var aFecha1 = $('#fecha_inicio').val().split('-');
    var aFecha2 = $('#fecha_termino').val().split('-');
    var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]);
    var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]);
    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
    var dias=dias+1;
    var start=$('#fecha_inicio').val();
    var end=$('#fecha_termino').val();
    var total_fin_semana=dateDifference(start, end);
    var total_dias=dias-total_fin_semana;
    $('#cantidad_dias').val(total_dias);
});

$('.calcular_dias_update').click(function() {
   
    var aFecha1 = $('#fecha_inicio_feriado').val().split('-');
    var aFecha2 = $('#fecha_termino_feriado').val().split('-');
    var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,aFecha1[2]);
    var fFecha2 = Date.UTC(aFecha2[0],aFecha2[1]-1,aFecha2[2]);
    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
    var dias=dias+1;
    var start=$('#fecha_inicio_feriado').val();
    var end=$('#fecha_termino_feriado').val();
    var total_fin_semana=dateDifference(start, end);
    var total_dias=dias-total_fin_semana;
    $('#cantidad_dias_feriado').val(total_dias);
});

function dateDifference(start, end) {

    // Copy date objects so don't modify originals
     
    var s = new Date(start);
    var e = new Date(end);
    s.setMinutes(s.getMinutes() + s.getTimezoneOffset());
    e.setMinutes(e.getMinutes() + e.getTimezoneOffset());
    
    var addOneMoreDay = 0;
      if( s.getDay() == 0 || s.getDay() == 6 ) {
        addOneMoreDay = 1;
    }
    
    // Configure la hora al mediodía para evitar el horario de verano y las peculiaridades del navegador
    s.setHours(12,0,0,0);
    e.setHours(12,0,0,0);
  
    // Obtén la diferencia en días enteros
    var totalDays = Math.round((e - s) / 8.64e7);
  
    // Obtén la diferencia en semanas enteras
    var wholeWeeks = totalDays / 7 | 0;
  
    // Estime los días hábiles como la cantidad de semanas completas * 5
    var days = wholeWeeks * 5;
  
    // Si no es el número de semanas, calcula los días restantes del fin de semana
    if (totalDays % 7) {
      s.setDate(s.getDate() + wholeWeeks * 7);
  
      while (s < e) {
        s.setDate(s.getDate() + 1);
  
        // Si el día no es domingo ni sábado, agréguelo a los días hábiles
        if (s.getDay() != 0 && s.getDay() != 6) {
          ++days;
        }
        //s.setDate(s.getDate() + 1);
      }
    }
    var weekEndDays = totalDays - days + addOneMoreDay;
   
    return weekEndDays;
  }
  
  $('.valida-rut').on( 'change', function (e) {
    var M=0,S=1;
    var T=$('.valida-rut').val();
    for(;T;T=Math.floor(T/10))
        S=(S+T%10*(9-M++%6))%11;
   
    var dv=S?S-1:'k'; 
    $('#dv').val(dv);   
  
     } );


});

