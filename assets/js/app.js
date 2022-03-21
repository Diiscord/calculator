import React from 'react';
import ReactDOM from 'react-dom';
import { store } from './store/store'
import { Provider } from 'react-redux'
import Calculator from './components/Calculator';
    
// ReactDOM.render(<Router><Home /></Router>, document.getElementById('root'));
ReactDOM.render(
    <Provider store={store}>
        <Calculator />
    </Provider>,
    document.getElementById('root')
);