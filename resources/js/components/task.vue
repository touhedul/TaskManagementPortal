<template>
  <div>
    <div class="card-body">
      <form class="form" @submit.prevent="taskFormSubmit()">
        <input
          type="text"
          v-model="details"
          required
          class="form-control mb-2 mr-sm-2"
          placeholder="Write the task..."
        />
        <input type="hidden" v-model="employeeId" />
        <input type="hidden" v-model="taskId" />

        <button type="submit" class="btn btn-success mb-2 float-right">
          <i v-show="!isEdit" class="fa fa-plus"></i> {{ button }}
        </button>
      </form>
      <br />
      TO Do ({{ todoCount }})
      <br />
      <br />
      <p v-for="(task, index) in todoTasks" :key="task.id">
        <!-- <input @click="taskChangeStatus(task.id)" type="checkbox" /> -->
        {{ index + 1 }}. {{ task.details }}
        <span class="float-right">
          <a
            class="dropdown-toggle"
            href="#"
            role="button"
            id="dropdownMenuLink"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            Action
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a
              @click="taskChangeStatus(task.id, 1)"
              class="dropdown-item"
              href="javascript:void(0);"
              >Move to Doing</a
            >
            <a
              @click="taskChangeStatus(task.id, 2)"
              class="dropdown-item"
              href="javascript:void(0);"
              >Mark as Complete</a
            >
          </div>
          &nbsp; &nbsp;
          <a href="javascript:void(0);" class="text-right" title="Edit">
            <i class="fa fa-edit" @click="taskEdit(task.id)"> </i>
          </a>
          &nbsp; &nbsp;
          <a
            href="javascript:void(0);"
            class="text-right text-danger"
            title="Delete"
          >
            <i class="fa fa-trash" @click="taskDelete(task.id)"> </i>
          </a>
        </span>
      </p>
      <br />
      Doing ({{ doingCount }})
      <hr />
      <p v-for="(task, index) in doingTasks" :key="task.id">
        <!-- <input @click="taskChangeStatus(task.id)" type="checkbox" /> -->
        {{ index + 1 }}. {{ task.details }}
        <span class="float-right">
          <a
            class="dropdown-toggle"
            href="#"
            role="button"
            id="dropdownMenuLink"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            Action
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a
              @click="taskChangeStatus(task.id, 0)"
              class="dropdown-item"
              href="javascript:void(0);"
              >Move to Todo</a
            >
            <a
              @click="taskChangeStatus(task.id, 2)"
              class="dropdown-item"
              href="javascript:void(0);"
              >Mark as Complete</a
            >
          </div>
          &nbsp; &nbsp;
          <a href="javascript:void(0);" class="text-right" title="Edit">
            <i class="fa fa-edit" @click="taskEdit(task.id)"> </i>
          </a>
          &nbsp; &nbsp;
          <a
            href="javascript:void(0);"
            class="text-right text-danger"
            title="Delete"
          >
            <i class="fa fa-trash" @click="taskDelete(task.id)"> </i>
          </a>
        </span>
      </p>
    </div>
    <div class="card-footer">
      Completed({{ completeCount }})
      <br />
      <br />
      <p
        class="text-primary"
        v-for="(task, index) in completeTasks"
        :key="task.id"
      >
        <!-- <input @click="taskChangeStatus(task.id)" type="checkbox" checked /> -->

        {{ index + 1 }}. {{ task.details }}
        <span class="float-right">
          <a
            class="dropdown-toggle"
            href="#"
            role="button"
            id="dropdownMenuLink"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            Action
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a
              @click="taskChangeStatus(task.id, 0)"
              class="dropdown-item"
              href="javascript:void(0);"
              >Move to Todo</a
            >
            <a
              @click="taskChangeStatus(task.id, 2)"
              class="dropdown-item"
              href="javascript:void(0);"
              >Move to Doing</a
            >
          </div>
          &nbsp; &nbsp;
          <a
            href="javascript:void(0);"
            class="text-right text-danger"
            title="Delete"
          >
            <i class="fa fa-trash" @click="taskDelete(task.id)"> </i>
          </a>
        </span>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: ["employeeId"],
  data() {
    return {
      button: "Add",
      isEdit: false,
      todoCount: 0,
      doingCount: 0,
      completeCount: 0,
      taskId: "",
      details: "",
      tasks: [],
      todoTasks: [],
      doingTasks: [],
      completeTasks: [],
    };
  },
  methods: {
    taskFormSubmit() {
      let method = axios.post;
      let url = "api/tasks";
      if (this.isEdit == true) {
        this.taskUpdate();
      } else {
        this.taskAdd();
      }
    },
    taskAdd() {
      const formData = new FormData();
      formData.set("details", this.details);
      formData.set("employee_id", this.employeeId);
      axios
        .post("api/tasks", formData)
        .then((response) => {
          //   console.log(response);
          this.taskFormReset();
          this.taskFetchByEmployee();
        })
        .catch((error) => {
          this.error = true;
          console.log(error);
        });
    },
    taskUpdate() {
      const formData = new FormData();
      formData.set("details", this.details);
      formData.set("employee_id", this.employeeId);
      axios
        .put("api/tasks/" + this.taskId, {
          details: this.details,
        })
        .then((response) => {
          //   console.log(response);
          this.taskFormReset();
          this.taskFetchByEmployee();
        })
        .catch((error) => {
          this.error = true;
          console.log(error);
        });
    },
    taskFetchByEmployee() {
      axios
        .get("api/tasks/employee/" + this.employeeId)
        .then((response) => {
          //   console.log(response);
          this.todoTasks = response.data.data.todoTasks;
          this.todoCount = response.data.data.todoCount;
          this.doingTasks = response.data.data.doingTasks;
          this.doingCount = response.data.data.doingCount;
          this.completeTasks = response.data.data.completeTasks;
          this.completeCount = response.data.data.completeCount;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    taskDelete(id) {
      axios
        .delete("api/tasks/" + id)
        .then((response) => {
          this.taskFetchByEmployee();
        })
        .catch((error) => {
          this.error = true;
          console.log(error);
        });
    },
    taskEdit(id) {
      axios
        .get("api/tasks/" + id)
        .then((response) => {
          this.details = response.data.data.details;
          this.taskId = response.data.data.id;
          this.button = "Update";
          this.isEdit = true;
          //   console.log(response);
        })
        .catch((error) => {
          this.error = true;
          console.log(error);
        });
    },
    taskChangeStatus(id, status) {
      axios
        .post("api/tasks/change-status/" + id + "/" + status)
        .then((response) => {
          this.taskFetchByEmployee();
          //   console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    taskFormReset() {
      this.details = "";
      this.button = "Add";
      this.isEdit = false;
    },
  },
  created() {
    this.taskFetchByEmployee();
  },
};
</script>

<style>
</style>
