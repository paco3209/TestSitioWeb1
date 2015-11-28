(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#register-form").validate({
                rules: {
                    username: "required",
                    password: {
                        required: true,
                        minlength: 5
                    },
                    
                },
                messages: {
                    username: "Tenes que ingresar nombre de usuario gilipollas!!",
                    password: {
                        required: "Por favor, ingresa tu password. No te hagas el gil!",
                        minlength: "Your password must be at least 5 characters long"
                    },
                     },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);