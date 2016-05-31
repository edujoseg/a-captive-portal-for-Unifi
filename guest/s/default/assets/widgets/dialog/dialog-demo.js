/* jQueryUI Dialogs */

$(function() {

    $(".basic-dialog").click(function() {

        $("#basic-dialog").dialog({
            minWidth: 600,
            minHeight: 400,
            modal: true,
            closeOnEscape: true,
            position:{
                my: "center",
                at: "center",
                of: window
             },
            buttons: {
                "OK": function() {
                    $(this).dialog("close");
                }
            }
        });
        $('.ui-widget-overlay').addClass('bg-white opacity-60');
    });
});


