
$(document).ready(function (){

    function convertToSlug(text, place) {
        text = text.toLowerCase();
        text = text.replace(/[^a-zA-Z0-9]+/g, "-");
        $(place).val(text);
    }
})
