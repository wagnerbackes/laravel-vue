import { defineStore } from 'pinia';

export const useEditStore = defineStore('edit', {
  state: () => ({
    isEditMode: false,
  }),
  actions: {
    toggleEditMode() {
      this.isEditMode = !this.isEditMode;
    },
    setEditMode(value) {
      this.isEditMode = value;
    },
  },
});
