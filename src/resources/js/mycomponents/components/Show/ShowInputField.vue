<script setup>
const modelValue = defineModel('modelValue');
const props = defineProps({
  label: String,
});
</script>

<template>
  <div class="form-element-wrapper">
    <div class="form-element-wrapper-title">
      <label :for="label" readonly>{{ label }}</label>
    </div>
    <div class="form-element-wrapper-content">
      <input
        :id="label"
        type="text"
        v-model="modelValue"
        class="w-full border border-gray-300 p-2"
        readonly
        required
      />
    </div>
  </div>
</template>

<style scoped>
input[type='text'] {
  appearance: none;
  height: 35px;
  background-color: var(--light-gray);
  margin-bottom: 6px;
  border: 0.5px solid black;
}

.form-element-wrapper {
  margin-bottom: 40px;
}

.form-element-wrapper-title {
  text-align: left;
}

.form-element-wrapper-content {
  border-bottom: 1px solid rgb(170, 170, 170);
  margin: 20px auto;
}
</style>
