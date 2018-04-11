<script type="text/javascript">
    $(function(){
        $('.select2').select2({
            theme: "bootstrap"
        });

        $( ".datepicker" ).datepicker({
            dateFormat: "dd/mm/yy",
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior',
            changeMonth: true,
            changeYear: true,
            yearRange: "-110:+15",
            //minDate: '0'
        });

        tinymce.init({
            selector: '.text_advanced',
            plugins: "code, link",
            extended_valid_elements: "a[name|href|target|title|alt|onclick|javascript|class]",
            allow_script_urls: true,
            convert_urls: false
        });
    });
</script>