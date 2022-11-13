 function message($alert, $message, $redirectTo) {
     toastr.options = {
         "closeButton": true,
         "debug": false,
         "positionClass": "toast-top-center",
         "onclick": null,
         "showDuration": "5000",
         "hideDuration": "5000",
         "timeOut": "5000",
         "extendedTimeOut": "5000",
         "showEasing": "swing",
         "hideEasing": "linear",
         "showMethod": "fadeIn",
         "hideMethod": "fadeOut"
     }
     if ($alert == "fail") {
         toastr.warning($message, 'Gagal');
     } else if ($alert == "info") {
         toastr.info($message, 'Info');
     } else if ($alert == "error") {
         toastr.error(fetchMessages($message), 'Error');
     } else {
         toastr.success($message, $alert);
         $("button.closed").click();
     }

     if (typeof $redirectTo != "undefined") {
        if($("button.reload").length < 1){
            window.location.href = $redirectTo;
        }
     }
 }

 function fetchMessages($messages) {
     let message = "<ul>";
     $.each($messages, function(key, value) {
         message += "<li>" + value + "</li>";
     });
     return message + "</ul>";
 }