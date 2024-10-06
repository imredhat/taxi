    $(document).ready(function() {
        window.formatPersian  = false;

        $(".pdate").persianDatepicker({
            observer: true,
            format: 'YYYY/MM/DD',
            formatter: function(d){
                window.formatPersian = false;
                var d = new persianDate([d]);
                return d.format();
            },
            autoClose: true
        });

        window.formatPersian  = false;

    });
