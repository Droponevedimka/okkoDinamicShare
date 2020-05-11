const merge = require('webpack-merge')
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const baseWebpackConfig = require('./webpack.base.conf')
const TerserPlugin = require('terser-webpack-plugin')

const buildWebpackConfig = merge(baseWebpackConfig, {
    mode: 'production',
    plugins: [
        new CleanWebpackPlugin()
    ],
    resolve: {
        alias: {          
          'vue$': 'vue/dist/vue.min',
        }
    },
    optimization: {
        minimize: true,
        minimizer: [new TerserPlugin()],
    }
})


module.exports = new Promise((resolve, reject) => {
    resolve(buildWebpackConfig)
})