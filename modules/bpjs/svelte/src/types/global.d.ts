// src/types/global.d.ts

declare global {
  interface Window {
    yii: {
      getCsrfToken: () => string;
      getCsrfParam: () => string;
    };
  }

  // Mendeklarasikan variabel global yii
  const yii: {
    getCsrfToken: () => string;
    getCsrfParam: () => string;
  };
}

export {};