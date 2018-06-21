import { LanguageContext } from './language-context';

function LanguageTogglerButton() {
    // The Theme Toggler Button receives not only the theme
    // but also a toggleTheme function from the context
    return (
        <LanguageContext.Consumer>
            {({ lang, toggleLanguage }) => (
                <button
                    onClick={toggleLanguage}
                    text={lang.toggleLanguage}>
                </button>
            )}
        </LanguageContext.Consumer>
    );
}

export default LanguageTogglerButton;
