import React, { Component } from 'react';
    
const KeyboardButton = ({
    action,
    children
}) => {
    return (
        <div
            style={{ width: '50px', height: '50px', border: 'solid', display: 'inline-block', marginRight: '5px', marginBottom: '5px', textAlign: 'center', lineHeight: '50px' }}
            onClick={action}
        >
            {children}
        </div>
    );
}
    
export default KeyboardButton;