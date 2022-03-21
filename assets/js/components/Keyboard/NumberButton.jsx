import React from 'react';
import { useDispatch } from 'react-redux'
import { addNumberToOperation } from '../../slices/keyboardSlice';
import KeyboardButton from './KeyboardButton';
    
const NumberButton = ({ value }) => {
    const dispatch = useDispatch();

    return (
        <KeyboardButton action={() => dispatch(addNumberToOperation(value))}>
            {value}
        </KeyboardButton>
    );
}
    
export default NumberButton;