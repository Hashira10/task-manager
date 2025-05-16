<template>
  <div class="border rounded shadow p-3 my-3">
    <h2>Список задач</h2>
    <table class="table table-striped table-hover mb-0">
      <thead>
        <tr>
          <th>#</th>
          <th>Название</th>
          <th>Описание</th>
          <th>Срок выполнения</th>
          <th class="text-end">Действия</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="task in tasks" :key="task.id">
          <td>{{ task.id }}</td>
          <td>{{ task.title }}</td>
          <td>{{ task.description }}</td>
          <td>{{ task.due_date }}</td>
          <td class="text-end">
            <button
              @click="$emit('edit-task', task)"
              class="btn btn-warning btn-sm me-2"
              style="background-color:rgb(204, 142, 62); color: white; border: none;"
            >
              Редактировать
            </button>
            <button
              @click="$emit('delete-task', task.id)"
              class="btn btn-danger btn-sm"
              style="background-color:rgb(160, 32, 41); color: white; border: none;"
            >
              Удалить
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: ['tasks']
};
</script>

