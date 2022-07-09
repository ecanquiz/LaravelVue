import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: "http://127.0.0.1:8000",
                    includeAbsolute: false,
                },
            },
        }),
    ],
    define: {
    'process.env': {
      VUE_APP_API_URL: "http://127.0.0.1:8000"
    }
  },
});
