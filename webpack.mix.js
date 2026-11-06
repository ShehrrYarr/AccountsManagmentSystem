const mix = require('laravel-mix');
const path = require('path');
const fs = require('fs-extra');
const rtlcss = require('rtlcss');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const { RawSource } = require('webpack-sources');

// Define folders
const folder = {
    src: "resources/", // Laravel's default
    src_assets: "resources/assets/",
    dist: "public/",
    dist_assets: "public/assets/"
};

// Define RTL CSS file pairs
const cssPairs = [
    { ltr: 'assets/css/app.min.css', rtl: 'assets/css/app-rtl.min.css' },
    { ltr: 'assets/css/bootstrap.min.css', rtl: 'assets/css/bootstrap-rtl.min.css' },
    { ltr: 'assets/css/custom.min.css', rtl: 'assets/css/custom-rtl.min.css' },
];

// Ensure the assets folder is created in the dist directory
fs.ensureDirSync(folder.dist_assets);

// Compile SCSS and generate minified CSS files
mix.sass(path.join(folder.src_assets, 'scss/app.scss'), 'assets/css/app.min.css')
   .sass(path.join(folder.src_assets, 'scss/bootstrap.scss'), 'assets/css/bootstrap.min.css')
   .sass(path.join(folder.src_assets, 'scss/icons.scss'), 'assets/css/icons.min.css')
   .sass(path.join(folder.src_assets, 'scss/custom.scss'), 'assets/css/custom.min.css')
   .setPublicPath(folder.dist);

// Copy assets (images, JS, libs, json) to the dist folder
mix.copyDirectory(path.join(folder.src_assets, 'images'), path.join(folder.dist_assets, 'images'));
mix.copyDirectory(path.join(folder.src_assets, 'js'), path.join(folder.dist_assets, 'js'));
mix.copyDirectory(path.join(folder.src_assets, 'libs'), path.join(folder.dist_assets, 'libs'));
mix.copyDirectory(path.join(folder.src_assets, 'json'), path.join(folder.dist_assets, 'json'));

// Add BrowserSync for live-reloading during development
mix.browserSync({
    proxy: false,
    server: {
        baseDir: folder.dist
    },
    port: 3000,
    files: [
        path.join(folder.dist, '**/*')
    ]
});

// Webpack config extensions with RTL plugin for generating RTL CSS
mix.webpackConfig({
    plugins: [
        {
            apply(compiler) {
                compiler.hooks.afterEmit.tap('GenerateRTL', (compilation) => {
                    cssPairs.forEach((pair) => {
                        const ltrPath = path.join(folder.dist, pair.ltr);
                        const rtlPath = path.join(folder.dist, pair.rtl);
                        
                        if (fs.existsSync(ltrPath)) {
                            const ltrCss = fs.readFileSync(ltrPath, 'utf8');
                            const rtlCss = rtlcss.process(ltrCss, { autoRename: false, clean: false });
                            fs.writeFileSync(rtlPath, rtlCss);
                            console.log(`Generated RTL CSS: ${rtlPath}`);
                        }
                    });
                });
            }
        }
    ]
});

// Optional: disable notifications if needed
mix.disableNotifications();

// Enable versioning for production
if (mix.inProduction()) {
    mix.version();
}