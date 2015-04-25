
    (function() {
        var path = '//easy.myfonts.net/v2/js?sid=10259(font-family=Helvetica+Neue+55+Roman)&sid=10261(font-family=Helvetica+Neue+75+Bold)&sid=10265(font-family=Helvetica+Neue+65+Medium)&sid=10269(font-family=Helvetica+Neue+25+UltraLight)&key=WnOvR998Eu',
            protocol = ('https:' == document.location.protocol ? 'https:' : 'http:'),
            trial = document.createElement('script');
        trial.type = 'text/javascript';
        trial.async = true;
        trial.src = protocol + path;
        var head = document.getElementsByTagName("head")[0];
        head.appendChild(trial);
    })();
