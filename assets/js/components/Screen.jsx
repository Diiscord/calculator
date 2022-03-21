import React from 'react';
import { useDispatch } from 'react-redux';
import { useSelector } from 'react-redux'
import { setOperation } from '../slices/keyboardSlice';
    
const Screen = () => {
    const dispatch = useDispatch();
    const {
        history,
        operation,
        result,
     } = useSelector((state) => state.keyboard)

    return (
        <div style={{ width: '500px', height: '100px', border: 'solid', borderRadius: '5px', padding: '15px' }}>
            <select
                name="history"
                id="history"
                onChange={(e) => dispatch(setOperation(e.target.value))}
            >
                {history.map((entry) => (
                    <option key={entry} value={entry}>{entry}</option>
                ))}
            </select>
            <div style={{ textAlign: 'right' }}>
                <p>
                    Operation : {operation}
                </p>
                <p>
                    Result : {result}
                </p>
            </div>
        </div>
    );
}
    
export default Screen;