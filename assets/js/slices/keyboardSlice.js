import { createSlice } from '@reduxjs/toolkit'
import { fetchUsers } from '../actions/actions';
import { canAddMinus, cleanOperation, isOperator } from '../utils';

const initialState = {
    history: [],
    operation: '',
    result: '',
    openedParenthesis: 0,
}

export const keyboardSlice = createSlice({
    name: 'keyboard',
    initialState,
    reducers: {
        setOperation: (state, action) => {
            state.operation = action.payload;
        },
        addNumberToOperation: (state, action) => {
            // Reset operation when input a number after pressing equal
            if (state.result !== '') {
                state.operation = '';
                state.result = '';
            }
            // Handle useless 0
            state.operation = cleanOperation(state.operation + action.payload, state.openedParenthesis);
        },
        addOperatorToOperation: (state, action) => {
            const lastChar = state.operation.slice(-1);
            const addedChar = action.payload;

            // Add operator to previous result when input an operator after pressing equal
            if (state.result !== '') {
                state.operation = state.result;
                state.result = '';
            }

            // Prevent 2 following operators except if first is / or * and second is -
            if (isOperator(lastChar)) {
                // We can add a minus after a / or a * to make a negative number
                if (addedChar === '-' && canAddMinus(lastChar)) {
                    state.operation += addedChar;
                }
            } else {
                state.operation += addedChar;
            }
        },
        openParenthesis: (state) => {
            // TODO Try to do the actual google parenthesis
            state.operation += '(';
            state.openedParenthesis++;
        },
        closeParenthesis: (state) => {
            if (state.openedParenthesis > 0) {
                state.operation += ')';
                state.openedParenthesis--;
            }
        },
        clearOne: (state) => {
            const lastChar = state.operation.slice(-1);

            if (lastChar === '(') {
                state.openedParenthesis++;
            }
            if (lastChar === ')') {
                state.openedParenthesis--;
            }

            state.operation = state.operation.slice(0, -1);
        },
        clearAll: (state) => {
            state.openedParenthesis = 0;
            state.result = '';
            state.operation = '';
        },
    },
    extraReducers: (builder) => {
        builder.addCase(fetchUsers.fulfilled, (state, action) => {
            if (state.history.indexOf(action.meta.arg) < 0) {
                state.history = [
                    action.meta.arg,
                    ...state.history,
                ];    
            }
            state.openedParenthesis = 0;
            state.result = action.payload;
        })
        builder.addCase(fetchUsers.rejected, (state, action) => {
            state.result = 'An error happened, sorry about this';
        })
    },
})

export const {
    setOperation,
    addNumberToOperation,
    addOperatorToOperation,
    clearOne,
    clearAll,
    openParenthesis,
    closeParenthesis,
} = keyboardSlice.actions

export default keyboardSlice.reducer