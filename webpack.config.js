const path = require('path');
const { VueLoaderPlugin } = require('vue-loader');
const { VuetifyPlugin } = require('webpack-plugin-vuetify')

module.exports = {
    entry: path.join(__dirname, 'resources/js', 'app.js'),
    output: {
        path: path.join(__dirname, 'dist'),
        publicPath: "/dist/",
        filename: "build.js"
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader']
            }
        ]
    },
    plugins: [
        new VueLoaderPlugin(),
        new VuetifyPlugin(),
    ]
}