/**
 * Created by tomschillemans.
 */
$(document).ready(function() {
    console.log("The Document has been loaded!");

    var remoteUrl = Routing.generate('opifer.manual.help.search', { query: 'WILDCARD' });
    var prefetchUrl = Routing.generate('opifer.manual.help.search_all');
    var articles = new Bloodhound(
    {
        datumTokenizer: function (d) { return Bloodhound.tokenizers.whitespace(d.title); },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        name: "search",
        remote:
        {
            url: remoteUrl,
            wildcard: 'WILDCARD'
        }
    });

    articles.initialize();

    $('#searchfieldId').typeahead(
        {
            hint: true,
            autoselect: true,
            highlight: true,
            minLength: 1
        },
        {
        name: 'search',
        displayKey: 'title',
        source: articles.ttAdapter(),
        templates:
        {
            empty: '<div class="tt-suggestion"><p>No articles found!</p></div>',
            suggestion: function(data){
                return '<p><a href="'+ Routing.generate('opifer.manual.help.show', {slug: data.slug}) +'">'+ data.title +'</a></p>';
            }
        }
    }).on('typeahead:selected', function (object, datum, data) {
            document.location.href = Routing.generate('opifer.manual.help.show', {slug: data.slug})
        });
});