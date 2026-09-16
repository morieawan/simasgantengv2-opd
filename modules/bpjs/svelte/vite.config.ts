import { svelte } from '@sveltejs/vite-plugin-svelte'
import { defineConfig } from 'vite'
import path from 'path'

export default defineConfig({
  plugins: [svelte()],
  build: {
    outDir: path.resolve(__dirname, '../../../web/dist/modules/bpjs'),
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: 'src/main.ts', 
    },
  },
  server: {
    host: '127.0.0.1',
    port: 5000,
    strictPort: true,
  }
})
