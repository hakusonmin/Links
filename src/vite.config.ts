import vue from '@vitejs/plugin-vue';
import autoprefixer from 'autoprefixer';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import tailwindcss from 'tailwindcss';
import { resolve } from 'node:path';
import { defineConfig } from 'vite';
import terser from '@rollup/plugin-terser';

export default defineConfig({
    server: {
        host: '0.0.0.0', // Docker で外部公開
        port: 5173,
        strictPort: true,
        watch: {
          usePolling: true,
        },
        hmr: {
          host: '127.0.0.1', // ← ここを明示するとブラウザが [::1] を使わなくなる！
        },
      },
    plugins: [
        laravel({
            input: ['resources/js/app.ts'],
            ssr: 'resources/js/ssr.ts',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/js'),
            'ziggy-js': resolve(__dirname, 'vendor/tightenco/ziggy'),
        },
    },
    css: {
        postcss: {
            plugins: [tailwindcss, autoprefixer],
        },
    },
    build: {
        sourcemap: true,
        rollupOptions: {
            plugins: [
              terser({
                compress: {
                  drop_console: true,
                  drop_debugger: true,
                }
              })
            ]
          }
    },
});
