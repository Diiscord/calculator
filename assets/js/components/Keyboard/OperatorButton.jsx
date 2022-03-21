import React from 'react';
import { useDispatch } from 'react-redux'
import { addOperatorToOperation } from '../../slices/keyboardSlice';
import KeyboardButton from './KeyboardButton';
    
const OperatorButton = ({ value }) => {
    const dispatch = useDispatch();

    return (
        <KeyboardButton action={() => dispatch(addOperatorToOperation(value))}>
            {value}
        </KeyboardButton>
    );
}
    
export default OperatorButton;