(function($) {
    $(document).ready(function() {
        $('#nojquery').hide();
        $('#picker').farbtastic('#classcolor');
    });


})(jQuery);

function check_form()
{
    if (document.getElementById('class_name').value.length < 2)
    {
        alert('{MSG_NAME_EMPTY}');
        return false;
    }
    if (document.getElementById('class_id').value.length < 1)
    {
        alert('{MSG_ID_EMPTY}');
        return false;
    }
    return true;
}

function isValidChar(char, e){

    var txt = char;
    var found = false;
    var validChars = "0123456789"; //List of valid characters

    for(j=0;j<txt.length;j++){ //Will look through the value of text
        var c = txt.charAt(j);
        found = false;
        for(x=0;x<validChars.length;x++){
            if(c==validChars.charAt(x)){
                found=true;
                break;
            }
        }
        if(!found){
            //If invalid character is found remove it and return the valid character(s).
            document.getElementById(e).value = char.substring(0, char.length -1);
            break;
        }
    }
}
