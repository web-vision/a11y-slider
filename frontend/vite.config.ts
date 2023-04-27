import { defineConfig } from 'vite'

export default defineConfig(({ command, mode }) => {
  if (command === 'build') {
    return {
      build: {
        outDir: '../',
        rollupOptions: {
          output: {
            entryFileNames: `Resources/Public/[name].js`,
            chunkFileNames: `Resources/Public/[name].js`,
            assetFileNames: `Resources/Public/[name].[ext]`
          }
        }
      }
    }
  } else {
    // command === 'server'
    return {
      build: {
        rollupOptions: {
          output: {
            entryFileNames: `assets/[name].js`,
            chunkFileNames: `assets/[name].js`,
            assetFileNames: `assets/[name].[ext]`
          }
        }
      }
    }
  }
})
