let mix = require('laravel-mix');

let aliases = {
    '@admin': path.resolve(__dirname, 'resources', 'assets', 'js', 'admin'),
};
mix
    .webpackConfig({
        resolve: {
            extensions: ['.js', '.vue'],
            unsafeCache: true,
            alias: aliases
        }
    })
    .options({
        uglify: {
            uglifyOptions: {
                compress: true,
                comments: false,
                mangle: true
            }
        },
        processCssUrls: false,
        postCss: []
    })
    .autoload({
        'jquery': ['$', 'window.jQuery', 'jQuery'],
    })
    .js('resources/assets/js/admin/app.js', 'public/js')
    .sass('resources/assets/sass/app.sass', 'public/css').options({autoprefixer: false})
    .sass('resources/assets/scss/login.scss', 'public/css').options({autoprefixer: false})
    .sass('resources/assets/scss/_privacy.scss', 'public/css').options({autoprefixer: false})
    .sass('resources/assets/scss/email.scss', 'public/css').options({autoprefixer: false})
    .sass('resources/assets/scss/_privacy-reisbureau.scss', 'public/css').options({autoprefixer: false})
    .copy('resources/assets/fonts', 'public/fonts')
    .copy('resources/assets/img', 'public/img')
    .styles([
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'resources/assets/css/Roboto.css',
        'public/css/login.css'], 'public/css/login.css'
    )
    .combine([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/popper.js/dist/popper.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'resources/assets/js/script.js'], 'public/js/login.js');