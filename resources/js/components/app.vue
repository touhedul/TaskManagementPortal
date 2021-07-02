<template>
  <div>
    <navbar />
    <employee />
    <foot />
    <loader :is-visible="isLoading"></loader>
  </div>
</template>

<script>
import navbar from "./navbar.vue";
import employee from "./employee.vue";
import foot from "./footer.vue";
import loader from "./loader.vue";

export default {
  components: {
    navbar,
    employee,
    foot,
    loader,
  },
  mounted() {
    this.enableInterceptor();
  },
  data: function () {
    return {
      isLoading: false,
      axiosInterceptor: null,
    };
  },
  methods: {
    enableInterceptor() {
      this.axiosInterceptor = window.axios.interceptors.request.use(
        (config) => {
          this.isLoading = true;
          return config;
        },
        (error) => {
          this.isLoading = false;
          return Promise.reject(error);
        }
      );

      window.axios.interceptors.response.use(
        (response) => {
          this.isLoading = false;
          return response;
        },
        function (error) {
          this.isLoading = false;
          return Promise.reject(error);
        }
      );
    },

    disableInterceptor() {
      window.axios.interceptors.request.eject(this.axiosInterceptor);
    },
  },
};
</script>

<style>
</style>
