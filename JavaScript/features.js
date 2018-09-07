
// Get value of params in url
function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
    sURLVariables = sPageURL.split('&'),
    sParameterName,
    i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

// Remove params from url 
window.history.pushState({}, document.title, window.location.pathname);



// Check if value is integer
function isInt(value) {
  return !isNaN(value) && 
  parseInt(Number(value)) == value && 
  !isNaN(parseInt(value, 10));
}
