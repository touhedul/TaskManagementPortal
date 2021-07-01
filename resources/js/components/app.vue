<template>
  <div>
    <navbar />
    <employee />
    <foot />
  </div>
</template>

<script>
import navbar from "./navbar.vue";
import employee from "./employee.vue";
import foot from "./footer.vue";

export default {
  components: {
    navbar,
    employee,
    foot,
  },
};
</script>

<style>
</style>
