<script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>
<script async="async" src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'GA_MEASUREMENT_ID');

    // options for dataTable
    let lengthMenu;
    @if (auth()->check() && in_array(auth()->user()->type, ['ADMIN']))
        lengthMenu = [
            [5, 10, 25, 50, 200, 400, 1000, 2000, -1],
            [5, 10, 25, 50, 200, 400, 1000, 2000, 'All']
        ];
    @else
        lengthMenu = [10, 25, 50, 75, 100];
    @endif

    var options = {
        searching: true,
        processing: true,
        serverSide: true,
        bLengthChange: true,
        searchDelay: 100,
        responsive: true,
        lengthMenu: lengthMenu,
        pageLength: 25,
        language: {
            url: "{!! __('admin.datatable') !!}"
        },
        preDrawCallback: function(settings) {},
        rowCallback: function(row, data) {
            if (data["deleted_at"]) {
                $(row).css({
                    'opacity': '.7',
                    'background-color': "rgb(145 72 128 / 25%)"
                });
            }
        },
    };

    // Buttons Actions In DataTable
    function dataTableActions(data, type, row, meta) {
        var actions = '<span class="d-inline-flex element-icon">';
        row.actions.forEach(math => {
            if (math.type == 'icon' && ['PUT', 'POST', 'DELETE'].includes(math.method)) {
                let method = math.method;
                actions += `<a href="javascript:;"
                               onclick="Confirmation('#delete_${math.action}_${math.id}')"
                               id="${math.id}"
                               class="${math.class} mx-1"
                               title="${math.label}">
                              <i class="${math.icon}"></i>
                            </a>`;

                actions += `<form
                                id="delete_${math.action}_${math.id}"
                                onsubmit="OnSubmit(event);"
                                method="POST"
                                action="${math.link}"
                                style="display: none;">
                                @csrf
                                @method('${method}')
                            </form>`;
            } else {
                actions += `<a
                                href="${math.link}"
                                id="${math.id}"
                                class="${math.class} mx-1"
                                title="${math.label}">
                                <i class="${math.icon}"></i>
                            </a>`;
            }
            actions += '</span>';
        });
        return actions;
    }

    function Confirmation(subm) {
        $(subm).submit();
    }

    function OnSubmit(event, alert_with_action = true) {
        let form = $(event.target),
            data = new FormData(),
            url = form.attr('action'),
            method = form.attr('method');

        var files = form.find('[type=file]');

        $.each(files, function(key, input) {

            if (input.files[0] != undefined) {
                data.append(input.name, input.files[0]);
            }
        });

        $.each(form.serializeArray(), function(key, input) {
            data.append(input.name, input.value);
        });

        if (alert_with_action) {
            AlertWithAction(event, data, method, url, load = false);
        } else {
            event.preventDefault();
            event.stopPropagation();
            $.ajax({
                data: data,
                url: url,
                type: method,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.message == "fail") {
                        var errorMessages = document.querySelectorAll('.error-message');
                        errorMessages.forEach(function(errorMessage) {
                            errorMessage.remove();
                        });
                        Object.keys(data.errors).forEach((inputName, message) => {



                            const Input = document.querySelector(
                                `input[name="${inputName}"]`);
                            const errorSpan = document.createElement('span');
                            errorSpan.className = 'error-message';
                            if (data.errors.hasOwnProperty(inputName)) {
                                errorSpan.textContent = data.errors[inputName];
                            }
                            Input.parentNode.insertBefore(errorSpan, Input.nextSibling);
                        });
                    }

                    if (data.redirect_url) {
                        window.location = data.redirect_url;
                    }
                    if ($('.data-table').length) {
                        $('.data-table').DataTable().ajax.reload();
                    }
                    // _toastr(data.type, data.title, data.description)
                },
                error: function(error) {
                    console.log(error);
                    // _toastr('error', error.responseJSON.message, error.responseJSON.message)
                }
            });
        }
    }

    $('.remove-image').hide();

    function readURL(input, prifex) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                if (prifex) {
                    $(`.remove-image-${prifex}`).show();
                    $(`.image-upload-wrap-${prifex}`).hide();
                    $(`.file-upload-image-${prifex}`).attr('src', e.target.result);
                    $(`.file-upload-content-${prifex}`).show();
                    $(`.file-upload-btn-${prifex}`).html('{!! __('admin.edit_image') !!}');
                } else {
                    $('.remove-image').show();
                    $('.image-upload-wrap').hide();
                    $('.file-upload-image').attr('src', e.target.result);
                    $('.file-upload-content').show();
                    $('.file-upload-btn').html('{!! __('admin.edit_image') !!}');
                }
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            removeUpload(prifex);
        }
    }

    function removeUpload(prifex) {
        if (prifex) {
            $(`.file-upload-input-${prifex}`).replaceWith($(`.file-upload-input-${prifex}`).clone());
            $(`.file-upload-content-${prifex}`).hide();
            $(`.image-upload-wrap-${prifex}`).show();
            $(`.remove-image-${prifex}`).hide();
            $(`.file-upload-btn-${prifex}`).html('{!! __('admin.add_image') !!}');
        } else {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
            $('.remove-image').hide();
            $('.file-upload-btn').html('{!! __('admin.add_image') !!}');
        }
    }

    $('.image-upload-wrap').bind('dragover', function() {
        $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function() {
        $('.image-upload-wrap').removeClass('image-dropping');
    });
</script>
