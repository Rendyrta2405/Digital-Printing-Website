/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/admin/**/*.blade.php",
    "./resources/views/admin/*.blade.php",
  ],
  theme: {
    extend: {
      fontFamily: { 
        sans: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'] 
      },
      colors: {
        ink: '#0b1220',
        brand: { 
          DEFAULT: '#2563eb', 
          dark: '#1d4ed8' 
        },
        cmyk: { 
          c: '#06b6d4', 
          m: '#ec4899', 
          y: '#facc15' 
        },
      }
    },
  },
  plugins: [],
}