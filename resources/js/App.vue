<template>
  <div class="container my-4">
    <h2 class="text-center mb-4" style="color: #25344F;">
      Управление задачами
    </h2>

    <button
      @click="showTaskForm"
      class="btn mb-3"
      style="background-color: #25344F; color: white; border:none;"
    >
      Добавить задачу
    </button>

    <TaskForm
      v-if="isTaskFormVisible"
      :initialTask="editingTask"
      @task-saved="onTaskSaved"
      @cancel="cancelTaskForm"
    />

    <TaskList
      :tasks="tasks"
      @edit-task="editTask"
      @delete-task="deleteTask"
    />
  </div>
</template>

<script>
import TaskForm from './components/TaskForm.vue';
import TaskList from './components/TaskList.vue';
import axios from 'axios';

export default {
  components: { TaskForm, TaskList },
  data() {
    return {
      tasks: [],
      isTaskFormVisible: false,
      editingTask: null,
    };
  },
  methods: {
    fetchTasks() {
      const url = `${import.meta.env.VUE_APP_API_URL || 'http://localhost:8000/api'}/tasks`;
      axios.get(url).then(response => {
        this.tasks = response.data;
      });
    },
    showTaskForm() {
      this.editingTask = null;
      this.isTaskFormVisible = true;
    },
    editTask(task) {
      this.editingTask = task;
      this.isTaskFormVisible = true;
    },
    deleteTask(id) {
      const url = `${import.meta.env.VUE_APP_API_URL || 'http://localhost:8000/api'}/tasks/${id}`;
      axios.delete(url).then(() => {
        this.fetchTasks();
      });
    },
    onTaskSaved(savedTask) {
      const index = this.tasks.findIndex(task => task.id === savedTask.id);
      if (index > -1) {
        this.tasks.splice(index, 1, savedTask);
      } else {
        this.tasks.push(savedTask);
      }
      this.isTaskFormVisible = false;
      this.editingTask = null;
    },
    cancelTaskForm() {
      this.isTaskFormVisible = false;
      this.editingTask = null;
    }
  },
  mounted() {
    this.fetchTasks();
  }
};
</script>


