import { createAsyncThunk } from '@reduxjs/toolkit'

export const fetchUsers = createAsyncThunk(
    'keyboard/fetchUsers',
    async (operation, { getState }) => {
        const { keyboard: { openedParenthesis } } = getState();
        let closedOperation = operation;

        for (let i = 0; i < openedParenthesis; i++) {
            closedOperation += ')';
        }
        console.log(closedOperation)

        const encodedOperation = encodeURIComponent(closedOperation);
        const response = await fetch(`/api/compute/?operation=${encodedOperation}`)
            .then(res => res.json());

        return response.result;
    }
);