<!DOCTYPE html>
<html lang="es">
    <head>
        <title>{$title}</title>
        <link rel="stylesheet" type="text/css" 
              href="css/themes/default/easyui.css" />
        <script src="js/jquery.js"></script>
        <script src="js/jquery.easyui.min.js"></script>
        <script type="text/javascript">

            var data = {$data};
            {literal}
                $(document).ready(function () {
                    $('#cbListaDiasFestivosDB').combobox({
                        valueField: 'id_festivo',
                        textField: 'fecha',
                        url: 'festivos/listardb'
                    });
                    $('#cbListaDiasFestivosIny').combobox({
                        valueField: 'label',
                        textField: 'value',
                        data: data
                    });
                    $('#cbListaDiasFestivos').combobox({
                        valueField: 'label',
                        textField: 'value',
                        /* Primer URL Controlada */
                        url: 'festivos/listar'
                                /* segunda archivo */
                                //url: 'data_combo.json'
                                /* Tercera Inyeccion */
                                /*data: [{
                                 label: 'java',
                                 value: 'Java'}, {
                                 label: 'perl',
                                 value: 'Perl'}, {
                                 label: 'ruby',
                                 value: 'Ruby'}]*/
                    });
                });
            {/literal}
        </script>
    </head>
    <body>
        <h1>HolaMundo</h1>
        <h3>ComboList</h3>
        <!-- Shift + Alt + f -->
        <select id="cc" class="easyui-combobox" name="dept" style="width:200px;">
            <option value="aa">aitem1</option>
            <option>bitem2</option>
            <option>bitem3</option>
            <option>ditem4</option>
            <option>eitem5</option>
        </select>
        <!--        
            int : Intero
            str  : String
            flt : Float
            bol : Boolean
        -->
        <h1>Necesitada</h1>
        <input type="text" id="cbListaDiasFestivos" />
        <h1>Curiosos</h1>
        <input type="text" id="cbListaDiasFestivosDB" />
        <h1>Confianzas</h1>
        <input type="text" id="cbListaDiasFestivosIny" />
    </body>
</html>
