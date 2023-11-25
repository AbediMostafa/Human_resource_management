import {defineConfig} from 'vite'
import vue from '@vitejs/plugin-vue'

const path = require("path");

// https://vitejs.dev/config/
export default defineConfig({
    server: {
        host: '0.0.0.0',
        port: 8080
    },
    plugins: [vue()],
    resolve: {
        extensions: ['.mjs', '.js', '.ts', '.jsx', '.tsx', '.json', '.vue'],
        alias: {
            "@": path.resolve(__dirname, "./src"),
            // find: /^~(.*)$/,
            // replacement: 'node_modules/$1'
        },
    },
})