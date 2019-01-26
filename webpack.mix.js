let mix = require('laravel-mix');
let build = require('./tasks/build.js');

const MomentLocalesPlugin = require('moment-locales-webpack-plugin');

mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/build');
mix.webpackConfig({
    plugins: [
        build.jigsaw,
        build.browserSync(),
        build.watch(['source/**/*.md', 'source/**/*.php', 'source/**/*.scss', '!source/**/_tmp/*']),
        new MomentLocalesPlugin(),
    ]
});

// mix.js('source/_assets/js/main.js', 'js')
//     .sass('source/_assets/sass/main.scss', 'css')
//     .sass('source/_assets/sass/aactmad.scss', 'css')
//     .options({
//         processCssUrls: false,
//     });

mix
    .sass('source/_assets/sass/main.scss', 'css')
    .js('source/_assets/js/main.js', 'js')
    .js('source/_assets/js/vue.js', 'js')
    .js('source/_assets/js/coming.events.js', 'js')
;

if (mix.inProduction()) {
    mix.version();
}