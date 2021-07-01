<template>
  <div class="container">
    <br />
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form
          @submit.prevent="employeeFormSubmit()"
          enctype="multipart/form-data"
        >
          Name
          <input
            type="text"
            required
            class="form-control"
            v-model="employee.name"
            name="name"
          />
          Email
          <input
            type="email"
            required
            class="form-control"
            v-model="employee.email"
          />
          Image
          <input
            @change="handleOnChange"
            type="file"
            required
            class="form-control"
          />
          <!-- Image <input type="text" class="form-control"/> -->
          <br />
          <button class="btn btn-primary" type="submit">{{ button }}</button>
        </form>
      </div>
      <div class="col-md-4">
        <button class="btn btn-primary">Add Employee</button>
      </div>
    </div>
    <br />
    <div class="row">
      <div
        v-for="empl in employees"
        :key="empl.id"
        class="col-md-4"
        style="margin-top: 20px"
      >
        <div class="card">
          <div class="card-header">
            <img
              :src="'/images/' + empl.image"
              class="img-thumbnail rounded-circle"
            />
            {{ empl.name }}
            <div class="text-right">
              <a class="text-right" href="#" title="Edit">
                <i class="fa fa-edit" @click="editEmployee(empl.id)"> </i>
              </a>
              &nbsp; &nbsp; &nbsp;
              <a href="#" class="text-right" title="Delete">
                <i class="fa fa-trash" @click="deleteEmployee(empl.id)"> </i>
              </a>
            </div>
          </div>

          <div class="card-body">
            <p>
              <input type="checkbox" /> This is a task from manageer<span
                style="text-align: center"
                >Edit|Delete</span
              >
            </p>
            <p><input type="checkbox" /> This is a task from manageer</p>
            <p><input type="checkbox" /> This is a task from manageer</p>
          </div>
          <div class="card-footer">
            <button class="btn btn-success">Add task</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      button: "Add",
      isEdit: false,
      employeeId: "",
      employees: [],
      employee: {
        name: "",
        email: "",
        image: "",
      },
    };
  },
  methods: {
    handleOnChange(e) {
      this.employee.image = e.target.files[0];
    },
    employeeFormSubmit() {
      let method = axios.post;
      let url = "api/employees";
      if (this.isEdit == true) {
        this.employeeUpdate();
      } else {
        this.employeeAdd();
      }
    },
    employeeFormReset() {
      this.employee.name = "";
      this.employee.email = "";
    },
    employeeAdd() {
      const formData = new FormData();
      formData.append("image", this.employee.image);
      formData.set("name", this.employee.name);
      formData.set("email", this.employee.email);
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
          console.log(error);
        });
    },
    employeeUpdate() {
      const formData = new FormData();
      formData.append("image", this.employee.image);
      formData.set("name", this.employee.name);
      formData.set("email", this.employee.email);
      axios
        .post("api/employees/" + this.employeeId, formData)
        .then((response) => {
          console.log(response);
            this.employeeFormReset();
          this.employeeFetch();
          this.button = "Add";
          this.isEdit = false;
        })
        .catch((error) => {
          console.log(response);
        });
    },
    employeeFetch() {
      axios
        .get("api/employees")
        .then((response) => {
          this.employees = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteEmployee(id) {
      axios
        .delete("api/employees/" + id)
        .then((response) => {
          this.employeeFetch();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    editEmployee(id) {
      axios
        .get("api/employees/" + id)
        .then((response) => {
          this.button = "Update";
          this.isEdit = true;
          this.employeeId = id;
          this.employee.name = response.data.data.name;
          this.employee.email = response.data.data.email;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  created() {
    this.employeeFetch();
  },
};
</script>

<style>
</style>
