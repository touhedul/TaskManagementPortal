<template>
  <div class="container">
    <br />
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Employee</div>
          <div class="card-body">
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
                :required="required ? true : false"
                class="form-control dropify"
                ref="fileupload"
                accept="image/*"
              />
              <br />
              <img
                v-if="previewImage"
                :src="'/images/' + this.image"
                class="img-thumbnail rounded-circle"
                alt=""
              />
              <img
                v-show="imageUrl"
                :src="this.imageUrl"
                class="img-thumbnail rounded-circle"
                height="100px"
                width="100px"
                alt=""
              />
              <!-- Image <input type="text" class="form-control"/> -->
              <br />
              <p v-show="error" class="form-control alert-danger">
                Something is Wrong !
              </p>
              <button class="btn btn-primary" type="submit">
                {{ button }}
              </button>
              <a class="btn btn-warning" @click="employeeFormReset()">Reset</a>
            </form>
          </div>
        </div>
      </div>
    </div>
    <br />
    <div class="row">
      <div
        v-for="empl in employees"
        :key="empl.id"
        class="col-md-6"
        style="margin-top: 20px"
      >
        <div class="card border-primary">
          <div class="card-header">
            <img
              :src="'/images/' + empl.image"
              class="img-thumbnail rounded-circle"
            />
            {{ empl.name }}
            <span class="float-right">
              <a class="text-right" href="#" title="Edit">
                <i class="fa fa-edit" @click="editEmployee(empl.id)"> </i>
              </a>
              &nbsp; &nbsp; &nbsp;
              <a href="#" class="text-right text-danger" title="Delete">
                <i class="fa fa-trash" @click="deleteEmployee(empl.id)"> </i>
              </a>
            </span>
          </div>

          <task :employeeId="empl.id" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import task from "./task.vue";
export default {
  components: {
    task,
  },
  data: function () {
    return {
      button: "Add",
      previewImage: false,
      isEdit: false,
      employeeId: "",
      employees: [],
      required: true,
      image: "",
      imageUrl: "",
      error: false,
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
      this.image = "";
      const file = e.target.files[0];
      this.imageUrl = URL.createObjectURL(file);
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
      this.employee.image = "";
      this.image = "";
      this.button = "Add";
      this.$refs.fileupload.value = null;
      this.isEdit = false;
      this.required = true;
      this.error = false;
      this.imageUrl = "";
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
          this.error = true;
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
          this.required = true;
        })
        .catch((error) => {
          this.error = true;
          console.log(response);
        });
    },
    employeeFetch() {
      axios
        .get("api/employees")
        .then((response) => {
          console.log(response);
          this.employees = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteEmployee(id) {
      if (confirm("Do you really want to delete?")) {
        axios
          .delete("api/employees/" + id)
          .then((response) => {
            this.employeeFetch();
          })
          .catch((error) => {
            this.error = true;
            console.log(error);
          });
      }
    },
    editEmployee(id) {
      axios
        .get("api/employees/" + id)
        .then((response) => {
          this.button = "Update";
          this.isEdit = true;
          this.required = false;
          this.employeeId = id;
          this.employee.name = response.data.data.name;
          this.employee.email = response.data.data.email;
          this.image = response.data.data.image;
          this.previewImage = true;
        })
        .catch((error) => {
          this.error = true;
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
