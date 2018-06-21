import React, { Component } from 'react';
import './App.css'; // some classes and styles
import LanguageContext from './context'; // this is our context object which would handle all context of the application
import lan from './language' // this contains the text of the languages

class App extends Component {

	constructor(props) {
		super(props);

		// defining the toggle function that 
		// would change between different languages
		this.toggleLanguage = () => {
			this.setState(state => ({
				lang:
					state.lang === lan.en
						? lan.esp
						: lan.en
			}));
		};

		// passing the toggleLanguage function as part of the state
		this.state = {
			lang: lan.esp,
			toggleLanguage: this.toggleLanguage
		};
	}

  render() {
    return (
		// passing the state into the LanguageContext 
		// provider so the toggle language function 
		// and the lang object would be available to 
		// all parts of the application
		<LanguageContext.Provider value={this.state}>
			<div className="App">
				<LanguageContext.Consumer>
					{({ lang, toggleLanguage }) => (
						<React.Fragment>
							<header className="App-header">
								<h1 className="App-title">{lang.header}</h1>
								<p>{lang.text}</p>
							</header>
							<Toolbar />
						</React.Fragment>
					)}
				</LanguageContext.Consumer>
			</div>
		</LanguageContext.Provider>
    );
  }
}


function Toolbar(props) {
	return (
		<div>
			<CloseButton />
		</div>
	);
}

function CloseButton(props) {
	return (
		<LanguageContext.Consumer>
			{({ lang, toggleLanguage }) => (
				<Button
					onClick={toggleLanguage}
					text={lang.changeLanguage}>
				</Button>
			)}
		</LanguageContext.Consumer>
	);
}

function Button(props) {
	return (
		<button className="App-button" onClick={props.onClick}>{props.text}</button>
	);
}


export default App;
