let mix = require("laravel-mix");
let config = require("./config.json");

const externals = {
    "@wordpress/blocks": "wp.blocks",
    "@wordpress/components": "wp.components",
    "@wordpress/compose": "wp.compose",
    "@wordpress/data": "wp.data",
    "@wordpress/date": "wp.date",
    "@wordpress/editor": "wp.editor",
    "@wordpress/block-editor": "wp.blockEditor",
    "@wordpress/element": "wp.element",
    "@wordpress/hooks": "wp.hooks",
    "@wordpress/i18n": "wp.i18n",
    "@wordpress/plugins": "wp.plugins",
};

// Mix configuration
mix.webpackConfig({
    externals: externals,
});
mix.setPublicPath("dist/public");
mix.setResourceRoot(".");
mix.disableSuccessNotifications();

mix.options({
    autoprefixer: true,
    postCss: [require("postcss-custom-properties")],
});

mix.browserSync({
    proxy: config.browserSync,
    files: [
        `./dist/**/*.php`,
        `./src/scss/**/*.scss`,
        `./src/javascript/**/*.js`,
    ],
});

if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps();
}

// Main Javascript
mix.js("src/javascript/app.js", "dist/public").react();

// Main Sass
mix.sass("src/scss/app.scss", "dist/public");

// Gutenberg Blocks
mix.js("src/javascript/blocks/*.js", "dist/public/blocks.js").react();
mix.sass("src/scss/blocks.scss", "dist/public");
