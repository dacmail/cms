$(document).ready(function() {

    $('.collapse-block').collapse({
        toggle: false
    });

    var calendar = $('#calendar');

    calendar.fullCalendar({
        events: {
            url: calendar.data('url')
        },
        eventClick: function (calEvent, jsEvent, view) {
            var modal = $('.modalCalendar').modal();

            modal.on('shown.bs.modal', function () {

                var start, end, description;

                if (calEvent.start == null) {
                    start = '-';
                } else {
                    start = moment(calEvent.start).format('hh:mm[h] [-] dddd D, MMMM YYYY');
                }

                if (calEvent.end == null) {
                    end = '-';
                } else {
                    end = moment(calEvent.end).format('hh:mm[h] [-] dddd D, MMMM YYYY');
                }

                if (calEvent.description == null) {
                    description = '-';
                } else {
                    description = calEvent.description;
                }

                if (calEvent.event_url == null) {
                    $(this).find('.go-to-event').hide();
                } else {
                    $(this).find('.go-to-event').show().attr('href', calEvent.event_url);
                }

                if (calEvent.edit_url !== null) {
                    $(this).find('.edit-event').removeClass('hide');
                    $(this).find('.edit-event').attr('href', calEvent.edit_url);
                } else {
                    $(this).find('.edit-event').addClass('hide');
                }

                if  (calEvent.delete_url !== null) {
                    $(this).find('.delete-event').removeClass('hide');
                    $(this).find('.delete-event').attr('href', calEvent.delete_url);
                } else {
                    $(this).find('.delete-event').addClass('hide');
                }

                $(this).find('.modal-header h4').html(calEvent.title);

                if (typeof calEvent.treatment === 'object') {
                    $(this).find('.modal-body').html(
                        '<p><strong>Tipo:</strong> ' + calEvent.type +
                        '<p><strong>Fecha de inicio:</strong> ' + start +
                        '<p><strong>Fecha de fin:</strong> ' + end +
                        '<p><strong>Tratamiento:</strong><br>' +
                            'Coste: ' + calEvent.treatment.cost + '€<br>' +
                            'Medicina: ' + calEvent.treatment.medicine + '<br>' +
                            'Número de tratamientos: ' + calEvent.treatment.number + '<br>' +
                            'Aplicar cada: ' + calEvent.treatment.each + ' ' + calEvent.treatment.time + '<br>' +
                        '</p>' +
                        '<p><strong>Descripción:</strong></p>' + description
                );
                } else {
                    $(this).find('.modal-body').html(
                        '<p><strong>Tipo:</strong> ' + calEvent.type +
                        '<p><strong>Fecha de inicio:</strong> ' + start +
                        '<p><strong>Fecha de fin:</strong> ' + end +
                        '<p><strong>Descripción:</strong></p>' + description
                    );
                }
            });
        },
        locale: 'es',
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'agendaDay agendaWeek month listMonth'
        },
        views: {
            month: {
                eventLimit: 7
            }
        },
        defaultView: 'month'
    });

    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover({
        html: true
    });

    $('.confirm').confirm({
        title: 'Confirma la acción',
        text: '¿Estás seguro de que quieres continuar?',
        confirmButton: 'Continuar',
        cancelButton: 'Cancelar',
        confirmButtonClass: 'btn-success',
        cancelButtonClass: 'pull-left btn-danger'
    });

    $('.confirm-custom').confirm({
        confirmButton: 'Continuar',
        cancelButton: 'Cancelar',
        confirmButtonClass: 'btn-success',
        cancelButtonClass: 'pull-left btn-danger'
    });

    $('.datetimerange').daterangepicker({
        autoUpdateInput: false,
        autoApply: true,
        locale: {
            format: 'DD/MM/YYYY',
            separator: '-',
            applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar',
            fromLabel: 'Desde',
            toLabel: 'A',
            customRangeLabel: 'Personalizado',
            weekLabel: 'S',
            daysOfWeek: [
                'Do',
                'Lu',
                'Ma',
                'Mi',
                'Ju',
                'Vi',
                'Sa'
            ],
            monthNames: [
                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ],
            firstDay: 1
        }
    });

    $('.lightbox-image').magnificPopup({type:'image'});

    $('.datetimerange').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });

    $('.datetimerange').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('.colorpicker').colorpicker({
        align: 'left',
        format: 'hex'
    });

    /**
     * Widgets
     */
    $('#add-widget-link').on('click', function() {
        var total_links = $('.form-widget tbody tr').length;

        $('.form-widget tbody').append(
            $('<tr>' +
                '<td><input name="links[' + total_links + '][title]" class="form-control" required value=""></td>' +
                '<td><input name="links[' + total_links + '][link]" class="form-control" required value=""></td>' +
                '<td>' +
                '<button type="button" class="btn btn-danger pull-right delete-tr"><i class="fa fa-trash-o"></i></button>' +
                '<button type="button" class="btn btn-default pull-right down-tr"><i class="fa fa-arrow-down"></i></button>' +
                '<button type="button" class="btn btn-default pull-right up-tr"><i class="fa fa-arrow-up"></i></button>' +
                '</td>' +
                '<tr>')
        );
    });

    $(document).on('click', '.up-tr', function(e) {
        e.preventDefault();
        $(this).closest('tr').insertBefore($(this).closest('tr').prev());
    });

    $(document).on('click', '.down-tr', function(e) {
        e.preventDefault();
        $(this).closest('tr').insertAfter($(this).closest('tr').next());
    });

    $(document).on('click', '.delete-tr', function() {
        var vm = $(this);
        $.confirm({
            title: 'Confirma la acción',
            text: '¿Estás seguro de que quieres continuar?',
            confirmButton: 'Continuar',
            cancelButton: 'Cancelar',
            confirmButtonClass: 'btn-success',
            cancelButtonClass: 'pull-left btn-danger',
            confirm: function () {
                vm.closest('tr').fadeOut(300, function () {
                    vm.closest('tr').remove();
                });
            }
        });
    });
});

tinymce.init({
    selector: 'textarea.tinymce',
    height: '350px',
    language: 'es',
    plugins: [
    'advlist autolink lists link charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern'
    ],
    toolbar: "insertfile undo redo | styleselect fontselect fontsizeselect forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link code"
});

var editor_config = {
    path_absolute : '/',
    height: '350px',
    language: 'es',
    selector: 'textarea.tinymce-upload',
    plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern'
    ],
    toolbar: "insertfile undo redo | styleselect fontselect fontsizeselect forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media code",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
          var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
          var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

          var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
          if (type == 'image') {
            cmsURL = cmsURL + '&type=Images';
        } else {
            cmsURL = cmsURL + '&type=Files';
        }

        tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : 'yes',
            close_previous : 'no'
        });
    }
};

tinymce.init(editor_config);

jQuery.datetimepicker.setLocale('es');

jQuery('.datetimepicker').datetimepicker({
    format: 'd-m-Y H:i:s',
    inline: true,
    startDate: this.value,
    scrollMonth: false,
    scrollInput: false,
    scrollTime: false
});

jQuery('.datetimepicker-not-inline').datetimepicker({
    format: 'd-m-Y H:i',
    timepicker: true,
    scrollMonth: false,
    scrollInput: false,
    scrollTime: false
});

jQuery('.datetime').datetimepicker({
    format: 'd-m-Y',
    inline: true,
    startDate: this.value,
    timepicker: false,
    scrollMonth: false,
    scrollInput: false,
    scrollTime: false
});

jQuery('.datetime-not-inline').datetimepicker({
    format: 'd-m-Y',
    timepicker: false,
    scrollMonth: false,
    scrollInput: false,
    scrollTime: false
});

Dropzone.autoDiscover = false;
if ($('#animalsDropzone').length) {
    var animalsDropzone = new Dropzone('#animalsDropzone', {
        paramName: 'photos',
        maxFilesize: 10,
        clickable: true,
        uploadMultiple: true,
        parallelUploads: 1,
        createImageThumbnails: false,
        previewTemplate: document.getElementById('dz-preview').innerHTML,
        acceptedFiles: 'image/*',
        dictDefaultMessage: 'Arrastre o haga clic aquí para seleccionar las fotos a subir',
        dictFallbackMessage: 'Tu navegador no soporta la subida de archivos, por favor, utilice uno más moderno',
        dictInvalidFileType: 'El tipo de archivo que está subiendo no es correcto',
        dictFileTooBig: 'El tamaño del archivo ({{filesize}} mb) sobrepasa el límite ({{maxFilesize}} mb)',
        dictResponseError: 'Ha ocurrido un error al subir la foto. Vuelva a intentarlo y si persiste, contacte con un administrador.',
        dictMaxFilesExceeded: 'Se ha excedido del máximo de fotos'
    });

    animalsDropzone.on('successmultiple', function (file, response) {
        var photos = response.photos;
        $('.animal-not-photos').fadeOut();
        var div = $('.photos-gallery');

        for (i = 0; i < photos.length; i++) {
            var html = '<div class="photo col-lg-2 col-sm-3">' +
                '<div class="thumbnail">' +
                    '<a href="' + photos[i].url + '"><img src="' + photos[i].url + '" class="img-responsive" alt=""></a>' +
                    '<div class="caption">' +
                        '<a href="' + photos[i].main_url + '" class="btn btn-primary" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Seleccionar foto como principal"><i class="fa fa-file-image-o"></i></a>' +
                        '<a href="' + photos[i].delete_url + '" class="btn btn-danger pull-right confirm" title="Eliminar foto"><i class="fa fa-trash"></i></a>' +
                    '<div class="clearfix"></div>' +
                    '</div>' +
                '</div>' +
            '</div>';

            $(html).hide().appendTo(div).fadeIn(500);

            if (i == 0 && $('.photos-gallery .photo').length == 1) {
                $('.animalmenu-photo').attr('src', photos[i].url);
            }
        }

        noty({
            layout: 'topRight',
            theme: 'relax', // or 'relax'
            type: 'success',
            text: 'Fotos añadidas a la ficha correctamente', // can be html or string
            dismissQueue: false, // If you want to use queue feature set this true
            template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
            animation: {
                open: 'animated fadeIn', // or Animate.css class names like: 'animated bounceInLeft'
                close: 'animated fadeOut', // or Animate.css class names like: 'animated bounceOutLeft'
                easing: 'swing',
                speed: 500 // opening & closing animation speed
            },
            timeout: 5000, // delay for closing event. Set false for sticky notifications
            force: false, // adds notification to the beginning of queue when set to true
            modal: false,
            maxVisible: 5, // you can set max visible notification for dismissQueue true option,
            killer: true, // for close all notifications before show
            closeWith: ['click'], // ['click', 'button', 'hover', 'backdrop'] // backdrop click will close all notifications
            buttons: false // an array of buttons
        });

        $('.dz-progress.dz-success').delay(2000).fadeOut();
    });

    animalsDropzone.on('error', function (event, error, request) {
        noty({
            layout: 'topRight',
            theme: 'relax', // or 'relax'
            type: 'error',
            text: error, // can be html or string
            dismissQueue: false, // If you want to use queue feature set this true
            template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
            animation: {
                open: 'animated fadeIn', // or Animate.css class names like: 'animated bounceInLeft'
                close: 'animated fadeOut', // or Animate.css class names like: 'animated bounceOutLeft'
                easing: 'swing',
                speed: 500 // opening & closing animation speed
            },
            timeout: 5000, // delay for closing event. Set false for sticky notifications
            force: false, // adds notification to the beginning of queue when set to true
            modal: false,
            maxVisible: 5, // you can set max visible notification for dismissQueue true option,
            killer: true, // for close all notifications before show
            closeWith: ['click'], // ['click', 'button', 'hover', 'backdrop'] // backdrop click will close all notifications
            buttons: false // an array of buttons
        });

        $('.dz-progress.dz-error').delay(2000).fadeOut();
    });
}

// Animals
$('.animal-status').on('change', function() {
    $('#adopter-form').fadeOut();
    $('#reservation-form').fadeOut();
    $('#lost-form').fadeOut();
    $('#found-form').fadeOut();

    if ($('.animal-status option:selected').val() === 'adopted') {
        $('#adopter-form').fadeIn();
    } else if ($('.animal-status option:selected').val() === 'reserved') {
        $('#reservation-form').fadeIn();
    } else if ($('.animal-status option:selected').val() === 'lost') {
        $('#lost-form').fadeIn();
    } else if ($('.animal-status option:selected').val() === 'found') {
        $('#found-form').fadeIn();
    }
});

$('.animal-location').on('change', function() {
    $('#temporary-shelter-form').fadeOut();
    $('#street-form').fadeOut();
    $('#animal-home-form').fadeOut();

    if ($('.animal-location option:selected').val() === 'temporary_home') {
        $('#temporary-shelter-form').fadeIn();
    } else if ($('.animal-location option:selected').val() === 'street') {
        $('#street-form').fadeIn();
    } else if ($('.animal-location option:selected').val() === 'animal_home') {
        $('#animal-home-form').fadeIn();
    }
});

$('.animal-health-treatment').on('change', function() {
    $('#animal-health-treatment-form').fadeOut();
    $('#animal-health-test-form').fadeOut();

    if ($('.animal-health-treatment option:selected').val() === 'treatment') {
        $('#animal-health-treatment-form').fadeIn();
    } else if ($('.animal-health-treatment option:selected').val() === 'test') {
        $('#animal-health-test-form').fadeIn();
    }
});

$('.select-country').on('change', function() {

    var country = $('.select-country option:selected').val();

    $('.select-city').find('option').remove();
    $('.select-city').prop('disabled', true);
    $('.select-city').append($('<option>', {
        value: '',
        text: 'Debes seleccionar un estado',
        disabled: true,
        selected: true
    }));
    $('.select-state').find('option').remove();
    $('.select-state').prop('disabled', false);

    $('.select-state').append($('<option>', {
        value: '',
        text: 'Seleccione un estado',
        disabled: true,
        selected: true
    }));

    $.ajax({
        url: '/api/location/countries/' + country + '/states'
    }).done(function(data) {
        $.each(data, function (i, state) {
            $('.select-state').append($('<option>', {
                value: state.id,
                text: state.name
            }));
        });
    });

});

$('.select-state').on('change', function() {

    var state = $('.select-state option:selected').val();

    if (state == '') {
        $('.select-state option:selected').prop('disabled', true);
        $('.select-city').find('option').remove();
        $('.select-city').prop('disabled', true);
        $('.select-city').append($('<option>', {
            value: '',
            text: 'Debes seleccionar un estado',
            disabled: true,
            selected: true
        }));
    } else {
        $.ajax({
            url: '/api/location/states/' + state + '/cities'
        }).done(function (data) {
            $('.select-city').find('option').remove();
            $('.select-city').prop('disabled', false);
            $('.select-city').append($('<option>', {
                value: '',
                text: 'Seleccione una ciudad',
                disabled: true,
                selected: true
            }));
            $.each(data, function (i, state) {
                $('.select-city').append($('<option>', {
                    value: state.id,
                    text: state.name
                }));
            });
        });
    }

});

$('.select-city').on('change', function() {

    var city = $('.select-city option:selected').val();

    if (city == '') {
        $('.select-city option:selected').prop('disabled', true);
    }
});