$(function() {
    $.validator.addMethod('noDigits', function(value, element) {
        return /\d/.test(value) == false;
    });

    $.validator.addMethod('noHTML', function (value, element) {
        return /<.[^<>]*?>/g.test(value) == false;
    })

    $('#post-form').validate({    
        rules: {
            title: {
                required: true,
                noDigits: true
            },
            description: {
                required: true,
                noHTML: true
            }
        },

        messages: {
            title: {
                required: "Titel måste anges",
                noDigits: "Inga siffror tillåtna"
            },
            description: {
                required: "Beskrivning måste anges",
                noHTML: "HTML ej tillåtet"
            }
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});
