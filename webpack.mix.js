// webpack.mix.js

const mix = require('laravel-mix');

mix.js('resources/js/editor.js', 'public/js').vue();

mix.js('resources/js/autheditor.js', 'public/js').vue();

mix.js('resources/js/catalog.js', 'public/js').vue();