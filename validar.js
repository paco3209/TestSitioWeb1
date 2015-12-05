
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
                    mail: {
                        required: true,
                        email: true
                    },
                    password1: {
                        required: true,
                        minlength: 5
                    },
               //     agree: "required"
                },
                messages: {
                    username: "Please enter your firstname",
                    password1: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    mail: "Please enter a valid email address",
                 //   agree: "Please accept our policy"
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