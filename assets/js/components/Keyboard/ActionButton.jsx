import React from 'react';
import KeyboardButton from './KeyboardButton';
    
const ActionButton = ({ value, action }) => (
    <KeyboardButton action={action}>
        {value}
    </KeyboardButton>
);

export default ActionButton;