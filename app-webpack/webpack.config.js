const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
	//entrada y salida de los archivos
	entry: './src/app.js',
	output: {
		path: __dirname + '/build',
		filename: 'bundle.js',
	},
	//configuraciones del puerto
	devServer: {
		port: 5000,
	},
	//css
	module: {
		rules: [
			{
				test: /\.css$/,
				use: [
					{ loader: MiniCssExtractPlugin.loader },
					{ loader: 'css-loader' },
				],
			},
		],
	},
	//plugins
	plugins: [
		//html
		new HtmlWebpackPlugin({
			template: './src/index.html',
		}),
		//extraer css
		new MiniCssExtractPlugin({
			filename: 'bundle.css',
		}),
	],
};
