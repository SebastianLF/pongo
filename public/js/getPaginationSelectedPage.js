function getPaginationSelectedPage(url) {
    var chunks = url.split('?');
    var baseUrl = chunks[0];
    var querystr = chunks[1].split('&');
    var pg = 1;
    for (i in querystr) {
        var qs = querystr[i].split('=');
        if (qs[0] == 'page') {
            pg = qs[1];
            break;
        }
    }
    return pg;
}