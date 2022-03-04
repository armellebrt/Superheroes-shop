// $( function autocomplete(listProducts) {
//     $("#form_searchTerm").autocomplete({
//         source: function( request, response ) {
//             console.log(request);
//             let chaine = request.term;
//             let matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(chaine.trim()), "i");
//
//             response(
//                 $.grep( listProducts, function (item) {
//                     return matcher.test(item);
//                 })
//             );
//         },
//     });
// });