$(document).ready(function () {
    /*Perform validation of forms with jQuery plugin
     * First one controls the register.php forms that perform inserts
     * Second controls the account.php form the updates
     * Third controls the address.php form that updates
     * */
    $("#register_account_form").validate({
        focusCleanup: true,
        rules: {
            username: {
                minlength: 2
            },
            password: {
                minlength: 8
            },
            lastName: {
                minlength: 2
            },
            street: {
                minlength: 2
            },
            zipCode: {
                minlength: 2
            }
        },
        messages: {
            username: {
                required: "Please specify your name",
                minlength: jQuery.validator.format("Name too short!"),
            },
            lastName: {
                required: "Please specify your last name",
                minlength: jQuery.validator.format("Last name too short!"),
            },
            password: {
                required: "You need a password to protect your account",
                minlength: "Password must be at least 8 characters long",
            },
            email: {
                required: "We need your email address to contact you",
                email: "Email must be in the format name@domain.com"
            },
            zipCode: {
                required: "A valid zipcode is needed for shipping",
                minlength: jQuery.validator.format("Zip code too short!"),
            },
            country: "A valid country is needed for shipping",
            street: {
                required: "A valid street is needed for shipping",
                minlength: jQuery.validator.format("Street too short!"),
            },
            number: "A valid zipcode is needed for shipping",
        },
        // Place the error message between the label and the input and paint it red
        errorPlacement: function (error, element) {
            error.insertBefore(element);
            error.addClass("w3-text-white");
            error.addClass("w3-red");
        },
        // Hightlight the input red when errors and remove them when valid
        highlight: function (element) {
            $(element).addClass("w3-border-red");
        },
        unhighlight: function (element) {
            $(element).removeClass("w3-border-red");
        },
    });
    $("#account_form").validate({
        focusCleanup: true,
        rules: {
            username: {
                minlength: 2
            },
            last_name: {
                minlength: 2
            },
        },
        messages: {
            username: {
                required: "Please specify your name",
                minlength: jQuery.validator.format("Name too short!"),
            },
            last_name: {
                required: "Please specify your last name",
                minlength: jQuery.validator.format("Last name too short!"),
            },
            email: {
                required: "We need your email address to contact you",
                email: "Your email address must be in the format of name@domain.com"
            },
        },
        // Place the error message between the label and the input and paint it red
        errorPlacement: function (error, element) {
            error.insertBefore(element);
            error.addClass("w3-text-white");
            error.addClass("w3-red");
        },
        // Hightlight the input red when errors and remove them when valid
        highlight: function (element) {
            $(element).addClass("w3-border-red");
        },
        unhighlight: function (element) {
            $(element).removeClass("w3-border-red");
        },
    });
    $("#address_form").validate({
        focusCleanup: true,
        rules: {
            street: {
                minlength: 2
            },
            zipCode: {
                minlength: 2
            }
        },
        messages: {
            zipCode: {
                required: "A valid zipcode is needed for shipping",
                minlength: jQuery.validator.format("Zip code too short!"),
            },
            country: "A valid country is needed for shipping",
            street: {
                required: "A valid street is needed for shipping",
                minlength: jQuery.validator.format("Street too short!"),
            },
            number: "A valid zipcode is needed for shipping",
        },
        // Place the error message between the label and the input and paint it red
        errorPlacement: function (error, element) {
            error.insertBefore(element);
            error.addClass("w3-text-white");
            error.addClass("w3-red");
        },
        // Hightlight the input red when errors and remove them when valid
        highlight: function (element) {
            $(element).addClass("w3-border-red");
        },
        unhighlight: function (element) {
            $(element).removeClass("w3-border-red");
        },
    });
});