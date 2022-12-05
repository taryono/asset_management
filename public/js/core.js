/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var isCoreLoaded = true;
var deleteElement = null;
console.log("core loaded");
window.addEventListener("resize", (event) => {
    var newWidth = window.innerWidth;
    var newHeight = window.innerHeight;
    //console.table(newWidth, newHeight);
    //window.location.reload();
});
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    cache: false,
});
Array.prototype.inArray = function(value) {
    var i;
    for (i = 0; i < this.length; i++) {
        if (this[i] == value) {
            return true;
        }
    }
    return false;
};

window.ucword = (target) => {
    var str = $(target)
        .val()
        .replace(/\w\S*/g, function(txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        });
    $(target).val(str);
};

window.filtter_select_ajax = (target, data, url) => {
    $(target).addClass("loading");
    $(target).prop("disabled", true);

    $.ajax({
        url: url,
        data: data,
        success: function(e) {
            $(target).removeClass("loading");
            $(target).prop("disabled", false);
            $(target).html(e);
            if ($(target).hasClass("selectpicker")) {
                $(target).select2();
            }
        },
    });
};

window.getData = (url, target) => {
    $(target).addClass("loading");
    $.get({
        url: url,
        success: function(e) {
            $(target).removeClass("loading");
            $(target).html(e);
        },
    });
};

window.clearSelect = (e) => {
    $(e).find('option:not([value=""])').not().remove();
};

window.rupiah = (nStr, inD = ".", outD = ".", sep = ",") => {
    nStr += "";
    var dPos = nStr.indexOf(inD);
    var nStrEnd = "";
    if (dPos != -1) {
        nStrEnd = outD + nStr.substring(dPos + 1, nStr.length);
        nStr = nStr.substring(0, dPos);
    }
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(nStr)) {
        nStr = nStr.replace(rgx, "$1" + sep + "$2");
    }
    var result = nStr + nStrEnd;
    return result;
};

window.number = (bilangan) => {
    var number_string = bilangan.toString(),
        sisa = number_string.length % 3,
        rupiah = number_string.substr(0, sisa),
        ribuan = number_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        separator = sisa ? "," : "";
        rupiah += separator + ribuan.join(",");
    }
    return rupiah;
};

window.touppercase = (element) => {
    var str = $(element).val().toLowerCase();
    var lowercase = (str + "").replace(/^(.)|\s+(.)/g, function($1) {
        return $1.toUpperCase();
    });
    $(element).val(lowercase);
};

window.getFileExtension = (filename) => {
    return filename.split(".").pop();
};

window.numberOnly = (e) => {
    // Allow: backspace, delete, tab, escape, enter and .
    if (
        $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        // Allow: Ctrl+A, Command+A
        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: home, end, left, right, down, up
        (e.keyCode >= 35 && e.keyCode <= 40)
    ) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if (
        (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) &&
        (e.keyCode < 96 || e.keyCode > 105)
    ) {
        e.preventDefault();
    }

    if ($(e).val() < 0 || isNaN($(e).val())) {
        $(e).val(0);
    }
};

window.scrollBack = (target) => {
    $("html, body").animate({
            scrollTop: $(target).offset().top - 150,
        },
        500
    );
};

window.calendar = (tgl, delim = null) => {
    return tgl
        .split(delim ? delim : "-")
        .reverse()
        .join("-");
};

function readURL(input, target) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var size = input.files[0].size;
        var extensions = ["jpeg", "png", "jpg", "gif", "svg"];
        let text_message = "";
        console.log(target)
        var img = $("div." + (target ? target : "post-review") + " img").attr(
            "src"
        );
        if (
            extensions.indexOf(
                getFileExtension(input.files[0].name.toLowerCase())
            ) != -1
        ) {
            if (size > 2048000) {
                text_message = "Maksimal size 2MB";
                reader.onload = function(e) {
                    $("." + (target ? target : "post-review") + " img")
                        .attr("src", img)
                        .css({ width: "width: 107px" });
                };
            } else {
                reader.onload = function(e) {
                    $("." + (target ? target : "post-review") + " img")
                        .attr("src", e.target.result)
                        .css({ width: "width: 107px" });
                };
            }
        } else {
            text_message =
                "Ekstension File not allowed " +
                getFileExtension(input.files[0].name.toLowerCase());
            message("info", text_message);
            reader.onload = function(e) {
                $("." + (target ? target : "post-review") + " img")
                    .attr("src", img)
                    .css({ width: "width: 107px" });
            };
            return;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(function() {
    
    $('a[data-toggle="pill"]').on("shown.bs.tab", function(e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();  
    }); 

    $(document).on("change", "input.post-input", function() {
        var target = $(this).data("target");
        readURL(this, target);
    }).on("keydown", ".amount", function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if (
            $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)
        ) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if (
            (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) &&
            (e.keyCode < 96 || e.keyCode > 105)
        ) {
            e.preventDefault();
        }

        if ($(this).val() < 0 || isNaN($(this).val())) {
            $(this).val(0);
        }
    }).on(
        "keydown",
        ".kk, .ktp, .cellphone, .phone, .postcode",
        function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if (
                $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 &&
                    (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)
            ) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if (
                (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) &&
                (e.keyCode < 96 || e.keyCode > 105)
            ) {
                e.preventDefault();
            }

            if ($(this).val() < 0 || isNaN($(this).val())) {
                $(this).val(0);
            }

            if ($(this).hasClass("kk") || $(this).hasClass("ktp")) {
                if ($(this).val().length > 16) {
                    $(this).val($(this).val().substring(0, 15));
                }
            } else if (
                $(this).hasClass("cellphone") ||
                $(this).hasClass("phone")
            ) {
                if ($(this).val().length >= 12) {
                    $(this).val($(this).val().substring(0, 12));
                }
            } else {
                if ($(this).val().length >= 5) {
                    $(this).val($(this).val().substring(0, 5));
                }
            }
        }
    ).on("keydown", ".ucword", function(e) {
        ucword(this);
    }).on("change", ".area", function() {
        filtter_select_ajax(
            "#" + $(this).attr("data-target"), {
                model: $(this).attr("model"),
                field: $(this).attr("id"),
                id: $(this).val(),
                parent: $(this).attr("data-parent"),
                index: $(this).attr("data-index"),
            },
            $(this).attr("data-url")
        );
        console.log("load area");
    }).on("click", "ul.nav-sidebar li.nav-item a.nav-link, li a.profile-url", function(e) {

        e.preventDefault(); 
         
        if($(this).parent().hasClass("has-treeview")){
            return;
        }
        $("a.nav-link").removeClass("active");
        var url =  $(this).attr("href");
        var target = $("div#container");
        $(target).addClass("loading"); 
        $(this).addClass("active");
        $.ajax({
            url: url, 
            success: function(e) {
                $(target).removeClass("loading"); 
                $(target).html(e); 
                loadDatatables();
                $('a[data-toggle="pill"]').on("shown.bs.tab", function(e) {
                    $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();  
                }); 
            },
        });
    });
    
    $('[data-toggle="tooltip"]').tooltip();

    $(".datepicker").datetimepicker({
        years: function(a) {
            console.log(this);
        },
    });
    $(".text-editor").summernote({
        height: 100,
        toolbar: [
            ["style", ["bold", "italic", "underline", "clear"]],
            ["font", ["strikethrough", "superscript", "subscript"]],
            ["fontsize", ["fontsize"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["height", ["height"]],
            ["insert", ["table", "link", "picture", "video"]],
            ["Misc", ["codeview", "fullscreen"]],
        ],
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable);
        },
        callbacks: {
            onKeyup: function(e) {
                var text = $(".note-editable").text();
                $(".count").html(text.length);
            },
            onInit: function(e) {
                var text = $(".note-editable").text();
                $(".count").html(text.length);
            },
        },
    });
});

function getFileExtension(filename) {
    return filename.split(".").pop();
}

function rules(form) {
    var rules = {};
    var messages = {};
    $(form)
        .find("input, select, textarea")
        .each(function(i, v) {
            if ($(v).attr("name") && $(v).attr("name") != "_token") {
                rules[$(v).attr("name")] = {};
                if ($(v).attr("required")) {
                    rules[$(v).attr("name")] = {
                        required: typeof $(v).attr("required") != "undefined" ?
                            true : false,
                    };
                }

                if ($(v).attr("equalWith")) {
                    const equalTo = {
                        equalTo: typeof $(v).attr("equalWith") != "undefined" ?
                            $(v).attr("equalWith") : null,
                    };

                    if (equalTo) {
                        Object.assign(rules[$(v).attr("name")], equalTo);
                    }
                }

                if ($(v).attr("creditcard")) {
                    const creditcard = {
                        creditcard: typeof $(v).attr("creditcard") != "undefined" ?
                            true : false,
                    };

                    if (creditcard) {
                        Object.assign(rules[$(v).attr("name")], creditcard);
                    }
                }

                if ($(v).attr("minlength") > 0 && $(v).attr("maxlength") > 0) {
                    const range = {
                        rangelength: typeof $(v).attr("range") != "undefined" ? [
                            parseInt($(v).attr("minlength")),
                            parseInt($(v).attr("maxlength")),
                        ] : false,
                    };

                    if (range) {
                        Object.assign(rules[$(v).attr("name")], range);
                    }
                } else {
                    if ($(v).attr("minlength") > 0) {
                        const minlength = {
                            minlength: typeof $(v).attr("minlength") != "undefined" ?
                                parseInt($(v).attr("minlength")) : 0,
                        };

                        if (minlength) {
                            Object.assign(rules[$(v).attr("name")], minlength);
                        }
                    }

                    if ($(v).attr("maxlength") > 0) {
                        const maxlength = {
                            maxlength: typeof $(v).attr("maxlength") != "undefined" ?
                                parseInt($(v).attr("maxlength")) : 0,
                        };

                        if (maxlength) {
                            Object.assign(rules[$(v).attr("name")], maxlength);
                        }
                    }
                }

                messages[$(v).attr("name")] = {
                    required: typeof $(v).attr("required") != "undefined" ?
                        $(v).attr("title") : "Mohon isi data secara lengkap",
                    minlength: typeof $(v).attr("data-minlength") != "undefined" ?
                        $(v).attr("data-minlength") : "Mohon isi field minimal " +
                        $(v).attr("minlength") +
                        " karakter",
                    maxlength: typeof $(v).attr("data-maxlength") != "undefined" ?
                        $(v).attr("data-maxlength") : "Mohon isi field maksimal " +
                        $(v).attr("maxlength") +
                        " karakter",
                    equalTo: typeof $(v).attr("title") != "undefined" ?
                        $(v).attr("title") : "Mohon isi field ini persis " +
                        $(v).attr("equalWith"),
                };
            }
        });
    return {
        errorClass: "help-block",
        debug: true,
        rules: rules,
        messages: messages,
        errorElement: "span",
        errorPlacement: function(error, element) {
            error.appendTo(element.parent());
            scrollBack(error);
            element.parent().focus();
        },
    };
}

function loadDatas(table_id, objects) {
    console.log(getColumns(table_id, objects));
}

function loadData(table_id, objects) {
    var selected = [];
    var route = $(table_id).attr("data-route") ?
        $(table_id).attr("data-route") :
        null;
    var title = $(table_id).attr("data-title") ?
        $(table_id).attr("data-title") :
        $("title").text();
    var filename = $(table_id).attr("data-filename") ?
        $(table_id).attr("data-filename") :
        $("title").text();
    var table = $(table_id).DataTable({
        dom: "<'row'<'col-sm-3'l><'col-sm-4'B><'col-sm-5'f>>rtip",
        responsive: true,
        scrollY: 400,
        scrollX: true,
        responsive: true,
        processing: true,
        autoWidth: false,
        serverSide: true,
        select: true,
        bStateSave: true,
        deferRender:    true, 
        scrollCollapse: true,
        scroller:       true,
        rowCallback: function(row, data) {
            if ($.inArray(data.DT_RowId, selected) !== -1) {
                $(row).addClass("selected");
            }
        },
        ajax: route,
        columnDefs: getColumnDefs(table_id),
        columns: getColumns(table_id, objects),
        buttons: [{
                extend: "pdf",
                customize: function(win) {
                    console.log(this, win);
                },
                exportOptions: {
                    columns: getColumnPrint(table_id),
                },
                filename: filename,
                title: title,
            },
            {
                extend: "excel",
                customize: function(win) {
                    console.log(win);
                    
                },
                exportOptions: {
                    columns: getColumnPrint(table_id),
                },
                filename: filename,
                title: title,
            },
            {
                extend: "reload",
                customize: function(e, dt, node, config) {
                    dt.ajax.reload();
                },
            },
            {
                extend: "print",
                //autoPrint: false,
                customize: function(win) {
                    $(win.document.body)
                        .css("font-size", "10pt")
                        .prepend(
                            '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                        );
                         
                },
                exportOptions: {
                    columns: getColumnPrint(table_id),
                },
                filename: filename,
                title: title,
            },
        ],
        initComplete: function() {
            this.api()
                .columns(getColumnDropDownSearch(table_id))
                .every(function(d) {
                    var column = this;
                    //var theadname = $(table_id + " th").eq([d]).text(); //used this specify table name and head
                    //var select = $('<select><option value=""></option></select>')
                    var select = $(
                            '<select class="form-control my-1"><option value=""> Show all ' +
                            "</option></select>"
                        )
                        .appendTo($(column.footer()).empty())
                        //.appendTo($(column.header()))
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            //select.append('<option value="' + d + '">' + d + '</option>');
                            if (column.search() === "^" + d + "$") {
                                select.append(
                                    '<option value="' +
                                    d +
                                    '" selected="selected">' +
                                    d +
                                    "</option>"
                                );
                            } else {
                                select.append(
                                    '<option value="' +
                                    d +
                                    '">' +
                                    d +
                                    "</option>"
                                );
                            }
                        });
                    $(select).click(function(e) {
                        e.stopPropagation();
                    });
                });
        },
    }).columns.adjust().draw();
}

function getColumns(table_id, objects = {}) {
    var fields = [];
    $("table" + table_id + " thead tr")
        .children()
        .each(function(i, v) {
            var names = {};

            if ($(v).attr("data-name")) {
                if ($(v).attr("data-name") == "id") {
                    $(v).attr("width","10px")
                    names = {
                        data: "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false,
                        searchable: false,
                    };
                } else if ($(v).attr("data-name") == "action") {
                    $(v).attr("width","100px")
                    names = {
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false,
                    };
                } else {
                    names = {
                        data: $(v).attr("data-name"),
                        name: $(v).attr("data-name"),
                    };
                    if ($(v).attr("data-format")) {
                        if ($(v).attr("data-format") == "money") {
                            names = {
                                data: $(v).attr("data-name"),
                                render: function(row, data) {
                                    return "Rp. " + number(row);
                                },
                            };
                        } else if ($(v).attr("data-format") == "date") {
                            names = {
                                data: $(v).attr("data-name"),
                                render: function(row, data) {
                                    return calendar(row);
                                },
                            };
                        } else {}
                    }
                }
                fields.push(names);
            } else {
                if ($(v).attr("data-function")) {
                    fields.push(objects[$(v).attr("data-object")]);
                }
            }
        });

    return fields;
}

function getColumnDefs(table_id) {
    var fields = [];
    $("table" + table_id + " thead tr")
        .children()
        .each(function(i, v) {
            var names = {};
            if ($(v).attr("nowrap")) {
                if ($(v).attr("nowrap")) {
                    names = { targets: i, className: "text-nowrap" };
                }
                if ($(v).attr("action")) {
                    names = { targets: i, className: "text-nowrap" };
                }
                fields.push(names);
            }
        });

    return fields;
}

function getColumnPrint(table_id) {
    var fields = [];
    $("table" + table_id + " thead tr")
        .children()
        .each(function(i, v) {
            if ($(v).attr("data-name") != "action") {
                if (typeof $(v).attr("no-print") == "undefined") {
                    fields[i] = i;
                }
            }
        });
    return fields;
}

function getColumnDropDownSearch(table_id) {
    var fields = [];
    $("table" + table_id + " thead tr")
        .children()
        .each(function(i, v) {
            if (i > 0) {
                if ($(v).attr("data-name")) {
                    if ($(v).attr("data-name") != "action") {
                        if (typeof $(v).attr("no-print") == "undefined") {
                            fields[i] = i;
                        }
                    }
                }
            }
        });
    var filtered = fields.filter(function(el) {
        return el > 0;
    });
    return filtered;
} 

function loadDatatables(){
    var table = $("table.standard");
    if (table.length > 0) {
        $(table).css("width","100%")
        if (table.length == 1) { 
            loadData("#" + $(table).attr("id"), {});
        } else {
            $("table.standard").each(function(i, v) {
                loadData("#" + $(v).attr("id"), {});
            });
        }

        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
    }
}