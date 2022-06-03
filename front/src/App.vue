<template>
  <div class="content">
    <router-view />
  </div>
</template>

<script>
import { onMounted } from '@vue/runtime-core'
import useAuthentication from './composable/auth';

export default {
  setup() {
    const { authCheck } = useAuthentication();

    onMounted(async () => {
      await authCheck();
    })
  },
}
</script>