import React from 'react';
import { useDispatch, useSelector } from 'react-redux'
import { clearOne, clearAll, equal, openParenthesis, closeParenthesis } from '../../slices/keyboardSlice';
import { NUMBERS, OPERATORS } from '../../constants';
import OperatorButton from './OperatorButton';
import NumberButton from './NumberButton';
import ActionButton from './ActionButton';
import { fetchUsers } from '../../actions/actions';
    
const Keyboard = () => {
    const dispatch = useDispatch();

    const {
        operation,
        result,
     } = useSelector((state) => state.keyboard);

    return (
        <div style={{ width: '500px', height: '300px', border: 'solid', borderRadius: '5px', padding: '15px' }}>
            <div>
                {NUMBERS.map((number) => (
                    <NumberButton value={number} key={number} />)
                )}
            </div>
            <div>
                {OPERATORS.map((operator) => (
                    <OperatorButton value={operator} key={operator} />
                ))}
            </div>
            {/* Clear all the operation if pressed equal, otherwise clear last character */}
            <ActionButton
                value={'('}
                action={() => dispatch(openParenthesis())}
            />
            <ActionButton
                value={')'}
                action={() => dispatch(closeParenthesis())}
            />
            <ActionButton
                value={result === '' ? 'CE' : 'CA'}
                action={() => dispatch(result === '' ? clearOne() : clearAll())}
            />
            <ActionButton
                value={'='}
                action={() => dispatch(fetchUsers(operation))}
            />
        </div>
    );
}
    
export default Keyboard;