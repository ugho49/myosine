/**
 * Created by ughostephan on 05/09/2016.
 */
$(document).ready(function() {
    $.material.init();

    $('.delete').delay(3000).fadeOut(500, function () {
        $(this).remove();
    });
});