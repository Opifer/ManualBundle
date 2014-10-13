/**
 * Created by tomschillemans on 10/10/14.
 */
$(document).ready(function () {
    console.log("Document loaded");
    // Listen for the form being submitted
    $("#searchForm").submit(function () {
        var url = $("#searchForm").attr("action"); // Get the submit url for the form
        // Start send the post request
        $.post(url, {
                searchForm: $("#searchId").val(),
                other: "attributes"
            },
            function (data) { // The response is in the data variable
                if (data.responseCode === 200) {
                    $.each(data.searchResult, function (key, value) {
                        $('#searchResult').html(value);
                    });
                }
                else if (data.responseCode === 400) // Search box empty
                {
                    // Set the error text if search box is empty and change the text color to be red.
                    $('#searchResult').html(data.errorMessage);
                    $('#searchResult').css("color", "red");
                }
            }
        );
        return false; // We don't what the browser to submit the form
    });
});