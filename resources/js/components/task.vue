<template>
  <div>
    <div class="card-body">
      <form class="form" @submit.prevent="taskFormSubmit()">
        <input
          type="text"
          v-model="details"
          required
          class="form-control mb-2 mr-sm-2"
          id="inlineFormInputName2"
          placeholder="Write the task..."
        />
        <input type="text" v-model="employeeId" />

        <button type="submit" class="btn btn-success mb-2 float-right">
          <i class="fa fa-plus"></i> Add
        </button>
      </form>
      <br />
      TO Do (0)
      <br />
      <br />
      <p>
        <input type="checkbox" /> This is a task from manageer
        <span class="float-right">
          <a class="text-right" href="#" title="Edit">
            <i class="fa fa-edit" @click="editEmployee(empl.id)"> </i>
          </a>
          &nbsp; &nbsp; &nbsp;
          <a href="#" class="text-right text-danger" title="Delete">
            <i class="fa fa-trash" @click="deleteEmployee(empl.id)"> </i>
          </a>
        </span>
      </p>
    </div>
    <div class="card-footer">
      Completed(0)
      <br />
      <br />
      <p>
        <input type="checkbox" /> This is a task from manageer
        <span class="float-right">
          &nbsp; &nbsp; &nbsp;
          <a href="#" class="text-right text-danger" title="Delete">
            <i class="fa fa-trash" @click="deleteEmployee(empl.id)"> </i>
          </a>
        </span>
        {{ employeeId }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: ["employeeId"],
  data() {
    return {
      details: "",
    };
  },
  methods: {
    taskFormSubmit() {
      const formData = new FormData();
      formData.set("details", this.details);
      formData.set("employee_id", this.employeeId);
      axios
        .post("api/employees", formData)
        .then((response) => {
          //   this.$emit("reload");
          //   alert('Employee Added Successful.');
          console.log(response);
          this.employeeFormReset();
          this.employeeFetch();
        })
        .catch((error) => {
          this.error = true;
          console.log(error);
        });
    },
  },
};
</script>

<style>
</style>
