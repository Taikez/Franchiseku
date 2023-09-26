const mix = require('laravel-mix');

// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css')
//    .options({
//        processCssUrls: false
//    })
//    .copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/js')
//    .copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css');

   mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('bootstrap'),
    ]);
