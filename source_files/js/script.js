$(function() {

    var owner = $('#owner');
    var year = $('#year');
    var month = $('#month');
    var todayDate = new Date();
    var cardDate = new Date(year,month);
    var cardNumber = $('#cardNumber');
    var cardNumberField = $('#card-number-field');
    var CVV = $("#cvv");
    var mastercard = $("#mastercard");
    var confirmButton = $('#confirm-purchase');
    var visa = $("#visa");
    var amex = $("#amex");

    // Use the payform library to format and validate
    // the payment fields.

    cardNumber.payform('formatCardNumber');
    CVV.payform('formatCardCVC');


    cardNumber.keyup(function() {

        amex.removeClass('transparent');
        visa.removeClass('transparent');
        mastercard.removeClass('transparent');

        if ($.payform.validateCardNumber(cardNumber.val()) == false) {
            cardNumberField.addClass('has-error');
        } else {
            cardNumberField.removeClass('has-error');
            cardNumberField.addClass('has-success');
        }

        if ($.payform.parseCardType(cardNumber.val()) == 'visa') {
            mastercard.addClass('transparent');
            amex.addClass('transparent');
        } else if ($.payform.parseCardType(cardNumber.val()) == 'amex') {
            mastercard.addClass('transparent');
            visa.addClass('transparent');
        } else if ($.payform.parseCardType(cardNumber.val()) == 'mastercard') {
            amex.addClass('transparent');
            visa.addClass('transparent');
        }
    });

    confirmButton.click(function(e) {

        

        var isCardValid = $.payform.validateCardNumber(cardNumber.val());
        var isCvvValid = $.payform.validateCardCVC(CVV.val());

        if(owner.val().length < 5){
            e.preventDefault();
            alert("Wrong owner name");
        } else if (!isCardValid) {
                    e.preventDefault();
            alert("Wrong card number");
        } else if (!isCvvValid) {
                    e.preventDefault();
            alert("Wrong CVV");
        } else if(todayDate > cardDate)
        {
            //This prevents the form submiting
                    e.preventDefault();
            alert("This card has expired");
        }else
        {
            // Everything is correct. We make sure the post data is sent
            var data = $('form').serialize();
            $.post('url', data);
        }
    });
});
