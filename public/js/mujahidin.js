$.fn.dataTable.ext.buttons.reload = {
    text: 'Reload',
    className: 'reload',
    action: function(e, dt, node, config) {
        dt.ajax.reload();
    }
};
$(function() {
    var token = $(document).find("meta[name=csrf-token]").attr("content");

    $(document).on('click', 'button.create,button.edit,button.delete-button,button.submit-button,button.update-button', function(e) {
        e.preventDefault();
        if ($(this).hasClass('create')) {
            $.ajax({
                url: $(this).attr('data-href'),
                cache: false,
                success: function(res) {
                    $("div#modalMin .modal-body").html('')
                    if (res.status) {
                        message('success', res.message, res.redirectTo)
                    } else {
                        $("div#modalMin .modal-body").html("")
                        $("div#modalMin .modal-body").html(res)
                        if ($(".selectpicker")[0]) {
                            $(".selectpicker").select2();
                        }
                    }
                },
                error: function(err) {
                    $("div#modalMin .modal-body").html('')
                    if (err.responseJSON.message) {
                        message('error', err.responseJSON.message)
                    } else {
                        message('error', err.responseJSON.errors)
                    }
                }
            });
            return;
        } else if ($(this).hasClass('delete-button')) {
            $.ajax({
                url: $(this).attr('data-href'),
                type: "DELETE",
                cache: false,
                data: { _token: token },
                success: function(res) {
                    message('success', res.message, res.redirectTo);
                    if($("button.reload").length)
                    $("button.reload").click();
                },
                error: function(err) {
                    if (err.responseJSON.message) {
                        message('error', err.responseJSON.message)
                    } else {
                        message('error', err.responseJSON.errors)
                    }
                }
            });
            return;
        } else if ($(this).hasClass('submit-button')) {
            e.preventDefault();
            $("div#modalUpdate .modal-body").html('')
            var form = $("div#modalMin .modal-body").find("form.form-horizontal");
            if (form.length < 1) {
                var form = $("form.form-horizontal");
            }
            $(form).validate(rules(form));
            if ($(form).valid()) {
                $(form).ajaxSubmit({
                    success: function(res) {
                        message('success', res.message, res.redirectTo);
                        if ($("button.reload").length) {
                            $("button.reload").click();
                        }
                    },
                    error: function(err) {

                        if (err.responseJSON.message && err.responseJSON.errors) {
                            message('error', err.responseJSON.errors)
                        } else if (err.responseJSON.message) {
                            message('error', err.responseJSON.message)
                        } else {
                            message('error', err.responseJSON.errors)
                        }
                    }
                });
            }else{
                scrollBack($("span.help-block")[0]);
                return;
            }
        } else if ($(this).hasClass('update-button')) {
            $("div#modalMin .modal-body").html('');
            var form = $("div#modalUpdate .modal-body").find("form.form-horizontal");
            if (form.length < 1) {
                var form = $("form.form-horizontal");
            }
            //let formData = new FormData(form[0]);
            $(form).validate(rules(form));

            if ($(form).valid()) {
                $(form).ajaxSubmit({
                    success: function(res) {
                        message('success', res.message, res.redirectTo);
                        if ($("button.reload").length) {
                            $("button.reload").click();
                        }
                    },
                    error: function(err) {
                        if (err.responseJSON.message) {
                            message('error', err.responseJSON.message)
                        } else {
                            message('error', err.responseJSON.errors)
                        }
                    }
                });
            }else{
                scrollBack($("span.help-block")[0]);
            }
        } else {

        }

    });

    $(document).on('click', 'a.create', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('data-href'),
            cache: false,
            success: function(res) {
                $("div#modalMin .modal-body").html('')
                $("div#modalMin .modal-body").html(res)
                if ($(".selectpicker")[0]) {
                    $(".selectpicker").select2();
                }
            },
            error: function(err) {
                if (err.responseJSON.message) {
                    message('error', err.responseJSON.message)
                } else {
                    message('error', err.responseJSON.errors)
                };
            }
        });
        return;
    }).on('click', 'a.delete', function(e) {
        e.preventDefault();
        let href = $(this).attr('data-href');

        $.ajax({
            url: $(this).attr('data-preview'),
            data: { _token: token },
            success: function(res) {
                $("div#modalDelete .modal-body").html('')
                $("div#modalDelete .modal-body").html(res)
                $("div#modalDelete .modal-footer button.delete-button").attr('data-href', href)
                if ($(".selectpicker")[0]) {
                    $(".selectpicker").select2();
                }
            },
            error: function(err) {
                if (err.responseJSON.message) {
                    message('error', err.responseJSON.message)
                } else {
                    message('error', err.responseJSON.errors)
                }
            }
        });
        return;
    }).on('click', 'a.edit', function(e) {
        e.preventDefault();
        $("div#modalMin .modal-body").html('')

        $.ajax({
            url: $(this).attr('data-href'),
            success: function(res) {
                $("div#modalUpdate .modal-body").html('')
                $("div#modalUpdate .modal-body").html(res)
                if ($(".selectpicker")[0]) {
                    $(".selectpicker").select2();
                }
            },
            error: function(err) {
                if (err.responseJSON.message) {
                    message('error', err.responseJSON.message)
                } else {
                    message('error', err.responseJSON.errors)
                }
            }
        });
        return;
    }).on('click', 'a.show_popup, a.preview', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('data-href'),
            success: function(res) {
                $("div#modalPopupDetail .modal-body").html('')
                $("div#modalPopupDetail .modal-body").html(res)
                if ($(".selectpicker")[0]) {
                    $(".selectpicker").select2();
                }
            },
            error: function(err) {
                if (err.responseJSON.message) {
                    message('error', err.responseJSON.message)
                } else {
                    message('error', err.responseJSON.errors)
                }
            }
        });
        return;
    }).on('click', 'input[type=checkbox]', function(e) {
        let url = $(this).data("url");
        let data = {
            field: $(this).attr('data-field'),
            value: $(this).attr('data-value'),
            id: $(this).attr('data-id'),
        };
        
        $.post(url, data, function(res) {
            if($("button.reload").length)
            $("button.reload").click();
        });

    });

});