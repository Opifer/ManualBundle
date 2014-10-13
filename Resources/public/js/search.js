/**
 * Created by tomschillemans on 10/10/14.
 */
$(document).ready(function () {
    console.log("Document loaded");
    // Listen for the form being submitted
    //$("#searchForm").submit(function () {
    $("#searchId").on("change keyup paste click", function(){
        var url = $("#searchForm").attr("action"); // Get the submit url for the form
        // Start send the post request
        $.post(url, {
                searchForm: $("#searchId").val(),
                other: "attributes"
            },
            function (data) { // The response is in the data variable
                // Clear the contents of the #searchResult div
                $('#searchResult').empty();

                if (data.responseCode === 200) {
                        $('#searchResult').empty();
                        $.each(eval(data.searchResult), function (key, value) {
                            $('#searchResult').append("\
                            <li class=\"list-group-item\">\
                                <a href=\" "+ Routing.generate('opifer.manual.help.show', { slug: value.slug }) +" \">\
                                   "+ value.title +"\
                                </a>\
                            </li>"
                            );
                        });
                }

            }
        );
        return false; // We don't what the browser to submit the form
    });
});