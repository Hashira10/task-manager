<template>
  <div
    class="mx-auto my-4 p-4 border rounded shadow"
    style="max-width: 480px;"
  >
    <h3 class="mb-4 text-center">{{ task.id ? 'Редактировать задачу' : 'Добавить задачу' }}</h3>
    <form @submit.prevent="saveTask">
      <div class="mb-3">
        <label for="title" class="form-label">Название</label>
        <input
          v-model="task.title"
          type="text"
          class="form-control form-control-sm"
          id="title"
          required
        />
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <textarea
          v-model="task.description"
          class="form-control form-control-sm"
          id="description"
          rows="3"
        ></textarea>
      </div>
      <div class="mb-3">
        <label for="due_date" class="form-label">Срок выполнения</label>
        <input
          v-model="task.due_date"
          type="date"
          class="form-control form-control-sm"
          id="due_date"
        />
      </div>
      <div class="d-flex justify-content-center">
        <button
          type="submit"
          class="btn btn-sm me-2 px-4"
          style="background-color: #25344F; color: white; border: none;"
        >
          Сохранить
        </button>
        <button type="button" @click="$emit('cancel')" class="btn btn-secondary btn-sm px-4">
          Отмена
        </button>
      </div>
    </form>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  props: ['initialTask'],
  data() {
    return {
      task: { ...this.initialTask }
    };
  },
  methods: {
    saveTask() {
      const url = `${process.env.VUE_APP_API_URL || 'http://localhost:8000/api'}/tasks${this.task.id ? `/${this.task.id}` : ''}`;
      const method = this.task.id ? 'put' : 'post';

      axios[method](url, this.task)
        .then(response => {
          this.$emit('task-saved', response.data);
        });
    }
  },
  watch: {
    initialTask: {
      deep: true,
      handler(newTask) {
        this.task = { ...newTask };
      }
    }
  }
};
</script>
