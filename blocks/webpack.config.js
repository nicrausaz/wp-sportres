const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const path = require('path');

module.exports = {
	...defaultConfig,
	entry: {
		'sportres-block-game': './src/sportres-block-game.js'
	},
	output: {
		path: path.join(__dirname, '../assets/js'),
		filename: '[name].js'
	}
}