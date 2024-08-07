import { createI18n } from 'vue-i18n';

const messages = {
  en: {
    welcome: 'Welcome',
    about: 'About Us',
    home: 'Home',
  },
  pt: {
    welcome: 'Bem-vindo',
    about: 'Sobre Nós',
    home: 'Início',
  },
};

const i18n = createI18n({
  locale: 'pt',
  fallbackLocale: 'en',
  messages,
});

export default i18n;
