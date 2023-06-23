// webpack.mix.js

const mix = require('laravel-mix');

mix.js('resources/js/onlinemarceditor.js', 'public/js').vue();
mix.js('resources/js/editoralephseq.js', 'public/js').vue();
mix.js('resources/js/cutter.js', 'public/js').vue();