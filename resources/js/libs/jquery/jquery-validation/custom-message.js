$().ready(function() {
    jQuery.extend(jQuery.validator.messages, {
        required: jQuery.validator.format('{0} is required.'),
        katakanaMaxLength: jQuery.validator.format('Please enter {0} with less than "{1}" characters. (currently {2} characters).'),
        email: jQuery.validator.format('Please enter your e-mail address correctly.'),
        max: jQuery.validator.format('Please enter {0} with less than "{1}" characters. (currently {2} characters).'),
        date: jQuery.validator.format('Enter the correct date for {0}.'),
        greaterStart: jQuery.validator.format('Please specify the contract end date as the scheduled cancellation date.'),
        onlyNumberAndAlphabetForPassword: jQuery.validator.format('The password cannot contain only single-byte numbers or only single-byte alphabetic characters.'),
        onlyNumberAndAlphabetOneByte: jQuery.validator.format('Please enter {0} in single-byte alphanumeric characters.'),
        stringValueRange: jQuery.validator.format('パスワードは半角英数字記号で8～20文字で入力してください。'),
        equalTo: jQuery.validator.format('Enter the password in 8 to 20 characters using half-width alphanumeric characters.'),
        existsEmail: jQuery.validator.format('Your email address is already registered.'),
        notNull: jQuery.validator.format('{0} is required.'),
        extension: jQuery.validator.format('Incorrect file format. Please select {0}.'),
        filesize: jQuery.validator.format('File size limit {0} exceeded.'),
    });
})