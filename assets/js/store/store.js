import { configureStore } from '@reduxjs/toolkit'
import keyboardSlice from '../slices/keyboardSlice'

export const store = configureStore({
  reducer: {
      keyboard: keyboardSlice,
  },
})