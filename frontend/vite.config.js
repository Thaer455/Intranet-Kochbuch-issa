import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

export default defineConfig({
  plugins: [react()],
  server: {
    host: 'fi1.mshome.net',
    port: 5001,
    strictPort: true,
    cors: true,
    origin: 'http://fi1.mshome.net:5001'
  },
  build: {
    sourcemap: false
  }
})
