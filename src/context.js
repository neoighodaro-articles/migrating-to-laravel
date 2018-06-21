import React from 'react'
import lan from './language'

const LanguageContext = React.createContext({
	lang: lan.esp,
	toggleLanguage: () => { }
});

export default LanguageContext;
